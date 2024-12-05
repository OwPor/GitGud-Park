<?php 
    include_once 'links.php'; 
    include_once 'header.php';
    include_once 'modals.php';
    require_once __DIR__ . '/classes/cart.class.php';
    require_once __DIR__ . '/classes/product.class.php';
    require_once __DIR__ . '/classes/stall.class.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ./signin.php');
        exit();
    }

    $cart = new Cart();
    $cartItems = $cart->getCart($user['user_session']);
    $productObj = new Product();
    $stallObj = new Stall();
    $subtotal = 0;
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

    <!-- Stall 1
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <div class="d-flex gap-3 align-items-center">
                <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-1')">
                <span class="fw-bold">Stall 1 Name</span>
            </div>
            <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This stall does not offer Cash payment</span>
        </div>
        Item 1
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
        Item 2
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
    </div> -->

    <!-- Stall -->
    <?php foreach ($cartItems as $cartItem): 
        $stall = $stallObj->getStall($cartItem['stall_id']);
    ?>
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-<?= $stall['id'] ?>')">
                    <span class="fw-bold"><?= htmlspecialchars($stall['name']) ?></span>
                </div>
                <!-- <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This stall does not offer Cash payment</span> -->
            </div>
            <?php foreach ($cartItems as $item): 
                if ($item['stall_id'] == $stall['id']): 
                    $product = $productObj->getProductById($item['product_id']);
            ?>
                <div class="d-flex border-bottom py-2 stall-<?= $stall['id'] ?>">
                    <div class="d-flex gap-3 align-items-center" style="width: 65%">
                        <input class="form-check-input m-0 item-checkbox" type="checkbox">
                        <img src="<?= htmlspecialchars($product['file_path']) ?>" width="80px" height="80px" class="border rounded-2">
                        <div>
                            <span class="fs-5"><?= htmlspecialchars($product['name']) ?></span><br>
                            <span class="small text-muted">Variation:</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between" style="width: 35%">
                        <div class="d-flex align-items-center hlq">
                            <i class="fa-solid fa-minus" onclick="updateQuantity(this, -1)"></i>
                            <span class="ordquanum"><?= $item['quantity'] ?></span>
                            <i class="fa-solid fa-plus" onclick="updateQuantity(this, 1)"></i>
                        </div>
                        <div class="fw-bold fs-5">₱<?= number_format($product['price'] * $item['quantity'], 2) ?></div>
                        <div class="carttop d-flex gap-3">
                            <button onclick="deleteItem(<?= $item['id'] ?>)">Delete</button>
                            <button onclick="likeItem(<?= $item['id'] ?>)">Like</button>
                        </div>
                    </div>
                </div>
            <?php endif; endforeach; ?>
        </div>
    <?php endforeach; ?>

    <!-- Stall 2 -->
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <div class="d-flex gap-2 align-items-center">
                <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, 'stall-2')">
                <span class="fw-bold">Stall 2 Name</span>
            </div>
            <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This stall does not offer Cash payment</span>
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

    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', () => {
                // Check if a modal should be shown based on session storage
                const modalMapping = {
                    ifcashless: 'showCashlessModal',
                    ifscheduled: 'showScheduledModal',
                };
                for (const [modalId, sessionKey] of Object.entries(modalMapping)) {
                    if (sessionStorage.getItem(sessionKey)) {
                        const modal = new bootstrap.Modal(document.getElementById(modalId));
                        modal.show();
                        sessionStorage.removeItem(sessionKey); // Clear the flag
                    }
                }

                const paymentMethod = document.getElementById('paymentMethod');
                const scheduleDate = document.getElementById('scheduleDate');
                const scheduleTime = document.getElementById('scheduleTime');

                // Enable or disable inputs based on order time selection
                document.getElementById('scheduleLater').addEventListener('change', () => {
                    scheduleDate.disabled = false;
                    scheduleTime.disabled = false;

                    // Disable cash for scheduled orders
                    paymentMethod.querySelector('option[value="cash"]').disabled = true;
                    paymentMethod.value = 'gcash'; // Default to GCash
                });

                document.getElementById('immediately').addEventListener('change', () => {
                    scheduleDate.disabled = true;
                    scheduleTime.disabled = true;

                    // Enable cash for immediate orders
                    paymentMethod.querySelector('option[value="cash"]').disabled = false;
                });

                // Handle Place Order button click
                document.getElementById('placeOrderButton').addEventListener('click', async function () {
                    const selectedPayment = paymentMethod.value;
                    const orderTime = document.querySelector('input[name="orderTime"]:checked').id;

                    try {
                        if (selectedPayment === 'gcash') {
                            const response = await fetch('paymongo.php');
                            const data = await response.json();

                            if (data.checkout_url) {
                                // Set the session flag for the appropriate modal
                                const modalKey = orderTime === 'immediately' ? 'showCashlessModal' : 'showScheduledModal';
                                sessionStorage.setItem(modalKey, 'true');
                                // Redirect to the payment link
                                window.location.href = data.checkout_url;
                            } else {
                                console.error('Error fetching payment link:', data.error);
                                alert('Failed to retrieve the payment link. Please try again.');
                            }
                        } else if (selectedPayment === 'cash' && orderTime === 'immediately') {
                            const cashModal = new bootstrap.Modal(document.getElementById('ifcash'));
                            cashModal.show();
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while processing your request.');
                    }
                });
            });
        })();
    </script>




    <br><br><br><br><br>
</main>
<?php 
    include_once 'footer.php'; 
?>
<script src="./assets/js/cart.js"></script>