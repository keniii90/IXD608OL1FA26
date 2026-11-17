
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

// Check product exists
if (!$id || !isset($products[$id])) {
    header('Location: products.php');
    exit;
}

// Get selected options
$size = $_POST['size'] ?? '12 oz';
$grind = $_POST['grind'] ?? 'Whole Bean';
$quantity = filter_input(
    INPUT_POST,
    'quantity',
    FILTER_VALIDATE_INT
);

// Validate options
$validSizes = ['12 oz', '16 oz', '32 oz'];
$validGrinds = ['Whole Bean', 'Ground'];

if (
    !in_array($size, $validSizes, true) ||
    !in_array($grind, $validGrinds, true) ||
    !$quantity ||
    $quantity < 1 ||
    $quantity > 10
) {
    header('Location: product.php?id=' . $id);
    exit;
}

// Create unique cart key for each product option
$cartKey = $id . '_' .
           str_replace(' ', '', $size) . '_' .
           str_replace(' ', '', $grind);

// Add product to cart
if (!isset($_SESSION['cart'][$cartKey])) {

    $_SESSION['cart'][$cartKey] = [
        'id' => $id,
        'size' => $size,
        'grind' => $grind,
        'quantity' => 0
    ];

}

// Update quantity
$_SESSION['cart'][$cartKey]['quantity'] += $quantity;

// Redirect to cart
header('Location: cart.php');
exit;
