<?php

use Core\Database;
use Core\Response;

header('Content-Type: application/json');

try {
    $config = require base_path('config/config.php');
    $db = new Database($config['database']);

    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

    $stmt = $db->query("
        SELECT user_agent, COUNT(*) AS attempt_count
        FROM login_logs
        WHERE status = 'error'
        AND user_agent = ?
        AND created_at >= (NOW() - INTERVAL 30 SECOND)
        GROUP BY user_agent
    ", [$userAgent]);

    echo json_encode([
        'success' => true,
        'data' => $stmt->find()
    ]);

} catch (Throwable $e) {
    http_response_code(Response::SERVER_ERROR);
    echo json_encode([
        'success' => false,
        'message' => 'Server Error, please try again later'
    ]);
}
