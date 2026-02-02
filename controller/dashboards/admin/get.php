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




/**
 * -------------------------------------------------
 * 1STATS OVERVIEW (Last 30 days)
 * -------------------------------------------------
 */

$totalLoginsResult = $db->query(
    "SELECT COUNT(*) AS total
    FROM login_logs
    WHERE status = 'success' AND created_at >= NOW() - INTERVAL 30 DAY"
)->find();

$totalLogins = $totalLoginsResult[0]['total'] ?? 0;

// Failed attempts
$failedLoginsResult = $db->query(
    "SELECT COUNT(*) AS total
    FROM login_logs
    WHERE status = 'error'
    AND created_at >= NOW() - INTERVAL 30 DAY"
)->find();
$failedLogins = $failedLoginsResult[0]['total'] ?? 0;

// Locked accounts
$lockedAccountsResult = $db->query(
    "SELECT COUNT(*) AS total
    FROM login_logs
    WHERE account_status = 'locked'
    AND created_at >= NOW() - INTERVAL 30 DAY"
)->find();
$lockedAccounts = $lockedAccountsResult[0]['total'] ?? 0;

// Failed percentage
$failedPercentage = $totalLogins > 0 ? round(($failedLogins / $totalLogins) * 100) : 0;

// Locked today (new locked accounts today)
$lockedTodayResult = $db->query(
    "SELECT COUNT(*) AS total
    FROM login_logs
    WHERE account_status = 'locked'
    AND DATE(created_at) = CURDATE()"
)->find();
$lockedToday = $lockedTodayResult['total'] ?? 0;


/**
 * -------------------------------------------------
 * DEVICE & BROWSER SUMMARY (Windows)
 * -------------------------------------------------
 */

$deviceSummary = $db->query("
    SELECT
        user_agent,
        account_status,
        COUNT(*) AS total_logs,
        SUM(status = 'success') AS total_success,
        SUM(status = 'error') AS total_error,
        SUM(account_status = 'locked') AS total_locked
    FROM login_logs
    GROUP BY user_agent
")->find();

$lockedChart = $deviceSummary ? 1 : 0;


/**
 * -------------------------------------------------
 * BAR CHART – LAST 7 DAYS
 * -------------------------------------------------
 */

$chartData = $db->query(
    "SELECT
        DATE(created_at) AS log_date,
        SUM(status = 'success') AS success,
        SUM(status = 'error') AS error,
        SUM(account_status = 'locked') AS locked
    FROM login_logs
    WHERE created_at >= CURDATE() - INTERVAL 6 DAY
    GROUP BY log_date
    ORDER BY log_date ASC"
)->find();

// Prepare chart data
$chartLabels = [];
$chartSuccess = [];
$chartError = [];

foreach ($chartData as $day) {
    $date = new DateTime($day['log_date']);
    $chartLabels[] = $date->format('D'); // Short day name
    $chartSuccess[] = $day['success'] ?? 0;
    $chartError[] = $day['error'] ?? 0;
}

// find date range for display
$firstDate = !empty($chartData) ? new DateTime($chartData[0]['log_date']) : new DateTime();
$lastDate = !empty($chartData) ? new DateTime(end($chartData)['log_date']) : new DateTime();
$dateRange = $firstDate->format('M j') . ' - ' . $lastDate->format('M j');

$recentLogs = $db->query(
    "SELECT
        l.id,
        u.email,
        u.id AS user_id,
        l.status,
        l.account_status,
        l.message,
        l.user_agent,
        l.ip_address,
        l.created_at
    FROM login_logs l
    LEFT JOIN users u ON u.id = l.user_id
    ORDER BY l.created_at DESC
    LIMIT 20"
)->find();

// Process recent logs for display
$processedLogs = [];
foreach ($recentLogs as $log) {
    $log['display_email'] = $log['email'] ?? 'unknown@system.com';
    $log['user_id_display'] = $log['user_id'] ? 'ID: ' . str_pad($log['user_id'], 3, '0', STR_PAD_LEFT) : 'Unknown';
    $log['time_ago'] = timeAgo($log['created_at']);
    $log['time_formatted'] = date('H:i:s', strtotime($log['created_at']));
    $log['device_info'] = parseUserAgent($log['user_agent']);

    $processedLogs[] = $log;
}

function timeAgo($datetime)
{
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;

    if ($diff < 60)
        return 'Just now';
    if ($diff < 3600)
        return floor($diff / 60) . ' min ago';
    if ($diff < 86400)
        return floor($diff / 3600) . ' hours ago';
    if ($diff < 604800)
        return floor($diff / 86400) . ' days ago';
    return date('M j, Y', $time);
}

function parseUserAgent($userAgent)
{
    if (stripos($userAgent, 'Windows') !== false) {
        return ['os' => 'Windows', 'browser' => 'Chrome/Firefox/Edge', 'icon' => 'fab fa-windows', 'color' => 'blue-400'];
    } elseif (stripos($userAgent, 'Linux') !== false) {
        return ['os' => 'Linux', 'browser' => 'Firefox', 'icon' => 'fab fa-linux', 'color' => 'orange-400'];
    } elseif (stripos($userAgent, 'Mac') !== false || stripos($userAgent, 'OS X') !== false) {
        return ['os' => 'macOS', 'browser' => 'Safari', 'icon' => 'fab fa-apple', 'color' => 'gray-400'];
    } elseif (stripos($userAgent, 'Android') !== false) {
        return ['os' => 'Android', 'browser' => 'Mobile', 'icon' => 'fab fa-android', 'color' => 'green-400'];
    } elseif (stripos($userAgent, 'Python') !== false || stripos($userAgent, 'curl') !== false) {
        return ['os' => 'Script', 'browser' => 'Python Script', 'icon' => 'fas fa-robot', 'color' => 'red-400'];
    } else {
        return ['os' => 'Unknown', 'browser' => 'Unknown', 'icon' => 'fas fa-question', 'color' => 'gray-400'];
    }
}

// Locked devices total count
// Locked devices count by date
$chartLocked = $db->query("
    SELECT 
        COUNT(*) as count
    FROM locked_devices
")->find();

// Locked devices total count
$lockedDeviceQuery = $db->query("
    SELECT COUNT(id) AS total
    FROM locked_devices
    WHERE status = 'locked'
");

// Handle based on your Database class method
if (method_exists($lockedDeviceQuery, 'fetch_one')) {
    $lockedDeviceResult = $lockedDeviceQuery->fetch_one();
    $lockedDeviceTotal = $lockedDeviceResult ? (int) $lockedDeviceResult['total'] : 0;
} else {
    $lockedDeviceResult = $lockedDeviceQuery->find();
    $lockedDeviceTotal = isset($lockedDeviceResult[0]) ? (int) $lockedDeviceResult[0]['total'] : 0;
}

// Locked devices today (last 24 hours)
$newTodayQuery = $db->query("
    SELECT COUNT(id) AS total
    FROM locked_devices
    WHERE status = 'locked'
    AND created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
");

if (method_exists($newTodayQuery, 'fetch_one')) {
    $newTodayResult = $newTodayQuery->fetch_one();
    $newTodayTotal = $newTodayResult ? (int) $newTodayResult['total'] : 0;
} else {
    $newTodayResult = $newTodayQuery->find();
    $newTodayTotal = isset($newTodayResult[0]) ? (int) $newTodayResult[0]['total'] : 0;
}

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
    'announcements' => $announcements,
    'totalLogins' => $totalLogins,
    'failedLogins' => $failedLogins,
    'failedPercentage' => $failedPercentage,
    'lockedAccounts' => $lockedAccounts,
    'lockedToday' => $lockedToday,
    'deviceSummary' => $deviceSummary,
    'chartLabels' => $chartLabels,
    'chartSuccess' => $chartSuccess,
    'chartError' => $chartError,
    'chartLocked' => $chartLocked,
    'dateRange' => $dateRange,
    'recentLogs' => $processedLogs,
    'lockedDevice' => $lockedDeviceTotal,
    'newToday' => $newTodayTotal,
]);
?>