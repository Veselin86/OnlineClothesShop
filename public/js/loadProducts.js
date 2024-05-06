function loadProducts(categoryId) {
    fetch(`/category/${categoryId}/products`)
        .then((response) => response.json())
        .then((data) => {
            const container = document.getElementById("products-container");
            container.innerHTML = "";
            data.forEach((product) => {
                const productElement = document.createElement("div");
                let sizes = "Talla única";
                if (product.sizes != null) {
                    sizes = "Tallas disponibles: " + product.sizes.join(", ");
                }
                productElement.innerHTML = `
                    <div class="product">
                        <h3>${product.name}</h3>
                        <h3>${product.price}</h3>
                        <h5>${sizes}</h5>
                        <h5>Colores disponibles: ${product.colors}</h5>
                        <img src="${product.image}" alt="${product.name}">
                        <p>${product.description}</p>
                    </div>
                `;
                container.appendChild(productElement);
            });
        })
        .catch((error) => console.error("Error loading the products:", error));
}

document.addEventListener("DOMContentLoaded", function () {
    const sizeOptions = document.querySelectorAll(".size-option");
    const colorOptions = document.querySelectorAll(".color-option");
    let selectedSize = "";
    let selectedColor = "";

    sizeOptions.forEach(function (btn) {
        btn.addEventListener("click", function () {
            selectedSize = this.dataset.size;
            sizeOptions.forEach(
                (btn) => (btn.style.border = "none")
            );
            this.style.border = "solid 1px";
        });
    });

    colorOptions.forEach(function (btn) {
        btn.addEventListener("click", function () {
            selectedColor = this.dataset.color;
            colorOptions.forEach(
                (btn) => (btn.style.border = "none")
            );
            this.style.border = "solid 1px";
        });
    });

    document
        .querySelector("button.add-to-cart")
        .addEventListener("click", function () {
            console.log("Añadido al carrito:", selectedSize, selectedColor);
        });
});