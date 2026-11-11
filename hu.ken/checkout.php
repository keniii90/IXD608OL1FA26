
<?php
require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Get all products in the cart
$cartItems = [];
$cartTotal = 0;

foreach ($_SESSION['cart'] as $id => $quantity) {
    if (!isset($products[$id]) || $quantity <= 0) {
        continue;
    }

    $product = $products[$id];
    $subtotal = $product['price'] * $quantity;

    $cartItems[] = [
        'product' => $product,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $cartTotal += $subtotal;
}

include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section newsletter">
        <div class="container">

            <div class="section-heading">
                <p class="eyebrow">Almost finished</p>
                <h1>Checkout</h1>
                <p>Complete your information below.</p>
            </div>

            <?php if (!empty($cartItems)): ?>

                <div class="card product-card">
                    <h2>Order Summary</h2>

                    <?php foreach ($cartItems as $item): ?>
                        <p>
                            <?= htmlspecialchars($item['product']['name']) ?>
                            × <?= (int) $item['quantity'] ?>
                            —
                            $<?= number_format($item['subtotal'], 2) ?>
                        </p>
                    <?php endforeach; ?>

                    <h3>
                        Total: $<?= number_format($cartTotal, 2) ?>
                    </h3>
                </div>

                <form class="newsletter-form"
                      action="confirmation.php"
                      method="post">

                    <label for="customer-name">
                        Full Name
                    </label>

                    <input type="text"
                           id="customer-name"
                           name="name"
                           placeholder="Your full name"
                           required>

                    <label for="customer-email">
                        Email Address
                    </label>

                    <input type="email"
                           id="customer-email"
                           name="email"
                           placeholder="Your email"
                           required>

                    <button class="button button-primary"
                            type="submit">
                        Place Order
                    </button>

                </form>

            <?php else: ?>

                <div class="section-heading">
                    <h2>Your cart is empty</h2>
                    <p>Add some coffee before checking out.</p>

                    <a href="products.php"
                       class="button button-primary">
                        Back to Shop
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
