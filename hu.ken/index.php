
<?php include __DIR__ . '/parts/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container grid-12 hero-grid">
            <div class="hero-content">
                <p class="eyebrow">Freshly roasted in small batches</p>
                <h1>Better Coffee,<br>Better Mornings.</h1>
                <p class="hero-copy">Discover thoughtfully sourced coffee, roasted for a smooth and memorable cup every morning.</p>
                <a href="products.php" class="button button-primary">Shop Coffee</a>
            </div>

            <div class="hero-art" role="img" aria-label="A cup of freshly brewed coffee">
                <div class="saucer">
                    <div class="cup">
                        <div class="coffee"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section products" id="shop">
        <div class="container">
            <div class="section-heading">
                <p class="eyebrow">Find your favorite roast</p>
                <h2>Featured Coffee</h2>
                <p>Three distinct coffees for three different kinds of mornings.</p>
            </div>

            <div class="product-grid">

                <!-- Light Roast -->
                <article class="card product-card">
                    <div class="product-image roast-light" aria-hidden="true"></div>
                    <p class="product-origin">Ethiopia</p>
                    <h3>Light Roast</h3>
                    <p>Bright, fruity and smooth with floral and citrus notes.</p>
                    <div class="card-footer">
                        <strong>$18</strong>
                        <a href="product.php?id=1" class="text-link">View coffee</a>
                    </div>
                </article>

                <!-- Medium Roast -->
                <article class="card product-card">
                    <div class="product-image roast-medium" aria-hidden="true"></div>
                    <p class="product-origin">Colombia</p>
                    <h3>Medium Roast</h3>
                    <p>Balanced and comforting with chocolate and caramel notes.</p>
                    <div class="card-footer">
                        <strong>$16</strong>
                        <a href="product.php?id=2" class="text-link">View coffee</a>
                    </div>
                </article>

                <!-- Espresso Blend -->
                <article class="card product-card">
                    <div class="product-image roast-dark" aria-hidden="true"></div>
                    <p class="product-origin">House Blend</p>
                    <h3>Espresso Blend</h3>
                    <p>Rich and bold with a deep aroma and a smooth finish.</p>
                    <div class="card-footer">
                        <strong>$17</strong>
                        <a href="product.php?id=3" class="text-link">View coffee</a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- Promotion -->
    <section class="sale" aria-label="First order promotion">
        <div class="container sale-layout">
            <div>
                <p class="eyebrow eyebrow-light">Welcome offer</p>
                <h2>20% Off Your First Order</h2>
            </div>
            <p>Use code <strong>WELCOME20</strong> at checkout.</p>
            <a class="button button-light" href="products.php">Start Shopping</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="section about" id="about">
        <div class="container grid-12 about-grid">
            <div class="about-art">
                <span>Small batch</span>
                <span>Fresh roast</span>
                <span>Better cup</span>
            </div>

            <div class="about-copy">
                <p class="eyebrow">Our story</p>
                <h2>Simple coffee, carefully made.</h2>
                <p>Morning Brew Coffee focuses on fresh, great-tasting coffee without unnecessary complexity. We source quality beans and roast them in small batches so every bag arrives at its best.</p>
                <a class="text-link" href="#contact">Learn more about us</a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="section newsletter" id="contact">
        <div class="container newsletter-inner">
            <p class="eyebrow">Stay in the loop</p>
            <h2>Join Our Newsletter</h2>
            <p>Get updates about new coffee, brewing tips and special offers.</p>

            <form class="newsletter-form">
                <label class="sr-only" for="email">Email address</label>
                <input id="email" type="email" placeholder="Enter your email" required>
                <button class="button button-primary" type="submit">Subscribe</button>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
