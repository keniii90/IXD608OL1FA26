
<?php
require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Handle removing products from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['remove_id'])) {

    $removeId = filter_input(
        INPUT_POST,
        'remove_id',
        FILTER_VALIDATE_INT
    );

    if ($removeId) {
        unset($_SESSION['cart'][$removeId]);
    }

    header('Location: cart.php');
    exit;
}

// Calculate cart total
$cartItems = [];
$cartTotal = 0;

foreach ($_SESSION['cart'] as $id => $quantity) {

    if (!isset($products[$id])) {
        continue;
    }

    $product = $products[$id];
    $subtotal = $product['price'] * $quantity;

    $cartItems[] = [
        'id' => $id,
        'product' => $product,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $cartTotal += $subtotal;
}

include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section products">
        <div class="container">

            <div class="section-heading">
                <p class="eyebrow">Almost there</p>
                <h1>Your Shopping Cart</h1>
                <p>Review your coffee before checkout.</p>
            </div>

            <?php if (!empty($cartItems)): ?>

                <div class="product-grid">

                    <?php foreach ($cartItems as $item): ?>
                        <article class="card product-card">

                            <div class="product-image <?= htmlspecialchars($item['product']['image_class']) ?>"
                                 aria-hidden="true">
                            </div>

                            <p class="product-origin">
                                <?= htmlspecialchars($item['product']['origin']) ?>
                            </p>

                            <h3>
                                <?= htmlspecialchars($item['product']['name']) ?>
                            </h3>

                            <p>
                                Quantity: <?= (int) $item['quantity'] ?>
                            </p>

                            <p>
                                Price:
                                $<?= number_format($item['product']['price'], 2) ?>
                            </p>

                            <h3>
                                Subtotal:
                                $<?= number_format($item['subtotal'], 2) ?>
                            </h3>

                            <form action="cart.php" method="post">
                                <input
                                    type="hidden"
                                    name="remove_id"
                                    value="<?= (int) $item['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="button button-primary">
                                    Remove
                                </button>
                            </form>

                        </article>
                    <?php endforeach; ?>

                </div>

                <div class="section-heading">
                    <h2>
                        Cart Total:
                        $<?= number_format($cartTotal, 2) ?>
                    </h2>

                    <a href="products.php"
                       class="text-link">
                        Continue Shopping
                    </a>

                    <p>
                        <a href="checkout.php"
                           class="button button-primary">
                            Proceed to Checkout
                        </a>
                    </p>
                </div>

            <?php else: ?>

                <div class="section-heading">
                    <h2>Your cart is empty</h2>
                    <p>Find your favorite coffee to get started.</p>

                    <a href="products.php"
                       class="button button-primary">
                        Continue Shopping
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
