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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unlockDevice'])) {

        $deviceName = $_POST['deviceName'] ?? null;
        $status = null;

        if ($deviceName) {

            $db->query(
                "UPDATE login_logs SET account_status = ? WHERE user_agent = ?",
                [$status, $deviceName]
            );

            $db->query(
                "DELETE FROM locked_devices WHERE device = ?",
                [$deviceName]
            );

            $_SESSION['DeviceSuccess'] = ['Device successfully unlocked'];
        }

        header('Location: /adminDashboard?tab=userlogs');
        exit();
    }

} catch (\Throwable $th) {

    $_SESSION['DeviceError'] = ['Error: ' . $th->getMessage()];
    header('Location: /adminDashboard?tab=userlogs');
    exit();
}
