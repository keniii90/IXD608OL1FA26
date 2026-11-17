
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

// Validate customer information
if (
    $name === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    header('Location: checkout.php');
    exit;
}

// Calculate order details
$orderItems = [];
$orderSubtotal = 0;

foreach ($_SESSION['cart'] as $cartKey => $item) {

    // Skip old cart data
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

    $orderItems[] = [
        'product' => $product,
        'size' => $item['size'] ?? '12 oz',
        'grind' => $item['grind'] ?? 'Whole Bean',
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $orderSubtotal += $subtotal;
}

// Prevent empty orders
if (empty($orderItems)) {
    header('Location: cart.php');
    exit;
}

// Demo tax calculation
$taxRate = 0.0825;
$orderTax = round($orderSubtotal * $taxRate, 2);
$orderTotal = $orderSubtotal + $orderTax;

// Clear shopping cart after demo checkout
$_SESSION['cart'] = [];

include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section products">
        <div class="container">

            <div class="section-heading">

                <p class="eyebrow">
                    Morning Brew Coffee
                </p>

                <h1>Thank You!</h1>

                <p>
                    Thank you,
                    <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>!
                </p>

                <p>
                    Your order has been placed successfully.
                </p>

                <p>
                    This is a demo order confirmation.
                    No payment has been processed.
                </p>

            </div>

            <div class="card product-card">

                <h2>Order Summary</h2>

                <?php foreach ($orderItems as $item): ?>

                    <h3>
                        <?= htmlspecialchars($item['product']['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>

                    <p>
                        Size:
                        <?= htmlspecialchars($item['size'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        Grind:
                        <?= htmlspecialchars($item['grind'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        Quantity:
                        <?= (int) $item['quantity'] ?>
                    </p>

                    <p>
                        Item Subtotal:
                        $<?= number_format($item['subtotal'], 2) ?>
                    </p>

                    <hr>

                <?php endforeach; ?>

                <p>
                    Subtotal:
                    $<?= number_format($orderSubtotal, 2) ?>
                </p>

                <p>
                    Tax (8.25%):
                    $<?= number_format($orderTax, 2) ?>
                </p>

                <h2>
                    Total:
                    $<?= number_format($orderTotal, 2) ?>
                </h2>

                <p>
                    Your shopping cart has been cleared.
                </p>

                <a
                    href="index.php"
                    class="button button-primary"
                >
                    Back to Home
                </a>

            </div>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
