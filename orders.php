<?php
    include_once 'header.php'; 
    include_once 'links.php'; 
    include_once 'modals.php'; 
    include_once 'nav.php';
    require_once 'classes/stall.class.php';

    $stall = new Stall();
    $stallId = $stall->getStallId($_SESSION['user']['id']);
    $orders = $stall->getOrdersByStallId($stallId);

    // var_dump($orders);
    
    // Define status order and display names
    $statusOrder = [
        'Pending' => 1,
        'Preparing' => 2,
        'Ready' => 3,
        'Completed' => 4,
        'Cancelled' => 5,
        'Scheduled' => 6
    ];

    $statusDisplayNames = [
        'Pending' => 'Pending',
        'Ready' => 'Ready',
        'Preparing' => 'Preparing',
        'Completed' => 'Completed',
        'Cancelled' => 'Cancelled',
        'Scheduled' => 'Scheduled'
    ];

    // Initialize ordersByStatus with correct order
    $ordersByStatus = [
        'Pending' => [],
        'Preparing' => [],
        'Ready' => [],
        'Completed' => [],
        'Cancelled' => [],
        'Scheduled' => []
    ];

    // Sort orders by status priority, then by order date
    if ($orders) {
        usort($orders, function($a, $b) use ($statusOrder) {
            // Compare status priority
            $statusCompare = $statusOrder[$a['status']] <=> $statusOrder[$b['status']];
            
            if ($statusCompare === 0) {
                // If same status, sort by order date (newest first)
                return strtotime($b['order_date']) <=> strtotime($a['order_date']);
            }
            
            return $statusCompare;
        });
    }

    // Group orders by status while maintaining sort order
    if ($orders) {
        foreach ($orders as $order) {
            $status = $order['status'];
            $ordersByStatus[$status][] = $order;
        }
    }

    function displayFooter($status, $order, $total) {
        ?>
        <div class="d-flex justify-content-between py-2 px-5">
            <div class="d-flex gap-3 align-items-center text-muted small">
                <span>Payment Method: <?= htmlspecialchars($order['payment_method']); ?></span>
                <span class="dot text-muted"></span>
                <span><?= htmlspecialchars($order['order_type'] ?? 'Dine in'); ?></span>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <span class="text-muted">Total:</span>
                <span class="fw-bold fs-4">₱<?= number_format($total, 2); ?></span>
            </div>
        </div>
        </div>
        <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
            <?php if ($status === 'Pending'): ?>
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#prepareorder">Prepare Order</button>
                <button class="rounded-2" style="background-color: #6A9C89;" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
                <button class="rounded-2" style="background-color: gray;">Remind Payment</button>
            <?php elseif ($status === 'Preparing'): ?>
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
            <?php elseif ($status === 'Ready'): ?>
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#completeorder">Complete Order</button>
                <button class="rounded-2" style="background-color: #6A9C89;" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
            <?php elseif ($status === 'Completed'): ?>
                <span class="text-muted">Completed</span>
            <?php elseif ($status === 'Cancelled'): ?>
                <span class="text-muted text-center">Cancelled by the customer<br>(Need to modify order)</span>
            <?php elseif ($status === 'Scheduled'): ?>
                <span class="text-muted text-center p-3 small">Scheduled on <?= date('F j, Y \a\t g:i A', strtotime($order['scheduled_date'])); ?><br>
            <?php endif; ?>
        </div>
        </div>
        <?php
    }    
?>
<style>
    /*
.variationlette:
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
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
        <a href="#all" class="nav-link" data-target="all">All</a>
        <a href="#pendingpayment" class="nav-link" data-target="pendingpayment">Pending Payment</a>
        <a href="#preparing" class="nav-link" data-target="preparing">Preparing</a>
        <a href="#readyforpickup" class="nav-link" data-target="readyforpickup">Ready for Pickup</a>
        <a href="#completed" class="nav-link" data-target="completed">Completed</a>
        <a href="#canceled" class="nav-link" data-target="canceled">Cancelled</a>
        <a href="#scheduled" class="nav-link" data-target="scheduled">Scheduled</a>
    </div>

    <div id="all" class="section-content">
        <!-- <form action="#" method="get" class="searchmenu rounded-2 mb-3 bg-white py-2 px-3">
            <input type="text" name="search" placeholder="Search" style="width: 100%;">
            <button type="submit" class="m-0 ms-2"><i class="fas fa-search fa-lg small"></i></button>
        </form> -->
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'] * $order['quantity'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
        <!-- <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">PENDING PAYMENT</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                        <div>
                            <span class="fs-5">Food Name</span><br>
                            <span class="small text-muted">Variation: Chocolate, Medium</span><br>
                            <span>x1</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-end">
                        <span class="fw-bold">₱103</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/food2.jpg" width="85px" height="85px" class="border rounded-2">
                        <div>
                            <span class="fs-5">Food Name</span><br>
                            <span class="small text-muted">Variation: Chocolate, Medium</span><br>
                            <span>x1</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-end">
                        <span class="fw-bold">₱103</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between py-2 px-5">
                    <div class="d-flex gap-3 align-items-center text-muted small">
                        <span>Payment Method: Cash</span>
                        <span class="dot text-muted"></span>
                        <span>Dine in</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Total:</span>
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
                
            </div>
            <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#prepareorder">Prepare Order</button>
                <button class="rounded-2" style="background-color: #6A9C89;" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
                <button class="rounded-2" style="background-color: gray;">Remind Payment</button>
            </div>
        </div> -->
    </div>
    <div id="pendingpayment" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Pending') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <div id="preparing" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Preparing') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <div id="readyforpickup" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Ready') {
                            continue;
                        } else 
                            $order['status'] = 'Ready for Pickup';
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <div id="completed" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Completed') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <div id="canceled" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Cancelled') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <div id="scheduled" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Preparing') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $lastOrder, $total);
                                $total = 0;
                            }
                            
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= date('m/d/Y H:i', strtotime($order['order_date'])); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($order['status']); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        $itemTotal = $order['price'];
                        $total += $itemTotal;
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" 
                                    width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <?php if (!empty($order['formatted_variations'])): ?>
                                        <span class="small text-muted">Variation: <?= htmlspecialchars($order['formatted_variations']); ?></span><br>
                                    <?php endif; ?>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($itemTotal, 2); ?></span>
                            </div>
                        </div>
                        <?php
                        $lastOrder = $order;
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $lastOrder, $total);
            }
        ?>
    </div>
    <br><br><br><br>

</main>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>