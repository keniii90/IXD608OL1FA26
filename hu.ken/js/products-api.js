
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("coffee-search");
    const filterSelect = document.getElementById("coffee-filter");
    const sortSelect = document.getElementById("coffee-sort");
    const productGrid = document.getElementById("coffee-product-grid");

    if (!searchInput || !filterSelect ||
        !sortSelect || !productGrid) {
        return;
    }

    // Get existing product cards
    const productCards = Array.from(
        productGrid.querySelectorAll(".product-card")
    );

    // Get product ID from each card's link
    function getProductId(card) {
        const link = card.querySelector('a[href*="product.php?id="]');

        if (!link) {
            return null;
        }

        const url = new URL(link.href, window.location.href);

        return Number(url.searchParams.get("id"));
    }

    fetch("api.php")
        .then(function (response) {

            if (!response.ok) {
                throw new Error("API request failed");
            }

            return response.json();

        })
        .then(function (products) {

            console.log("Products loaded successfully:", products);

            // Match product data to cards by ID
            const productMap = new Map();

            products.forEach(function (product) {
                productMap.set(Number(product.id), product);
            });

            const cardData = productCards.map(function (card, index) {
                return {
                    card: card,
                    product: productMap.get(getProductId(card)),
                    originalIndex: index
                };
            });

            function updateProducts() {

                const searchText = searchInput.value
                    .toLowerCase()
                    .trim();

                const filterValue = filterSelect.value;
                const sortValue = sortSelect.value;

                // Search and filter
                cardData.forEach(function (item) {

                    const product = item.product;

                    if (!product) {
                        item.card.style.display = "none";
                        return;
                    }

                    const name = String(product.name).toLowerCase();
                    const description = String(
                        product.description || ""
                    ).toLowerCase();

                    const matchesSearch =
                        name.includes(searchText) ||
                        description.includes(searchText);

                    let matchesFilter = true;

                    if (filterValue !== "all") {
                        matchesFilter = name.includes(filterValue);
                    }

                    item.card.style.display =
                        matchesSearch && matchesFilter ? "" : "none";
                });

                // Sort products
                const sortedCards = [...cardData];

                sortedCards.sort(function (a, b) {

                    if (!a.product || !b.product) {
                        return a.originalIndex - b.originalIndex;
                    }

                    if (sortValue === "price-low") {
                        return Number(a.product.price) -
                               Number(b.product.price);
                    }

                    if (sortValue === "price-high") {
                        return Number(b.product.price) -
                               Number(a.product.price);
                    }

                    if (sortValue === "name") {
                        return String(a.product.name).localeCompare(
                            String(b.product.name)
                        );
                    }

                    return a.originalIndex - b.originalIndex;
                });

                // Reorder existing cards without rebuilding them
                sortedCards.forEach(function (item) {
                    productGrid.appendChild(item.card);
                });

            }

            // Listen for user changes
            searchInput.addEventListener("input", updateProducts);
            filterSelect.addEventListener("change", updateProducts);
            sortSelect.addEventListener("change", updateProducts);

            updateProducts();

        })
        .catch(function (error) {
            console.error("Error loading products:", error);
        });

});
