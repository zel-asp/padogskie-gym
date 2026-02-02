<?php

use Core\Database;


$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['admin'])) {
    header('Location: /login');
    exit();
}

$_SESSION['DeviceSuccess'] = '';
$_SESSION['DeviceError'] = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $deviceName = $_POST['deviceName'] ?? null;
        $status = 'locked';

        if ($deviceName) {

            $db->query(
                "INSERT INTO locked_devices (device, status) VALUES (?, ?)",
                [$deviceName, $status]
            );
            $db->query(
                "UPDATE login_logs SET account_status = ? WHERE user_agent = ?",
                [$status, $deviceName]
            );

            $_SESSION['DeviceSuccess'] = ['Device successfully locked'];
        }

        header('Location: /adminDashboard?tab=userlogs');
        exit();
    }

} catch (\Throwable $th) {

    $_SESSION['DeviceError'] = ['Error: ' . $th->getMessage()];
    header('Location: /adminDashboard?tab=userlogs');
    exit();
}
