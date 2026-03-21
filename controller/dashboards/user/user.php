<?php

use Core\Database;

$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit();
}

$username = $_SESSION['user']['username'];
$userId = $_SESSION['user']['id'];
$token = $_SESSION['user']['token'];

$stmt = $db->query('SELECT session_token FROM users WHERE id = ?', [$userId]);
$dbUser = $stmt->fetch_one();

if (!$dbUser || $dbUser['session_token'] !== $token) {
    session_destroy();
    header('Location: /login');
    exit();
}

//feedback
$feedback = $db->query('SELECT name, feedback_text, rating, admin_reply FROM feedback ORDER BY created_at DESC LIMIT 15')->find();

//membership
$info = $db->query('SELECT * FROM user_profiles WHERE user_id = ?', [$userId])->fetch_one();

//payment
$paymentInfo = $db->query('SELECT * FROM payments WHERE user_id = ?', [$userId])->fetch_one();

$expiryDate = null;

if ($paymentInfo) {
    $paymentDate = new DateTime($paymentInfo['payment_date']);
    $now = new DateTime();

    // Determine validity based on plan/status
    $daysValid = match ($paymentInfo['status'] ?? '') {
        'Basic' => 15,
        'Regular' => 30,
        'Premium' => 90,
        'Pending' => 0,
        default => 0
    };

    //calculate the exp date
    $expiryDate = (clone $paymentDate)->modify("+{$daysValid} days");

    // update expiration date regardless of status
    if (!$paymentInfo['expiration_date'] || $paymentInfo['expiration_date'] === '0000-00-00') {
        $expiryDateStr = $expiryDate->format('Y-m-d');

        $db->query("UPDATE payments SET expiration_date = ? WHERE id = ?", [
            $expiryDateStr,
            $paymentInfo['id']
        ]);

        $paymentInfo['expiration_date'] = $expiryDateStr;
        $_SESSION['expiration_date'] = $expiryDateStr;
    }

    if ($now > $expiryDate && $paymentInfo['status'] !== 'Expired') {
        $db->query("UPDATE payments SET status = 'Expired' WHERE id = ?", [
            $paymentInfo['id']
        ]);
        $paymentInfo['status'] = 'Expired';
    }
}

//updated plan can be modify by admins - with fallback
$planResult = $db->query('SELECT * FROM membershipplans WHERE id = ?', [1])->fetch_one();

// If no plan found, set default values
if (!$planResult) {
    $plan = [
        'Basic' => 350,
        'Regular' => 700,
        'Premium' => 2000
    ];
} else {
    $plan = $planResult;
}

//announcement
$announcements = $db->query('SELECT * FROM announcements ORDER BY id DESC LIMIT 2')->find();

view_path('dashboards/user', 'index.php', [
    'username' => $username,
    'feedback' => $feedback,
    'info' => $info,
    'expiryDate' => $expiryDate,
    'paymentInfo' => $paymentInfo,
    'plan' => $plan,
    'announcements' => $announcements
]);