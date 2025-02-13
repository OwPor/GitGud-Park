<?php
    include_once 'header.php'; 
    include_once 'links.php'; 
    include_once 'modals.php'; 
    include_once 'nav.php';
    require_once 'classes/stall.class.php';

    $stall = new Stall();
    $stallId = $stall->getStallId($_SESSION['user']['id']);
    $orders = $stall->getOrdersByStallId($stallId);

    $ordersByStatus = [
        'ToPay' => [],
        'Preparing' => [],
        'ToReceive' => [],
        'Completed' => [],
        'Cancelled' => [],
        'Scheduled' => []
    ];

    $statusDisplayNames = [
        'ToPay' => 'To Pay',
        'ToReceive' => 'To Receive'
    ];
    
    // First, sort the orders array
    usort($orders, function($a, $b) {
        // Compare order IDs first
        $orderCompare = $a['order_id'] <=> $b['order_id'];
        
        // If order IDs are equal, compare stall names
        if ($orderCompare === 0) {
            return strcmp($a['food_stall_name'], $b['food_stall_name']);
        }
        
        return $orderCompare;
    });

    // Then group by status
    $ordersByStatus = [];
    foreach ($orders as $order) {
        $status = $order['status'];
        if (isset($ordersByStatus[$status])) {
            $ordersByStatus[$status][] = $order;
        } else {
            $ordersByStatus[$status] = [$order];
        }
    }

    function displayFooter($lastStatus, $order, $total) {
        // Only close the flex-grow-1 div if we're displaying a footer
        ?>
        </div> <!-- Close the flex-grow-1 div -->
        <?php
        
        if ($lastStatus === "ToPay") {
            ?>
            <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
                <div class="d-flex justify-content-between py-2 px-4 w-100">
                    <div class="d-flex gap-3 align-items-center text-muted small">
                        <span>Payment Method: <?= htmlspecialchars($order['payment_method']) ?></span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Total:</span>
                        <span class="fw-bold fs-4">₱<?= number_format($total, 2) ?></span>
                    </div>
                </div>
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#prepareorder">Prepare Order</button>
                <button class="rounded-2" style="background-color: #6A9C89;" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
                <button class="rounded-2" style="background-color: gray;">Remind Payment</button>
            </div>
            <?php
        } else if ($lastStatus === "Preparing") {
            ?>
            <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
                <div class="d-flex justify-content-between py-2 px-4 w-100">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Total:</span>
                        <span class="fw-bold fs-4">₱<?= number_format($total, 2) ?></span>
                    </div>
                </div>
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#completeorder">Complete Order</button>
                <button class="rounded-2" style="background-color: #6A9C89;" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
            </div>
            <?php
        } else if ($lastStatus === "Completed") {
            ?>
            <div class="d-flex flex-column gap-4 justify-content-center align-items-center flex-shrink-0 w-25 orderbtns">
                <div class="d-flex justify-content-between py-2 px-4 w-100">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Total:</span>
                        <span class="fw-bold fs-4">₱<?= number_format($total, 2) ?></span>
                    </div>
                </div>
                <span class="text-muted">Completed</span>
            </div>
            <?php
        }
        ?>
        </div> <!-- Close the main border rounded-2 container -->
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
        <a href="#canceled" class="nav-link" data-target="canceled">Canceled</a>
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
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                            }
                            
                            $total = 0;
                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
                            ?>
                            <!-- HEADER -->
                            <div class="border rounded-2 bg-white mb-3 d-flex">
                                <div class="flex-grow-1 border-end">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                                        <span class="fw-bold">ORDER ID: <?= htmlspecialchars($order['order_id']); ?></span>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="color: #6A9C89" class="small"><?= htmlspecialchars(date('m/d/Y H:i', strtotime($order['order_date']))); ?></span>
                                            <span class="dot text-muted"></span>
                                            <span class="fw-bold" style="color: #CD5C08"><?= htmlspecialchars($displayStatus); ?></span>
                                        </div>
                                    </div>
                        <?php
                        }
                        
                        // Calculate running total
                        $total += $order['price'];
                        ?>
                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2 px-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="<?= htmlspecialchars($order['image'] ?? 'assets/images/food1.jpg') ?>" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?= htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted"><?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= htmlspecialchars($order['quantity']); ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱<?= number_format($order['price'], 2); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            
            // Display footer for the last order
            if ($currentOrderId !== null) {
                displayFooter($lastStatus, $order, $total);
            }
            ?>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="border-bottom py-3 px-5">
                    <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This order is scheduled on 1:00 PM. Please prioritize this order based on its scheduled time.</span>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex gap-3 align-items-center">
                            <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                            <span class="dot text-muted"></span>
                            <span class="fw-bold">ORDER ID: 0000</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                            <span class="dot text-muted"></span>
                            <span class="fw-bold" style="color: #CD5C08">PREPARING</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/food3.jpg" width="85px" height="85px" class="border rounded-2">
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
                        <img src="assets/images/food4.jpg" width="85px" height="85px" class="border rounded-2">
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">02</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">PREPARING</span>
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">READY FOR PICKUP</span>
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#ordercomplete">Order Complete</button>
                <button class="rounded-2" style="background-color: #6A9C89;">Notify Cusomer</button>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">COMPLETED</span>
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
                <span class="text-muted">Completed</span>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">CANCELED</span>
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
                <span class="text-muted text-center">Canceled by the customer<br>(Need to modify order)</span>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">SCHEDULED</span>
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
                <span class="text-muted text-center p-3 small">Scheduled on October 15, 2024 at 1:00 PM<br>
                (The system will automatically move this order to PREPARING 5 minutes before the scheduled time is reached)</span>
            </div>
        </div>
    </div>
    <div id="pendingpayment" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
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
        </div>
    </div>
    <div id="preparing" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="border-bottom py-3 px-5">
                    <span class="text-danger" style="font-size: 13px;"><i class="fa-solid fa-circle-exclamation me-2"></i>This order is scheduled on 1:00 PM. Please prioritize this order based on its scheduled time.</span>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex gap-3 align-items-center">
                            <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                            <span class="dot text-muted"></span>
                            <span class="fw-bold">ORDER ID: 0000</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                            <span class="dot text-muted"></span>
                            <span class="fw-bold" style="color: #CD5C08">PREPARING</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/food3.jpg" width="85px" height="85px" class="border rounded-2">
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
                        <img src="assets/images/food4.jpg" width="85px" height="85px" class="border rounded-2">
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
            </div>
        </div>
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">02</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">PREPARING</span>
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#orderready">Order Ready</button>
            </div>
        </div>
    </div>
    <div id="readyforpickup" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">READY FOR PICKUP</span>
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
                <button class="rounded-2" data-bs-toggle="modal" data-bs-target="#ordercomplete">Order Complete</button>
                <button class="rounded-2" style="background-color: #6A9C89;">Notify Cusomer</button>
            </div>
        </div>
    </div>
    <div id="completed" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="prequeue fw-bold text-white d-flex align-items-center justify-content-center">01</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold">ORDER ID: 0000</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">COMPLETED</span>
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
                <span class="text-muted">Completed</span>
            </div>
        </div>
    </div>
    <div id="canceled" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">CANCELED</span>
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
                <span class="text-muted text-center">Canceled by the customer<br>(Need to modify order)</span>
            </div>
        </div>
    </div>
    <div id="scheduled" class="section-content d-none">
        <div class="border rounded-2 bg-white mb-3 d-flex">
            <div class="flex-grow-1 border-end">
                <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-5">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <div class="d-flex gap-3 align-items-center">
                        <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                        <span class="dot text-muted"></span>
                        <span class="fw-bold" style="color: #CD5C08">SCHEDULED</span>
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
                <span class="text-muted text-center p-3 small">Scheduled on October 15, 2024 at 1:00 PM<br>
                (The system will automatically move this order to PREPARING 5 minutes before the scheduled time is reached)</span>
            </div>
        </div>
    </div>
    <br><br><br><br>

</main>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>