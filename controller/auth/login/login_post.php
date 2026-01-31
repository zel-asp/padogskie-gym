<?php

use Core\Database;


$config = require base_path('config/config.php');
$db = new Database($config['database']);

$errors = [];

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $captchaResponse = $_POST['cf-turnstile-response'] ?? '';
    $errors = [];

    // Check CAPTCHA first
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
                    'remoteip' => $_SERVER['REMOTE_ADDR']
                ]),
            ],
        ]));
        $responseData = json_decode($verify);
        if (!$responseData->success) {
            $errors[] = 'CAPTCHA verification failed. Please try again.';
        }
    }


    if (empty($email) || empty($password)) {
        $errors[] = 'Please fill in all fields.';
    }


    if (empty($errors)) {
        try {
            $stmt = $db->query('SELECT * FROM users WHERE email = :email', [':email' => $email]);
            $user = $stmt->fetch_one();

            if ($user && password_verify($password, $user['password'])) {

                $sessionToken = bin2hex(random_bytes(32));

                $db->query('UPDATE users SET session_token = ? WHERE id = ?', [
                    $sessionToken,
                    $user['id']
                ]);



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
            }
        } catch (Throwable $th) {
            $errors[] = 'Database error: ' . $th->getMessage();
        }


    }

    // store errors and redirect back
    $_SESSION['errors'] = $errors;
    header('Location: /login');
    exit();
}
