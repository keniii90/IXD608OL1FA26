
<?php
require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Only accept checkout form submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit;
}

// Get customer information
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: checkout.php');
    exit;
}

// Calculate order details
$orderItems = [];
$orderTotal = 0;

foreach ($_SESSION['cart'] as $id => $quantity) {
    if (!isset($products[$id]) || $quantity <= 0) {
        continue;
    }

    $product = $products[$id];
    $subtotal = $product['price'] * $quantity;

    $orderItems[] = [
        'product' => $product,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $orderTotal += $subtotal;
}

// Prevent empty orders
if (empty($orderItems)) {
    header('Location: cart.php');
    exit;
}

// Clear cart after creating demo confirmation
$_SESSION['cart'] = [];

include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section products">
        <div class="container">

            <div class="section-heading">
                <p class="eyebrow">Morning Brew Coffee</p>
                <h1>Thank You!</h1>

                <p>
                    Thank you,
                    <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>!
                </p>

                <p>
                    This is a demo order confirmation.
                    No payment has been processed.
                </p>
            </div>

            <div class="card product-card">
                <h2>Order Summary</h2>

                <?php foreach ($orderItems as $item): ?>
                    <p>
                        <?= htmlspecialchars($item['product']['name'], ENT_QUOTES, 'UTF-8') ?>
                        × <?= (int) $item['quantity'] ?>
                        —
                        $<?= number_format($item['subtotal'], 2) ?>
                    </p>
                <?php endforeach; ?>

                <h3>
                    Total: $<?= number_format($orderTotal, 2) ?>
                </h3>

                <p>
                    Your cart has been cleared.
                </p>

                <a href="index.php"
                   class="button button-primary">
                    Back to Home
                </a>
            </div>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
