
<?php
require_once __DIR__ . '/parts/products-data.php';

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
                    <h1>
                        <?= htmlspecialchars($product['name']) ?>
                    </h1>
                </div>

                <div class="product-grid">

                    <!-- Product Image -->
                    <div class="card product-card">

                        
<img
    id="product-preview"
    src="/images/products/<?= htmlspecialchars(basename($product['image']), ENT_QUOTES, 'UTF-8') ?>"
    alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
    style="display:block; width:100%; height:350px; object-fit:contain; border-radius:12px;"
>


                    </div>

                    <!-- Product Details -->
                    <div class="product-details">

                        <p class="eyebrow">
                            <?= htmlspecialchars($product['origin'] ?? '') ?>
                        </p>

                        <h2>
                            <?= htmlspecialchars($product['name']) ?>
                        </h2>

                        <p>
                            <?= htmlspecialchars($product['description']) ?>
                        </p>

                        <h3>
                            $<?= number_format($product['price'], 2) ?>
                        </h3>

                        <!-- Add to Cart Form -->
                        <form action="add-to-cart.php" method="post">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $id ?>"
                            >

                            <!-- Coffee Size -->
                            <div class="product-option">
                                <label for="coffee-size">
                                    Coffee Size
                                </label>

                                <select
                                    id="coffee-size"
                                    name="size"
                                    required
                                >
                                    <option value="12 oz">12 oz</option>
                                    <option value="16 oz">16 oz</option>
                                    <option value="32 oz">32 oz</option>
                                </select>
                            </div>

                            <!-- Grind Type -->
                            <div class="product-option">
                                <label for="grind-type">
                                    Grind Type
                                </label>

                                <select
                                    id="grind-type"
                                    name="grind"
                                    required
                                >
                                    <option value="Whole Bean">
                                        Whole Bean
                                    </option>
                                    <option value="Ground">
                                        Ground
                                    </option>
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="product-option">
                                <label for="quantity">
                                    Quantity
                                </label>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    min="1"
                                    max="10"
                                    value="1"
                                    required
                                >
                            </div>

                            <button
                                type="submit"
                                class="button button-primary"
                            >
                                Add to Cart
                            </button>

                        </form>

                        <p>
                            <a
                                href="products.php"
                                class="text-link"
                            >
                                Back to Shop
                            </a>
                        </p>

                    </div>

                </div>

            <?php else: ?>

                <div class="section-heading">
                    <h1>Product Not Found</h1>

                    <p>
                        Sorry, this coffee is not available.
                    </p>

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
