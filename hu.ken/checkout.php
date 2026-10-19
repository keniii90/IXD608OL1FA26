
<?php
include __DIR__ . '/parts/products-data.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = $products[$id] ?? null;

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

            <?php if ($product): ?>

                <div class="card product-card">
                    <h2>Order Summary</h2>

                    <p>
                        <?= htmlspecialchars($product['name']) ?>
                    </p>

                    <h3>
                        Total: $<?= number_format($product['price'], 2) ?>
                    </h3>
                </div>

                <form class="newsletter-form"
                      action="confirmation.php"
                      method="get">

                    <input type="hidden"
                           name="id"
                           value="<?= $id ?>">

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

                <h2>No product selected</h2>
                <a href="products.php"
                   class="button button-primary">
                    Back to Shop
                </a>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
