<?php

use Core\Database;

$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['admin'])) {
    header('Location: /login');
    exit();
}

if (isset($_POST['save'])) {
    $gymName = trim($_POST['gym_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $ownerName = trim($_POST['ownerName'] ?? '');
    $address = trim($_POST['address'] ?? '');

    $_SESSION['success'] = [];
    $_SESSION['errors'] = [];

    if ($gymName && $email && $phone && $ownerName && $address) {
        try {
            $db->query(
                "UPDATE admininfo 
                SET gym_name = ?, name = ?, email = ?, phone = ?, address = ? 
                WHERE id = 1",
                [$gymName, $ownerName, $email, $phone, $address]
            );

            $_SESSION['success'][] = "Gym information updated successfully!";
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Failed to update gym info: " . $e->getMessage();
        }
    } else {
        $_SESSION['errors'][] = "Please fill in all fields before submitting.";
    }

    header("Location: /adminDashboard?tab=settings");
    exit();
}
