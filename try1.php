<?php 
include_once 'header.php'; 
include_once 'links.php'; 
include_once 'nav.php';
require_once __DIR__ . '/classes/stall.class.php';

$stallObj = new Stall();
$stall_id = $stallObj->getStallId($_SESSION['user']['id']);
$ordersData = $stallObj->getStallOrders($stall_id);

$groupedOrders = [];
foreach ($ordersData as $order) {
    $status = $order['order_status'];
    if (!isset($groupedOrders[$status])) {
        $groupedOrders[$status] = [];
    }
    $osid = $order['order_stall_id'];
    if (!isset($groupedOrders[$status][$osid])) {
        $groupedOrders[$status][$osid] = [
            'order_id'       => $order['order_id'],
            'order_date'     => $order['order_date'],
            'stall_subtotal'=> $order['stall_subtotal'],
            'queue_number'   => $order['queue_number'],  
            'items'          => []
        ];
        
    }
    $groupedOrders[$status][$osid]['items'][] = $order;
}

$statusMapping = [
    'Pending'   => 'pendingpayment',
    'Preparing' => 'preparing',
    'Ready'     => 'readyforpickup',
    'Completed' => 'completed'
];
?>
<style>
    main{
        padding: 20px 120px;
    }
    .orderbtns button{
        background-color: #CD5C08;
        color: white;
        border: none;
        padding: 6px 0;
        width: 200px;
    }
    .orderbtns button:hover {
        transform: scale(1.05); 
        filter: brightness(1.1); 
    }
    .prequeue{
        border-radius: 50%;
        width: 35px;
        height: 35px;
        background-color: gray;
    }
</style>
<main>
    <div class="nav-container d-flex gap-3 my-2">
        <a href="#pendingpayment" class="nav-link" data-target="pendingpayment">Pending Payment</a>
        <a href="#preparing" class="nav-link" data-target="preparing">Preparing</a>
        <a href="#readyforpickup" class="nav-link" data-target="readyforpickup">Ready for Pickup</a>
        <a href="#completed" class="nav-link" data-target="completed">Completed</a>
    </div>
    
    <?php 
    foreach ($statusMapping as $status => $sectionId) {
        echo '<div id="'.$sectionId.'" class="section-content '. (empty($groupedOrders[$status]) ? 'd-none' : '') .'">';
        if (!empty($groupedOrders[$status])) {
            foreach ($groupedOrders[$status] as $osid => $orderGroup) { 
                $formattedOrderId = str_pad($orderGroup['order_id'], 4, '0', STR_PAD_LEFT);
                $formattedDate = date("m/d/Y H:i", strtotime($orderGroup['order_date']));
                $displayStatus = ($status == 'Pending') ? "PENDING PAYMENT" :
                                 (($status == 'Preparing') ? "PREPARING" :
                                 (($status == 'Ready') ? "READY FOR PICKUP" : "COMPLETED"));
                ?>
                <div class="border rounded-2 bg-white mb-3 d-flex">
                    <div class="flex-grow-1 border-end">
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <?php if (!empty($orderGroup['queue_number'])): ?>
                                    <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">
                                        <?php echo str_pad($orderGroup['queue_number'], 2, '0', STR_PAD_LEFT); ?>
                                    </span>
                                    <span class="dot text-muted"></span>
                                <?php endif; ?>
                                <span class="fw-bold">ORDER ID: <?php echo $formattedOrderId; ?></span>
                            </div>

                            <div class="d-flex gap-3 align-items-center">
                                <span style="color: #6A9C89" class="small"><?php echo $formattedDate; ?></span>
                                <span class="dot text-muted"></span>
                                <span class="fw-bold" style="color: #CD5C08"><?php echo $displayStatus; ?></span>
                            </div>
                        </div>
                        <?php 
                        foreach ($orderGroup['items'] as $item) { ?>
                            <div class="d-flex justify-content-between border-bottom py-2 px-5">
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="<?php echo htmlspecialchars($item['product_image']); ?>" width="85px" height="85px" class="border rounded-2">
                                    <div>
                                        <span class="fs-5"><?php echo htmlspecialchars($item['product_name']); ?></span><br>
                                        <?php if (!empty($item['variations'])): ?>
                                            <span class="small text-muted">Variation: <?php echo htmlspecialchars($item['variations']); ?></span><br>
                                        <?php endif; ?>
                                        <?php if (!empty($item['request'])): ?>
                                            <span class="small text-muted">"<?php echo htmlspecialchars($item['request']); ?>"</span><br>
                                        <?php endif; ?>
                                        <span>x<?php echo $item['quantity']; ?></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end">
                                    <span class="fw-bold">₱<?php echo number_format($item['item_subtotal'], 2); ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="d-flex justify-content-between py-2 px-5">
                            <div class="d-flex gap-3 align-items-center text-muted small">
                                <span>Payment Method: Cash</span>
                                <span class="dot text-muted"></span>
                                <span>Dine in</span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="text-muted">Total:</span>
                                <span class="fw-bold fs-4">₱<?php echo number_format($orderGroup['stall_subtotal'], 2); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
                        <?php 
                        if ($status == 'Pending'): ?>
                            <button class="rounded-2 prepare-order-btn" data-order-stall-id="<?php echo $osid; ?>" data-new-status="Preparing" data-bs-toggle="modal" data-bs-target="#prepareorder">Prepare Order</button>
                            <button class="rounded-2" style="background-color: #6A9C89;">Cancel Order</button>
                            <button class="rounded-2" style="background-color: gray;">Remind Payment</button>
                        <?php elseif ($status == 'Preparing'): ?>
                            <button class="rounded-2 order-ready-btn" data-order-stall-id="<?php echo $osid; ?>" data-new-status="Ready" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
                        <?php elseif ($status == 'Ready'): ?>
                            <button class="rounded-2 order-complete-btn" data-order-stall-id="<?php echo $osid; ?>" data-new-status="Completed" data-bs-toggle="modal" data-bs-target="#ordercomplete">Order Complete</button>
                            <button class="rounded-2" style="background-color: #6A9C89;">Notify Customer</button>
                        <?php elseif ($status == 'Completed'): ?>
                            <span class="text-muted">Completed</span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
            }
        } else {
            echo "<p>No orders in this section.</p>";
        }
        echo '</div>';
    }
    ?>
    
    <div class="modal fade" id="prepareorder" tabindex="-1" aria-labelledby="prepareorderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center">
                        <h4 class="fw-bold mb-4"><i class="fa-solid fa-utensils me-2"></i> Prepare Order</h4>
                        <p class="mb-2">Start preparing this order?</p>
                        <span class="text-muted small">Preparing this order means that their payment is confirmed.</span>
                        <div class="mt-5 mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="prepareOrderYesBtn" data-order-id="" data-new-status="">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderready" tabindex="-1" aria-labelledby="orderreadyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center">
                        <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-check me-2"></i> Order Ready</h4>
                        <p class="mb-2">Mark this order as ready for pickup?</p>
                        <span class="text-muted small">Marking this order will notify the customer about their order.</span>
                        <div class="mt-5 mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="orderReadyYesBtn" data-order-id="" data-new-status="">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ordercomplete" tabindex="-1" aria-labelledby="ordercompleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center">
                        <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-check me-2"></i> Order Complete</h4>
                        <p class="mb-2">Mark this order as completed?</p>
                        <span class="text-muted small">Marking this order means that the order is done.</span>
                        <div class="mt-5 mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="orderCompleteYesBtn" data-order-id="" data-new-status="">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function bindAction(buttonSelector, modalYesBtnId) {
        document.querySelectorAll(buttonSelector).forEach(function(btn) {
            btn.addEventListener('click', function() {
                var orderStallId = this.getAttribute('data-order-stall-id');
                var modalYesBtn = document.getElementById(modalYesBtnId);
                modalYesBtn.setAttribute('data-order-id', orderStallId);
                modalYesBtn.setAttribute('data-new-status', this.getAttribute('data-new-status'));
            });
        });
    }

    bindAction('.prepare-order-btn', 'prepareOrderYesBtn');
    bindAction('.order-ready-btn', 'orderReadyYesBtn');
    bindAction('.order-complete-btn', 'orderCompleteYesBtn');

    document.querySelectorAll('.order-received-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var orderStallId = this.getAttribute('data-order-stall-id');
            var modalYesBtn = document.getElementById('orderReceivedYesBtn');
            modalYesBtn.setAttribute('data-order-id', orderStallId);
            modalYesBtn.setAttribute('data-new-status', 'Completed');
        });
    });

    function bindYesButton(yesBtnId) {
        document.getElementById(yesBtnId).addEventListener('click', function() {
            var orderStallId = this.getAttribute('data-order-id');
            var newStatus = this.getAttribute('data-new-status');
            if (!orderStallId || !newStatus) {
                alert("Missing order information.");
                return;
            }
            fetch('update_order_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'order_stall_id=' + encodeURIComponent(orderStallId) + '&new_status=' + encodeURIComponent(newStatus)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => alert("Request failed: " + error));
        });
    }
    
    bindYesButton('prepareOrderYesBtn');
    bindYesButton('orderReadyYesBtn');
    bindYesButton('orderCompleteYesBtn');
    bindYesButton('orderReceivedYesBtn');
});
</script>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>
<?php include_once './footer.php'; ?>
