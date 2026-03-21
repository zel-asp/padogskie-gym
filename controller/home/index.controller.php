<?php

use Core\Database;

$config = require base_path('config/config.php');

$db = new Database($config['database']);

$info = $db->query('SELECT * FROM admininfo WHERE id = ?', [1])->fetch_one();

$plan = $db->query('SELECT * FROM membershipplans WHERE id = ?', [1])->fetch_one();

if (!$plan) {

    $plan = [
        'Basic' => '0',
        'Regular' => '0',
        'Premium' => '0'
    ];

    error_log("No membership plan found with id=1");
}

view_path('home', 'index.php', [
    'info' => $info,
    'plan' => $plan
]);