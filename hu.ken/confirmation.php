
<?php
include __DIR__ . '/parts/products-data.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = $products[$id] ?? null;

$name = trim($_GET['name'] ?? 'Customer');

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
                    <?= htmlspecialchars($name) ?>!
                </p>

                <p>
                    This is a demo order confirmation.
                </p>

                <?php if ($product): ?>

                    <h2>Order Summary</h2>

                    <p>
                        <?= htmlspecialchars($product['name']) ?>
                    </p>

                    <h3>
                        Total: $<?= number_format($product['price'], 2) ?>
                    </h3>

                <?php endif; ?>

                <a href="index.php"
                   class="button button-primary">
                    Back to Home
                </a>

            </div>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
