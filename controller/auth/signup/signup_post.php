<?php

use Core\Database;

$config = require base_path('config/config.php');
$db = new Database($config['database']);

$errors = [];

if (isset($_POST['register'])) {

    // Get values from form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirm'];
    $terms = isset($_POST['terms']) ? 1 : 0;
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';


    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'Please complete all the input fields.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password id too short';
    }
    if (strlen($password) > 15) {
        $errors[] = 'Password id too long';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$terms) {
        $errors[] = 'You must accept the Terms and Conditions.';
    }


    // Proceed only if no errors
    if (empty($errors)) {
        try {

            $isDeviceLocked = $db->query(
                "SELECT device FROM locked_devices WHERE device = ? AND status = 'locked'",
                [$userAgent]
            )->find();

            if ($isDeviceLocked) {
                $errors[] = 'SignUp Denied, Your device is locked';
            }

            // Check if username or email already exists
            $stmt = $db->query(
                'SELECT id FROM users WHERE email = :email OR username = :username',
                [
                    ':email' => $email,
                    ':username' => $username
                ]
            );

            if ($stmt->count() > 0) {
                $errors[] = 'Username or email already exists.';
                $_SESSION['errors'] = $errors;
                header('Location: /signup');
                exit();
            }

            // Hash password
            $hash_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user
            $db->query(
                'INSERT INTO users (username, email, password, terms_accepted, user_agent) VALUES (?, ?, ?, ?, ?)',
                [
                    $username,
                    $email,
                    $hash_password,
                    $terms,
                    $userAgent
                ]
            );

            // Redirect to login
            header('Location: /login');
            exit();

        } catch (\Throwable $th) {
            // You may log errors in production
            $_SESSION['errors'] = ['Something went wrong. Please try again later.'];
            header('Location: /signup');
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: /signup');
        exit();
    }
}
