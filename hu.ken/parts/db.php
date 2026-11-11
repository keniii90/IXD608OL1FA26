<?php

// MySQL database connection
$config = require __DIR__ . '/db-config.php';

$conn = new mysqli(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['database']
);

if ($conn->connect_error) {
    error_log($conn->connect_error);
    http_response_code(500);
    exit("Database connection failed.");
}

$conn->set_charset("utf8mb4");