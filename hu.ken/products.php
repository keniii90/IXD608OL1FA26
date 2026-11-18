
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

            <div class="coffee-controls">

<!-- Coffee Search -->
<div class="coffee-search" style="margin-bottom:30px;">

    <label for="coffee-search">
        Search Coffee
    </label>

    <input
        type="search"
        id="coffee-search"
        placeholder="Search coffee by name..."
        style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:8px;"
    >

</div>

<!-- Coffee Filter -->
<div class="coffee-filter" style="margin-bottom:30px;">

    <label for="coffee-filter">
        Filter by Coffee Type
    </label>

    <select
        id="coffee-filter"
        style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:8px;"
    >
        <option value="all">All Coffee</option>
        <option value="light">Light Roast</option>
        <option value="medium">Medium Roast</option>
        <option value="dark">Dark Roast</option>
        <option value="espresso">Espresso</option>
        <option value="decaf">Decaf</option>
    </select>

</div>

            
<!-- Coffee Sort -->
<div class="coffee-sort" style="margin-bottom:30px;">

    <label for="coffee-sort">
        Sort Coffee
    </label>

    <select
        id="coffee-sort"
        style="width:100%; padding:14px; margin-top:10px; border:1px solid #ddd; border-radius:8px;"
    >
        <option value="default">Default</option>
        <option value="price-low">Price: Low to High</option>
        <option value="price-high">Price: High to Low</option>
        <option value="name">Name: A to Z</option>
    </select>

</div>

</div>

            <div class="product-grid" id="coffee-product-grid">

                <?php foreach ($products as $id => $product): ?>

                <article class="card product-card">
                    <div class="product-image">
    <img
        src="<?= htmlspecialchars($product['image']) ?>"
        alt="<?= htmlspecialchars($product['name']) ?>"
        loading="lazy"
    >
</div>

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

<script src="js/products-api.js" defer></script>

<?php include __DIR__ . '/parts/footer.php'; ?>
