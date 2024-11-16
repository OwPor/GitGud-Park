<?php 
    include_once 'links.php'; 
    include_once 'header.php';
    include_once 'modals.php';
?>
<style>
        /*
Color Palette:
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
    main{
        padding: 20px 120px;
    }
    .carttop button{
        all: unset;
        padding: 3px 8px;
        border-radius: 50px;
        border: none;
        color: #CD5C08;
        font-size: 14px;
        cursor: pointer;
    }
    .carttop button:hover{
        background-color: #FFF5E4;
    }
    .cartdel{
        font-size: large;
        padding: 5px 7px;
        color: gray;
    }
</style>
<main>
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <h4 class="fw-bold mb-3">My Cart</h4>
        <div class="d-flex gap-3 align-items-center carttop">
            <input class="form-check-input m-0" type="checkbox" value="" id="selectAll" onclick="toggleSelectAll(this)">
            <label class="form-check-label" for="selectAll">Select All</label>
            <button>Delete</button>
            <button>Remove inactive items</button>
            <button>Like</button>
        </div>
    </div>

    <!-- Stall 1 -->
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-1')">
                <span class="fw-bold">Stall 1 Name</span>
            </div>
        </div>
        <!-- Item 1 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-1">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <span class="fs-5">Kimchi Noodle Soup</span><br>
                        <span class="small text-muted">Variation: Chocolate, Medium</span>
                    </div>
                    <div class="d-flex gap-5 align-items-center">
                        <i class="fa-solid fa-xmark cartdel"></i>
                        <div class="d-flex align-items-center hlq">
                            <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                            <span class="ordquanum">1</span>
                            <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                        </div>
                    </div>
                    <div class="fw-bold">₱103</div>
                </div>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-1">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div>
                    <span class="fs-5">Spicy Ramen</span><br>
                    <span class="small text-muted">Burger Queen</span>
                </div>
            </div>
            <div class="fw-bold">₱120</div>
        </div>
    </div>

    <!-- Stall 2 -->
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <div class="d-flex gap-2 align-items-center">
                <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-2')">
                <span class="fw-bold">Stall 2 Name</span>
            </div>
        </div>
        <!-- Item 1 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-2">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div>
                    <span class="fs-5">Grilled Cheese</span><br>
                    <span class="small text-muted">Cheesy Bites</span>
                </div>
            </div>
            <div class="fw-bold">₱95</div>
        </div>
        <!-- Item 2 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-2">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div>
                    <span class="fs-5">Mac and Cheese</span><br>
                    <span class="small text-muted">Cheesy Bites</span>
                </div>
            </div>
            <div class="fw-bold">₱110</div>
        </div>
    </div>

    <!-- Stall 3 -->
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <div class="d-flex gap-2 align-items-center">
                <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-3')">
                <span class="fw-bold">Stall 3 Name</span>
            </div>
        </div>
        <!-- Item 1 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-3">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div>
                    <span class="fs-5">Chicken Burger</span><br>
                    <span class="small text-muted">Grill Masters</span>
                </div>
            </div>
            <div class="fw-bold">₱150</div>
        </div>
        <!-- Item 2 -->
        <div class="d-flex justify-content-between border-bottom py-2 stall-3">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/foodpark.jpg" width="85px" height="85px" class="border rounded-2">
                <div>
                    <span class="fs-5">BBQ Ribs</span><br>
                    <span class="small text-muted">Grill Masters</span>
                </div>
            </div>
            <div class="fw-bold">₱200</div>
        </div>
    </div>

    <!--<div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div>
            <label for="ordertype">Order Type</label>
            <input type="">
        </div>
    </div>-->
    <script>

        // Select All checkbox
        function toggleSelectAll(selectAllCheckbox) {
            const checkboxes = document.querySelectorAll('.item-checkbox, .stall-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }

        // Stall-specific checkbox
        function toggleStallItems(stallCheckbox, stallClass) {
            const items = document.querySelectorAll(`.${stallClass} .item-checkbox`);
            items.forEach(item => {
                item.checked = stallCheckbox.checked;
            });
        }
        function updateQuantity(button, change) {
            const quantitySpan = button.parentElement.querySelector('.ordquanum');
            let quantity = parseInt(quantitySpan.innerText);
            quantity = Math.max(1, quantity + change);
            quantitySpan.innerText = quantity;
        }
    </script>
</main>
<?php 
    include_once 'footer.php'; 
?>