
<?php
include __DIR__ . '/parts/products-data.php';
include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section products" id="shop">
        <div class="container">

            <div class="section-heading">
                <p class="eyebrow">Find your favorite roast</p>
                <h1>Shop Our Coffee</h1>
                <p>Explore our freshly roasted coffee collection.</p>
            </div>

            <div class="product-grid">

                <?php foreach ($products as $id => $product): ?>

                <article class="card product-card">
                    <div class="product-image <?= htmlspecialchars($product['image_class']) ?>" aria-hidden="true"></div>

                    <p class="product-origin">
                        <?= htmlspecialchars($product['origin']) ?>
                    </p>

                    <h3><?= htmlspecialchars($product['name']) ?></h3>

                    <p><?= htmlspecialchars($product['description']) ?></p>

                    <div class="card-footer">
                        <strong>$<?= number_format($product['price'], 2) ?></strong>

                        <a href="product.php?id=<?= $id ?>" class="text-link">
                            View coffee
                        </a>
                    </div>
                </article>

                <?php endforeach; ?>

            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
