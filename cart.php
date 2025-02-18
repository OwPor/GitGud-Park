<?php 
include_once 'links.php'; 
include_once 'header.php';
require_once __DIR__ . '/classes/cart.class.php';

$cartObj = new Cart();
$cartGrouped = $cartObj->getCartGroupedItems($user_id, $park_id);

$park_id

?>

<main style="padding: 20px 120px;">
    <div class="border py-3 px-4 rounded-2 bg-white mb-3">
        <h4 class="fw-bold mb-3">My Cart</h4>
        <div class="d-flex gap-3 align-items-center carttop">
            <input class="form-check-input m-0" type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
            <label class="form-check-label" for="selectAll">Select All</label>
            <button>Delete</button>
            <button>Like</button>
        </div>
    </div>

    <?php foreach ($cartGrouped as $stallName => $items): 
            $stall_id = $items[0]['stall_id'] ?? 0;
            $supportedMethods = $items[0]['supported_methods'] ?? 'cash,gcash'; 
    ?>
        <div class="border py-3 px-4 rounded-2 bg-white mb-3 stall-group" 
             data-stall-id="<?= htmlspecialchars($stall_id) ?>" 
             data-supported-methods="<?= htmlspecialchars($supportedMethods) ?>">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 stall-header">
                <div class="d-flex gap-3 align-items-center">
                    <input class="form-check-input m-0 stall-checkbox" type="checkbox" onclick="toggleStallItems(this, this.closest('.stall-group'))">
                    <span class="fw-bold"><?= htmlspecialchars($stallName) ?></span>
                </div>
                <span class="stall-error text-danger" style="font-size: 13px; display:none;">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    This stall does not offer <span class="error-method"></span> payment
                </span>
            </div>
            <?php foreach ($items as $item): 
                $totalPrice = $item['quantity'] * $item['unit_price'];
                $variationsText = '';
                if (!empty($item['variation_names'])) {
                    $variationsText = '<span class="small text-muted">Variation: ' . htmlspecialchars(implode(', ', $item['variation_names'])) . '</span><br>';
                }
            ?>
            <div class="d-flex border-bottom py-2 cart-item">
                <div class="d-flex gap-3 align-items-center" style="width: 65%">
                    <input class="form-check-input m-0 item-checkbox" type="checkbox" onchange="updateGrandTotal()">
                    <img src="<?= htmlspecialchars($item['product_image']) ?>" width="80px" height="80px" class="border rounded-2">
                    <div>
                        <span class="fs-5"><?= htmlspecialchars($item['product_name']) ?></span><br>
                        <?= $variationsText ?>
                        <?php if ($item['request']): ?>
                            <span class="small text-muted">"<?= htmlspecialchars($item['request']) ?>"</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between" style="width: 35%" data-unit-price="<?= $item['unit_price'] ?>">
                    <div class="d-flex align-items-center hlq">
                        <i class="fa-solid fa-minus" onclick="updateCartQuantity(this, -1, '<?= $item['product_id'] ?>', '<?= urlencode($item['request']) ?>')"></i>
                        <span class="ordquanum"><?= htmlspecialchars($item['quantity']) ?></span>
                        <i class="fa-solid fa-plus" onclick="updateCartQuantity(this, 1, '<?= $item['product_id'] ?>', '<?= urlencode($item['request']) ?>')"></i>
                    </div>
                    <div class="fw-bold fs-5">₱<?= number_format($totalPrice, 2) ?></div>
                    <div class="carttop d-flex gap-3">
                        <button onclick="deleteCartItem('<?= $item['product_id'] ?>', '<?= urlencode($item['request']) ?>')">Delete</button>
                        <button>Like</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

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
                <select class="form-select w-75" id="paymentMethod" onchange="validatePaymentMethods()">
                    <option value="" disabled selected>Select</option>
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
            <h2 class="fw-bold m-0" id="grandTotal" style="color: #CD5C08">₱0.00</h2>
        </div>
    </div>
</main>

<script>
    function toggleSelectAll(selectAllCheckbox) {
        const allCheckboxes = document.querySelectorAll('.item-checkbox, .stall-checkbox');
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateGrandTotal();
    }

    function toggleStallItems(stallCheckbox, stallGroup) {
        const itemCheckboxes = stallGroup.querySelectorAll('.item-checkbox');
        itemCheckboxes.forEach(chk => {
            chk.checked = stallCheckbox.checked;
        });
        updateGrandTotal();
    }

    function updateCartQuantity(button, change, productId, request) {
        const quantitySpan = button.parentElement.querySelector('.ordquanum');
        let quantity = parseInt(quantitySpan.innerText);
        quantity = Math.max(1, quantity + change);
        quantitySpan.innerText = quantity;

        const parentContainer = button.closest('[data-unit-price]');
        const unitPrice = parseFloat(parentContainer.getAttribute('data-unit-price'));
        const totalDiv = parentContainer.querySelector('.fw-bold.fs-5');
        const newTotal = unitPrice * quantity;
        totalDiv.innerText = '₱' + newTotal.toFixed(2);

        updateGrandTotal();
    }

    function deleteCartItem(productId, request) {
        alert('Delete cart item for product ' + productId + ' with request: ' + decodeURIComponent(request));
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.item-checkbox:checked').forEach(chk => {
            const cartItem = chk.closest('.cart-item');
            const priceContainer = cartItem.querySelector('[data-unit-price]');
            const unitPrice = parseFloat(priceContainer.getAttribute('data-unit-price'));
            const quantity = parseInt(cartItem.querySelector('.ordquanum').innerText);
            grandTotal += unitPrice * quantity;
        });
        document.getElementById('grandTotal').innerText = '₱' + grandTotal.toFixed(2);
    }

    function validatePaymentMethods() {
        const selectedMethod = document.getElementById('paymentMethod').value; // "cash" or "gcash"
        document.querySelectorAll('.stall-group').forEach(stall => {
            const supportedMethods = stall.getAttribute('data-supported-methods')
                .split(',')
                .map(m => m.trim().toLowerCase());
            const errorSpan = stall.querySelector('.stall-error');
            if (!supportedMethods.includes(selectedMethod.toLowerCase())) {
                errorSpan.style.display = 'inline';
                errorSpan.querySelector('.error-method').innerText = selectedMethod.charAt(0).toUpperCase() + selectedMethod.slice(1);
                stall.querySelectorAll('.item-checkbox').forEach(chk => chk.checked = false);
                const stallChk = stall.querySelector('.stall-checkbox');
                if (stallChk) stallChk.checked = false;
            } else {
                errorSpan.style.display = 'none';
            }
        });
        updateGrandTotal();
    }

    document.querySelectorAll('.btn-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.btn-toggle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    document.getElementById('immediately').addEventListener('click', () => {
        document.getElementById('scheduleDate').disabled = true;
        document.getElementById('scheduleTime').disabled = true;
    });
    document.getElementById('scheduleLater').addEventListener('click', () => {
        document.getElementById('scheduleDate').disabled = false;
        document.getElementById('scheduleTime').disabled = false;
    });
</script>


<?php 
include_once 'footer.php'; 
?>
