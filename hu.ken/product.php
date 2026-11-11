
<?php
include __DIR__ . '/parts/products-data.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = $products[$id] ?? null;

include __DIR__ . '/parts/header.php';
?>

<main>
    <section class="section products">
        <div class="container">

            <?php if ($product): ?>

                <div class="section-heading">
                    <p class="eyebrow">Freshly roasted coffee</p>
                    <h1><?= htmlspecialchars($product['name']) ?></h1>
                </div>

                <div class="product-grid">

                    <div class="card product-card">
                        
<div
    id="product-preview"
    class="product-image <?= htmlspecialchars($product['image_class']) ?>"
    role="img"
    aria-label="Coffee product illustration">
</div>

<div class="roast-selector">
    <p>Preview coffee styles:</p>

    <button type="button"
            class="roast-option"
            data-roast="roast-light"
            aria-pressed="false">
        Light
    </button>

    <button type="button"
            class="roast-option"
            data-roast="roast-medium"
            aria-pressed="false">
        Medium
    </button>

    <button type="button"
            class="roast-option"
            data-roast="roast-dark"
            aria-pressed="false">
        Dark
    </button>
</div>

                    </div>

                    <div class="product-details">
                        <p class="eyebrow">
                            <?= htmlspecialchars($product['origin']) ?>
                        </p>

                        <h2><?= htmlspecialchars($product['name']) ?></h2>

                        <p>
                            <?= htmlspecialchars($product['description']) ?>
                        </p>

                        <h3>
                            $<?= number_format($product['price'], 2) ?>
                        </h3>

                        
<form action="add-to-cart.php" method="post">
    <input
        type="hidden"
        name="id"
        value="<?= (int) $id ?>"
    >

    <button
        type="submit"
        class="button button-primary">
        Add to Cart
    </button>
</form>


                        <p>
                            <a href="products.php" class="text-link">
                                Back to Shop
                            </a>
                        </p>
                    </div>

                </div>

            <?php else: ?>

                <div class="section-heading">
                    <h1>Product Not Found</h1>
                    <p>Sorry, this coffee is not available.</p>
                    <a href="products.php" class="button button-primary">
                        Back to Shop
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>
</main>


<script src="js/product.js" defer></script>

<?php include __DIR__ . '/parts/footer.php'; ?>
