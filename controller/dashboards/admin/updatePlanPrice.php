<?php

use Core\Database;

$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['admin'])) {
    header('Location: /login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan = $_POST['plan_name'] ?? '';
    $price = $_POST['price'] ?? '';

    $allowedPlans = ['Basic', 'Regular', 'Premium'];

    if (in_array($plan, $allowedPlans) && is_numeric($price) && $price >= 0) {
        try {

            $currentPlan = $db->query('SELECT id, `' . $plan . '` FROM membershipplans LIMIT 1')->fetch_one();

            if (!$currentPlan) {
                $db->query("INSERT INTO membershipplans (Basic, Regular, Premium) VALUES (350, 700, 2000)");
                $_SESSION['success'] = "Default membership plan created!";
            } else {
                if ($currentPlan[$plan] != $price) {

                    $planId = $currentPlan['id'];
                    $db->query("UPDATE membershipplans SET `$plan` = ? WHERE id = ?", [floatval($price), $planId]);
                    $_SESSION['success'] = "{$plan} plan price updated from ₱{$currentPlan[$plan]} to ₱{$price}!";
                } else {
                    $_SESSION['error'] = "The price is already ₱{$price}. No changes needed.";
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Failed to update plan: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Invalid plan name or price value.";
    }

    header("Location: /adminDashboard?tab=settings");
    exit();
}