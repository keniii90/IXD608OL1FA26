
<?php
require_once __DIR__ . '/parts/session.php';
require_once __DIR__ . '/parts/products-data.php';

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cartKey = $_POST['cart_key'] ?? '';

    if (isset($_SESSION['cart'][$cartKey])) {

        // Remove item
        if (isset($_POST['remove'])) {
            unset($_SESSION['cart'][$cartKey]);
        }

        // Update quantity
        if (isset($_POST['update'])) {

            $quantity = filter_input(
                INPUT_POST,
                'quantity',
                FILTER_VALIDATE_INT
            );

            if (
                $quantity !== false &&
                $quantity !== null &&
                $quantity >= 1 &&
                $quantity <= 10
            ) {
                $_SESSION['cart'][$cartKey]['quantity'] = $quantity;
            }
        }
    }

    header('Location: cart.php');
    exit;
}

// Calculate cart items
$cartItems = [];
$cartSubtotal = 0;

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

    $cartItems[] = [
        'cart_key' => $cartKey,
        'product' => $product,
        'size' => $item['size'] ?? '12 oz',
        'grind' => $item['grind'] ?? 'Whole Bean',
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $cartSubtotal += $subtotal;
}

// Demo tax calculation
$taxRate = 0.0825;

$cartTax = round($cartSubtotal * $taxRate, 2);

$cartTotal = $cartSubtotal + $cartTax;

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

                            <!-- Product Image -->
                            <img
                                src="/images/products/<?= htmlspecialchars(basename($item['product']['image'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($item['product']['name'], ENT_QUOTES, 'UTF-8') ?>"
                                style="display:block; width:100%; height:220px; object-fit:contain; border-radius:12px;"
                            >

                            <!-- Product Origin -->
                            <p class="product-origin">
                                <?= htmlspecialchars($item['product']['origin'] ?? '') ?>
                            </p>

                            <!-- Product Name -->
                            <h3>
                                <?= htmlspecialchars($item['product']['name']) ?>
                            </h3>

                            <!-- Coffee Size -->
                            <p>
                                <strong>Size:</strong>
                                <?= htmlspecialchars($item['size']) ?>
                            </p>

                            <!-- Grind Type -->
                            <p>
                                <strong>Grind:</strong>
                                <?= htmlspecialchars($item['grind']) ?>
                            </p>

                            <!-- Unit Price -->
                            <p>
                                <strong>Unit Price:</strong>
                                $<?= number_format($item['product']['price'], 2) ?>
                            </p>

                            <!-- Update Cart Form -->
                            <form action="cart.php" method="post">

                                <input
                                    type="hidden"
                                    name="cart_key"
                                    value="<?= htmlspecialchars((string) $item['cart_key'], ENT_QUOTES, 'UTF-8') ?>"
                                >

                                <label>
                                    Quantity:
                                </label>

                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="10"
                                    value="<?= (int) $item['quantity'] ?>"
                                    required
                                >

                                <button
                                    type="submit"
                                    name="update"
                                    value="1"
                                    class="button button-primary"
                                >
                                    Update Quantity
                                </button>

                                <button
                                    type="submit"
                                    name="remove"
                                    value="1"
                                    class="button button-primary"
                                    formnovalidate
                                >
                                    Remove
                                </button>

                            </form>

                            <!-- Item Subtotal -->
                            <h3>
                                Subtotal:
                                $<?= number_format($item['subtotal'], 2) ?>
                            </h3>

                        </article>

                    <?php endforeach; ?>

                </div>

                <!-- Cart Totals -->
                <div class="section-heading">

                    <h2>Cart Totals</h2>

                    <p>
                        Subtotal:
                        $<?= number_format($cartSubtotal, 2) ?>
                    </p>

                    <p>
                        Tax (8.25%):
                        $<?= number_format($cartTax, 2) ?>
                    </p>

                    <h2>
                        Total:
                        $<?= number_format($cartTotal, 2) ?>
                    </h2>

                    <a
                        href="products.php"
                        class="text-link"
                    >
                        Continue Shopping
                    </a>

                    <p>
                        <a
                            href="checkout.php"
                            class="button button-primary"
                        >
                            Proceed to Checkout
                        </a>
                    </p>

                </div>

            <?php else: ?>

                <!-- Empty Cart -->
                <div class="section-heading">

                    <h2>Your cart is empty</h2>

                    <p>
                        Find your favorite coffee to get started.
                    </p>

                    <a
                        href="products.php"
                        class="button button-primary"
                    >
                        Continue Shopping
                    </a>

                </div>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php include __DIR__ . '/parts/footer.php'; ?>
