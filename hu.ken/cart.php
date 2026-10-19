
<?php
include __DIR__ . '/parts/products-data.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = $products[$id] ?? null;

$quantity = 1;
$subtotal = $product ? $product['price'] * $quantity : 0;

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

            <?php if ($product): ?>

                <div class="product-grid">
                    <article class="card product-card">

                        <div class="product-image <?= htmlspecialchars($product['image_class']) ?>"
                             aria-hidden="true">
                        </div>

                        <p class="product-origin">
                            <?= htmlspecialchars($product['origin']) ?>
                        </p>

                        <h3><?= htmlspecialchars($product['name']) ?></h3>

                        <p>Quantity: <?= $quantity ?></p>

                        <p>
                            Price: $<?= number_format($product['price'], 2) ?>
                        </p>

                        <h3>
                            Subtotal: $<?= number_format($subtotal, 2) ?>
                        </h3>

                        <a href="checkout.php?id=<?= $id ?>"
                           class="button button-primary">
                            Proceed to Checkout
                        </a>
                    </article>
                </div>

            <?php else: ?>

                <div class="section-heading">
                    <h2>Your cart is empty</h2>
                    <p>Find your favorite coffee to get started.</p>
                    <a href="products.php" class="button button-primary">
                        Continue Shopping
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
