<?php

use Core\Database;

$config = require base_path('config/config.php');
$db = new Database($config['database']);

$errors = [];


if (isset($_POST['login'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $captchaResponse = $_POST['cf-turnstile-response'] ?? '';
    $errors = [];

    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
    $maxAttempts = 3;
    $attemptWindow = 30;

    // ---------- CAPTCHA CHECK ----------
    if (empty($captchaResponse)) {
        $errors[] = 'Please complete the CAPTCHA.';
    } else {
        $secretKey = '0x4AAAAAACWH4cOK8wYy8t7Fxb6wV3helSU';
        $verify = file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded",
                'content' => http_build_query([
                    'secret' => $secretKey,
                    'response' => $captchaResponse,
                    'remoteip' => $ipAddress
                ]),
            ],
        ]));
        $responseData = json_decode($verify);
        if (!$responseData->success) {
            $errors[] = 'CAPTCHA verification failed. Please try again.';
        }
    }

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (!preg_match($pattern, $email)) {
        $errors[] = "Email contains invalid characters.";
    }

    $isDeviceLocked = $db->query(
        "SELECT device 
    FROM locked_devices 
    WHERE device = ? AND status = 'locked'",
        [$userAgent]
    )->find();

    if ($isDeviceLocked) {
        $errors[] = 'Login Denied, Your device is locked';
    }

    // ---------- EMPTY FIELD CHECK ----------
    if (empty($email) || empty($password)) {
        $errors[] = 'Please fill in all fields.';
    }

    // ---------- CHECK FAILED ATTEMPTS ----------
    $stmtAttempts = $db->query(
        "SELECT COUNT(*) AS failed_count 
        FROM login_logs 
        WHERE email = ? 
        AND status = 'error' 
        AND created_at > (NOW() - INTERVAL ? SECOND)",
        [$email, $attemptWindow]
    );
    $attemptData = $stmtAttempts->fetch_one();
    $failedAttempts = $attemptData['failed_count'] ?? 0;

    if ($failedAttempts >= $maxAttempts) {
        $errors[] = "Too many failed login attempts. Please try again after {$attemptWindow} seconds.";

        $db->query(
            "INSERT INTO login_logs (user_id, email, status, is_success, message, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                null,
                $email,
                'error',
                0,
                'Blocked due to too many failed attempts',
                $ipAddress,
                $userAgent
            ]
        );

        $_SESSION['errors'] = $errors;
        header('Location: /login');
        exit();
    }


    if (empty($errors)) {
        try {
            $stmt = $db->query('SELECT * FROM users WHERE email = :email', [':email' => $email]);
            $user = $stmt->fetch_one();

            if ($user && password_verify($password, $user['password'])) {
                // Generate session token
                $sessionToken = bin2hex(random_bytes(32));
                $db->query('UPDATE users SET session_token = ? WHERE id = ?', [
                    $sessionToken,
                    $user['id']
                ]);

                // Log success
                $db->query(
                    "INSERT INTO login_logs (user_id, email, status, is_success, message, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?)",
                    [
                        $user['id'],
                        $email,
                        'success',
                        1,
                        'Login successful',
                        $ipAddress,
                        $userAgent
                    ]
                );

                // Set session
                if ($user['id'] === 1 && $user['email'] === 'admin_padogskie@gmail.com') {
                    $_SESSION['admin'] = [
                        'logged_in' => true,
                        'role' => 'admin',
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'token' => $sessionToken
                    ];
                    header('Location: /adminDashboard');
                } else {
                    $_SESSION['user'] = [
                        'logged_in' => true,
                        'role' => 'user',
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'token' => $sessionToken
                    ];
                    header('Location: /userdashboard');
                }

                exit();
            } else {
                $errors[] = 'Invalid email or password.';

                // Log failed attempt
                $db->query(
                    "INSERT INTO login_logs (user_id, email, status, is_success, message, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?)",
                    [
                        $user['id'] ?? null,
                        $email,
                        'error',
                        0,
                        'Invalid credentials',
                        $ipAddress,
                        $userAgent
                    ]
                );
            }
        } catch (Throwable $th) {
            $errors[] = 'Database error: ' . $th->getMessage();
        }
    }

    // ---------- STORE ERRORS AND REDIRECT ----------
    $_SESSION['errors'] = $errors;
    header('Location: /login');
    exit();
}
