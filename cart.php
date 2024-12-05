<?php 
    include_once 'links.php'; 
    include_once 'header.php';
    include_once 'modals.php';
?>
<style>
    main{
        padding: 20px 120px;
    }
</style>
<main>
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <h4 class="fw-bold mb-3">My Cart</h4>
        <div class="d-flex gap-3 align-items-center carttop">
            <input class="form-check-input m-0" type="checkbox" value="" id="selectAll" onclick="toggleSelectAll(this)">
            <label class="form-check-label" for="selectAll">Select All</label>
            <button>Delete</button>
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
            <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This stall does not offer Cash payment</span>
        </div>
        <!-- Item 1 -->
        <div class="d-flex border-bottom py-2 stall-1">
            <div class="d-flex gap-3 align-items-center" style="width: 65%">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/food1.jpg" width="80px" height="80px" class="border rounded-2">
                <div>
                    <span class="fs-5">Food Name</span><br>
                    <span class="small text-muted">Variation: Chocolate, Medium</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between" style="width: 35%">
                <div class="d-flex align-items-center hlq">
                    <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                    <span class="ordquanum">1</span>
                    <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                </div>
                <div class="fw-bold fs-5">₱103</div>
                <div class="carttop d-flex gap-3">
                    <button>Delete</button>
                    <button>Like</button>
                </div>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="d-flex border-bottom py-2 stall-1">
            <div class="d-flex gap-3 align-items-center" style="width: 65%">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/food2.jpg" width="80px" height="80px" class="border rounded-2">
                <div>
                    <span class="fs-5">Food Name</span><br>
                    <span class="small text-muted">Variation: Chocolate, Medium</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between" style="width: 35%">
                <div class="d-flex align-items-center hlq">
                    <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                    <span class="ordquanum">1</span>
                    <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                </div>
                <div class="fw-bold fs-5">₱103</div>
                <div class="carttop d-flex gap-3">
                    <button>Delete</button>
                    <button>Like</button>
                </div>
            </div>
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
        <div class="d-flex border-bottom py-2 stall-2">
            <div class="d-flex gap-3 align-items-center" style="width: 65%">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/food3.jpg" width="80px" height="80px" class="border rounded-2">
                <div>
                    <span class="fs-5">Food Name</span><br>
                    <span class="small text-muted">Variation: Chocolate, Medium</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between" style="width: 35%">
                <div class="d-flex align-items-center hlq">
                    <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                    <span class="ordquanum">1</span>
                    <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                </div>
                <div class="fw-bold fs-5">₱103</div>
                <div class="carttop d-flex gap-3">
                    <button>Delete</button>
                    <button>Like</button>
                </div>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="d-flex border-bottom py-2 stall-2">
            <div class="d-flex gap-3 align-items-center" style="width: 65%">
                <input class="form-check-input m-0 item-checkbox" type="checkbox">
                <img src="assets/images/food4.jpg" width="80px" height="80px" class="border rounded-2">
                <div>
                    <span class="fs-5">Food Name</span><br>
                    <span class="small text-muted">Variation: Chocolate, Medium</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between" style="width: 35%">
                <div class="d-flex align-items-center hlq">
                    <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                    <span class="ordquanum">1</span>
                    <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                </div>
                <div class="fw-bold fs-5">₱103</div>
                <div class="carttop d-flex gap-3">
                    <button>Delete</button>
                    <button>Like</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-start border py-3 px-4 rounded-2 bg-white">
        <div style="width: 70%">
            <div class="d-flex align-items-center mb-4">
                <label class="form-label w-25 mb-0 fw-bold">Order Type</label>
                <div class="cartot btn-group w-75" role="group">
                    <button type="button" class="btn-toggle active rounded" id="dineIn">Dine In</button>
                    <button type="button" class="btn-toggle rounded" id="takeOut">Take Out</button>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <label class="form-label w-25 mb-0 fw-bold">Payment Method</label>
                <select class="form-select w-75" id="paymentMethod">
                    <option value="cash">Cash</option>
                    <option value="gcash">GCash</option>
                </select>
            </div>
            <div class="d-flex mb-4">
                <label class="form-label w-25 mb-0 fw-bold">Order</label>
                <div class="w-75">
                    <div class="d-flex align-items-center mb-2">
                        <input class="form-check-input me-3 m-0" type="radio" name="orderTime" id="immediately" checked>
                        <label for="immediately" class="me-5">Immediately</label>

                        <input class="form-check-input me-3 m-0" type="radio" name="orderTime" id="scheduleLater">
                        <label for="scheduleLater">Schedule for later</label>
                    </div>
                    <div class="d-flex gap-3 cartdis">
                        <input type="date" class="form-control" id="scheduleDate" disabled>
                        <input type="time" class="form-control" id="scheduleTime" disabled>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="w-25"></div>
                <div class="w-75">
                    <button type="button" class="btn btn-primary rounded-5" style="width: 250px;" id="placeOrderButton">Place Order</button>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4">
            <p class="fw-bold fs-5 m-0">Total:</p>
            <h2 class="fw-bold m-0" style="color: #CD5C08">₱1,072</h2>
        </div>
    </div>
    <script src="./assets/js/cart.js"></script>
    <script>
        (function () {
            // Function to handle Place Order button click
            document.getElementById('placeOrderButton').addEventListener('click', function () {
                const paymentMethod = document.getElementById('paymentMethod').value;
                const orderTime = document.querySelector('input[name="orderTime"]:checked').id;

                let targetModal = '';

                // Determine which modal to show
                if (paymentMethod === 'cash' && orderTime === 'immediately') {
                    targetModal = 'ifcash';
                } else if (paymentMethod === 'gcash' && orderTime === 'immediately') {
                    targetModal = 'ifcashless';
                } else if (paymentMethod === 'cash' && orderTime === 'scheduleLater') {
                    targetModal = 'ifscheduled';
                }

                // Show the determined modal
                if (targetModal) {
                    const modal = new bootstrap.Modal(document.getElementById(targetModal));
                    modal.show();
                }
            });

            // Enable or disable schedule inputs based on order time selection
            const scheduleDate = document.getElementById('scheduleDate');
            const scheduleTime = document.getElementById('scheduleTime');
            document.getElementById('scheduleLater').addEventListener('change', () => {
                scheduleDate.disabled = false;
                scheduleTime.disabled = false;
            });
            document.getElementById('immediately').addEventListener('change', () => {
                scheduleDate.disabled = true;
                scheduleTime.disabled = true;
            });
        })();
    </script>

    <br><br><br><br><br>
</main>
<?php 
    include_once 'footer.php'; 
?>