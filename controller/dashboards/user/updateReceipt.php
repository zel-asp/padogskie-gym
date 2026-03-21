<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config/config.php');
$db = new Database($config['database']);

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $paymentId = $input['payment_id'] ?? null;
    $receiptUrl = $input['receipt_url'] ?? null;

    if (!$paymentId || !$receiptUrl) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }

    // Verify the payment belongs to the logged-in user
    $userId = $_SESSION['user']['id'];
    $payment = $db->query("SELECT id FROM payments WHERE id = ? AND user_id = ?", [$paymentId, $userId])->find();

    if (!$payment) {
        echo json_encode(['success' => false, 'message' => 'Payment not found']);
        exit();
    }

    // Update the receipt URL
    $db->query("UPDATE payments SET receipt_url = ? WHERE id = ?", [$receiptUrl, $paymentId]);

    echo json_encode(['success' => true, 'message' => 'Receipt uploaded successfully']);
    exit();
}