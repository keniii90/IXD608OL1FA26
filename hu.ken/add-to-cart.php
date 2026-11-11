
<?php

require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products.php');
    exit;
}

// Get product ID
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Check that the product exists
if (!$id || !isset($products[$id])) {
    header('Location: products.php');
    exit;
}

// Add product to cart
if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
}

$_SESSION['cart'][$id]++;

// Redirect to shopping cart
header('Location: cart.php');
exit;
