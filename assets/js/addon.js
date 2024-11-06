const products = [
    { id: 1, name: "Product A", price: 10.00, image: "https://via.placeholder.com/40" },
    { id: 2, name: "Product B", price: 12.00, image: "https://via.placeholder.com/40" },
    { id: 3, name: "Product C", price: 15.50, image: "https://via.placeholder.com/40" },
    { id: 4, name: "Product D", price: 9.75, image: "https://via.placeholder.com/40" },
];

let selectedAddons = [];

function filterDropdown() {
    const searchTerm = document.querySelector(".search-input").value.toLowerCase();
    const dropdown = document.getElementById("dropdown-list");

    dropdown.innerHTML = ""; 
    dropdown.style.display = searchTerm ? "block" : "none";

    products
        .filter(product => product.name.toLowerCase().includes(searchTerm))
        .forEach(product => {
            const item = document.createElement("div");
            item.className = "dropdown-item";
            item.onclick = () => addAddon(product);

            item.innerHTML = `
                <div class="product-info">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <span>${product.name}</span>
                </div>
                <span>$${product.price.toFixed(2)}</span>
            `;
            dropdown.appendChild(item);
        });
}

function addAddon(product) {
    if (selectedAddons.some(addon => addon.id === product.id)) return;

    selectedAddons.push({ ...product, customPrice: product.price });
    renderAddons();
    document.getElementById("dropdown-list").style.display = "none";
    document.querySelector(".search-input").value = "";
}

function renderAddons() {
    const addonList = document.getElementById("addon-list");
    addonList.innerHTML = "";

    selectedAddons.forEach((addon, index) => {
        const addonItem = document.createElement("div");
        addonItem.className = "addon-item";

        addonItem.innerHTML = `
            <div class="rempro">
                <button class="remove-btn" onclick="removeAddon(${index})"><i class="fa-solid fa-xmark"></i></button>
                <div class="product-info">
                    <img src="${addon.image}" alt="${addon.name}" class="product-image">
                    <span>${addon.name}</span>
                </div>
            </div>
            <div>
                <input type="number" min="0" step="0.01" value="${addon.customPrice.toFixed(2)}" disabled 
                       data-index="${index}" onchange="updatePrice(${index}, this.value)">
                <button class="edit-btn" onclick="enableEdit(${index})"><i class="fa-solid fa-pen"></i></button>
            </div>
        `;
        addonList.appendChild(addonItem);
    });
}

function updatePrice(index, newPrice) {
    selectedAddons[index].customPrice = parseFloat(newPrice) || 0;
}

function enableEdit(index) {
    const input = document.querySelector(`input[data-index="${index}"]`);
    input.disabled = false;
    input.focus();
}

function removeAddon(index) {
    selectedAddons.splice(index, 1);
    renderAddons();
}

document.addEventListener("click", function(event) {
    const dropdown = document.getElementById("dropdown-list");
    if (!event.target.closest(".search-bar")) {
        dropdown.style.display = "none";
    }
});