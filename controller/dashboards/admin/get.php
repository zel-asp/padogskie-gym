<?php

use Core\Database;


$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['admin'])) {
    abort(401);
    header('Location: /login');
    exit();
}

// Total users
$userCountStmt = $db->query("SELECT COUNT(*) AS total_users FROM users");
$userCount = $userCountStmt->fetch_one()['total_users'];

// total payment except pending status
$paymentSumStmt = $db->query("SELECT SUM(amount) AS total_payments FROM payments WHERE status != 'pending'");
$totalPayments = $paymentSumStmt->fetch_one()['total_payments'] ?? 0;

// payments
$recentPayments = $db->query("
        SELECT *
        FROM payments
        ORDER BY payment_date DESC
        LIMIT 5
    ")->find();

//for 1 person only
$recentPayment = $db->query("
        SELECT *
        FROM payments
        ORDER BY payment_date DESC
        LIMIT 1
    ")->fetch_one();

//select all users
// Get filters from query string
$search = $_GET['search'] ?? '';
$statusFilter = $_GET['status'] ?? '';
$membershipFilter = $_GET['membership'] ?? '';

$query = "
    SELECT 
        u.id AS user_id,
        p.id AS payment_id,
        u.username,
        u.email,
        u.created_at,
        p.status,
        p.membership_status,
        p.payment_date
    FROM users u
    LEFT JOIN payments p ON u.id = p.user_id
      AND p.payment_date = (
          SELECT MAX(p2.payment_date)
          FROM payments p2
          WHERE p2.user_id = u.id
      )
";

$params = [];

// filters (optional)
if (!empty($search)) {
    $query .= " WHERE u.username LIKE ? OR u.email LIKE ?";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
$users = $db->query($query, $params)->find();

// Payment query
$paymentQuery = "
    SELECT 
        p.id AS payment_id,
        u.id AS user_id,
        u.username,
        u.email,
        p.name,
        p.amount,
        p.payment_method,
        p.status,
        p.membership_status,
        p.payment_date,
        p.expiration_date
    FROM payments p
    LEFT JOIN users u ON p.user_id = u.id
    WHERE 1
";

$paymentParams = [];

// filters
if (!empty($search)) {
    $paymentQuery .= " AND (u.username LIKE ? OR u.email LIKE ? OR p.name LIKE ?)";
    $paymentParams[] = "%$search%";
    $paymentParams[] = "%$search%";
    $paymentParams[] = "%$search%";
}

if (!empty($statusFilter) && $statusFilter !== 'All') {
    // Fix: Use membership_status for Active/Pending/Expired filter
    $paymentQuery .= " AND p.membership_status = ?";
    $paymentParams[] = $statusFilter;
}

if (!empty($membershipFilter) && $membershipFilter !== 'All') {
    // Fix: Use status for Basic/Regular/Premium filter
    $paymentQuery .= " AND p.status = ?";
    $paymentParams[] = $membershipFilter;
}

$paymentQuery .= " ORDER BY p.payment_date DESC";

// fetch all payments
$payments = $db->query($paymentQuery, $paymentParams)->find();

//recent feedbakcs
$recentFeedback = $db->query("
                SELECT *
                FROM feedback
                ORDER BY created_at DESC
                LIMIT 1
            ")->find();

// Total feedback
$feedbackCountStmt = $db->query("SELECT COUNT(*) AS total_feedback FROM feedback");
$totalFeedback = $feedbackCountStmt->fetch_one()['total_feedback'];

//select all feedbacks
$allFeedback = $db->query('SELECT * FROM feedback ORDER BY created_at DESC LIMIT 20')->find();

//updated plan can be modify by admins
$plan = $db->query('SELECT * FROM membershipplans WHERE id = ?', [1])->fetch_one();

//gym info can be modify by admins
$info = $db->query('SELECT * FROM admininfo WHERE id = ?', [1])->fetch_one();

//announcement
$announcements = $db->query('SELECT * FROM announcements')->find();


view_path('dashboards/admin', 'index.php', [
    'userCount' => $userCount,
    'totalPayments' => $totalPayments,
    'totalFeedback' => $totalFeedback,
    'recentPayments' => $recentPayments,
    'recentFeedback' => $recentFeedback,
    'recentPayment' => $recentPayment,
    'users' => $users,
    'payments' => $payments,
    'allFeedback' => $allFeedback,
    'info' => $info,
    'plan' => $plan,
    'announcements' => $announcements
]);