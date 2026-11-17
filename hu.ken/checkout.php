
<?php
require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Calculate order items
$cartItems = [];
$cartSubtotal = 0;

foreach ($_SESSION['cart'] as $cartKey => $item) {

    if (!is_array($item)) {
        continue;
    }

    $id = (int) ($item['id'] ?? 0);
    $quantity = (int) ($item['quantity'] ?? 0);

    if (!isset($products[$id]) || $quantity <= 0) {
        continue;
    }

    $product = $products[$id];
    $subtotal = $product['price'] * $quantity;

    $cartItems[] = [
        'product' => $product,
        'size' => $item['size'] ?? '12 oz',
        'grind' => $item['grind'] ?? 'Whole Bean',
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $cartSubtotal += $subtotal;
}

// Demo tax calculation
$taxRate = 0.0825;
$cartTax = round($cartSubtotal * $taxRate, 2);
$cartTotal = $cartSubtotal + $cartTax;

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
                            <strong>
                                <?= htmlspecialchars($item['product']['name']) ?>
                            </strong>
                        </p>

                        <p>
                            Size:
                            <?= htmlspecialchars($item['size']) ?>
                            |
                            Grind:
                            <?= htmlspecialchars($item['grind']) ?>
                        </p>

                        <p>
                            Quantity:
                            <?= (int) $item['quantity'] ?>
                            —
                            $<?= number_format($item['subtotal'], 2) ?>
                        </p>

                        <hr>

                    <?php endforeach; ?>

                    <p>
                        Subtotal:
                        $<?= number_format($cartSubtotal, 2) ?>
                    </p>

                    <p>
                        Tax (8.25%):
                        $<?= number_format($cartTax, 2) ?>
                    </p>

                    <h3>
                        Total:
                        $<?= number_format($cartTotal, 2) ?>
                    </h3>
                </div>

                <form
                    class="newsletter-form"
                    action="confirmation.php"
                    method="post"
                >

                    <label for="customer-name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="customer-name"
                        name="name"
                        placeholder="Your full name"
                        required
                    >

                    <label for="customer-email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="customer-email"
                        name="email"
                        placeholder="Your email"
                        required
                    >

                    <button
                        class="button button-primary"
                        type="submit"
                    >
                        Place Order
                    </button>

                </form>

            <?php else: ?>

                <div class="section-heading">
                    <h2>Your cart is empty</h2>

                    <p>Add some coffee before checking out.</p>

                    <a
                        href="products.php"
                        class="button button-primary"
                    >
                        Back to Shop
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
