
document.addEventListener("DOMContentLoaded", function () {
    const productImage = document.querySelector("#product-preview");
    const buttons = document.querySelectorAll(".roast-option");

    if (!productImage || buttons.length === 0) {
        return;
    }

    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            const roast = button.dataset.roast;

            productImage.classList.remove(
                "roast-light",
                "roast-medium",
                "roast-dark"
            );

            productImage.classList.add(roast);

            buttons.forEach(function (btn) {
                btn.setAttribute("aria-pressed", "false");
            });

            button.setAttribute("aria-pressed", "true");
        });
    });
});
