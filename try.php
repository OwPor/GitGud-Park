<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-ons Feature</title>
    <style>
        .addon-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-bar {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 10;
            display: none;
        }

        .dropdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 3px;
            object-fit: cover;
        }

        .addon-list {
            margin-top: 20px;
        }

        .addon-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 8px;
        }

        .addon-item input {
            width: 60px;
            padding: 5px;
            text-align: right;
        }

        .edit-btn, .remove-btn {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .remove-btn {
            background: #dc3545;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="addon-container">
    <h3>Add-ons</h3>
    <div class="search-bar">
        <input type="text" class="search-input" placeholder="Search for products..." oninput="filterDropdown()">
        <div class="dropdown-list" id="dropdown-list"></div>
    </div>

    <div class="addon-list" id="addon-list"></div>
</div>

<script>
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
                <button class="remove-btn" onclick="removeAddon(${index})">Remove</button>
                <div class="product-info">
                    <img src="${addon.image}" alt="${addon.name}" class="product-image">
                    <span>${addon.name}</span>
                </div>
                <div>
                    <input type="number" min="0" step="0.01" value="${addon.customPrice.toFixed(2)}" disabled 
                           data-index="${index}" onchange="updatePrice(${index}, this.value)">
                    <button class="edit-btn" onclick="enableEdit(${index})">Edit</button>
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
</script>

</body>
</html>
