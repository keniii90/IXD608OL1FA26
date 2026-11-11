
<?php

// Connect to MySQL database
require_once __DIR__ . '/db.php';

// Get all products from database
$sql = "SELECT * FROM products ORDER BY id ASC";
$result = $conn->query($sql);

if (!$result) {
    error_log("Product query failed: " . $conn->error);
    http_response_code(500);
    exit("Unable to load products.");
}

$products = [];

while ($row = $result->fetch_assoc()) {
    $id = (int) $row['id'];

    $products[$id] = [
        'name' => $row['name'],
        'description' => $row['description'] ?? '',
        'price' => (float) $row['price'],
        'image' => $row['image'] ?? '',
        'category' => $row['category'] ?? '',
        'stock' => (int) $row['stock'],
        'origin' => $row['category'] ?? 'Coffee',
        'image_class' => match (true) {
    str_contains(strtolower($row['name']), 'light') => 'roast-light',
    str_contains(strtolower($row['name']), 'breakfast') => 'roast-light',
    str_contains(strtolower($row['name']), 'ethiopian') => 'roast-light',

    str_contains(strtolower($row['name']), 'dark') => 'roast-dark',
    str_contains(strtolower($row['name']), 'espresso') => 'roast-dark',
    str_contains(strtolower($row['name']), 'french') => 'roast-dark',

    default => 'roast-medium'
}
    ];
}

$result->free();
$conn->close();
