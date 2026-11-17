
<?php
require_once __DIR__ . '/session.php';

// Calculate total cart quantity
$cartCount = 0;

foreach ($_SESSION['cart'] as $item) {

    if (is_array($item)) {
        $cartCount += (int) ($item['quantity'] ?? 0);
    } elseif (is_numeric($item)) {
        $cartCount += (int) $item;
    }

}
?>

<nav class="site-nav" aria-label="Main navigation">

    <a href="index.php">Home</a>

    <a href="products.php">Shop</a>

    <a href="index.php#about">About</a>

    <a href="index.php#contact">Contact</a>

    <a class="cart-link" href="cart.php">
        Cart (<?= $cartCount ?>)
    </a>

</nav>
