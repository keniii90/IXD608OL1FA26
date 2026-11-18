
<?php

require_once __DIR__ . '/parts/products-data.php';

// Tell browser this is JSON data
header('Content-Type: application/json; charset=utf-8');

// Prepare product data
$productList = [];

foreach ($products as $id => $product) {

    $productList[] = [
        'id' => (int) $id,
        'name' => $product['name'],
        'description' => $product['description'],
        'price' => (float) $product['price'],
        'image' => $product['image'],
        'origin' => $product['origin'] ?? '',
        'category' => $product['category'] ?? ''
    ];

}

// Return JSON
echo json_encode(
    $productList,
    JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE
);
