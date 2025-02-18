<?php
    include_once 'header.php'; 
    include_once 'links.php'; 
    include_once 'nav.php';
    include_once 'modals.php';

    if (!isset($_SESSION['user'])) {
        header('Location: signin.php');
        exit();
    }

    $status = $_GET['status'] ?? 'all';
    $orders = $userObj->getOrders($_SESSION['user']['id']);

    // Define status order and display names
    $statusOrder = [
        'ToPay' => 1,
        'Preparing' => 2,
        'ToReceive' => 3,
        'Completed' => 4,
        'Cancelled' => 5,
        'Scheduled' => 6
    ];

    $statusDisplayNames = [
        'ToPay' => 'To Pay',
        'ToReceive' => 'To Receive',
        'Preparing' => 'Preparing',
        'Completed' => 'Completed',
        'Cancelled' => 'Cancelled',
        'Scheduled' => 'Scheduled'
    ];

    // Initialize ordersByStatus with correct order
    $ordersByStatus = [
        'ToPay' => [],
        'Preparing' => [],
        'ToReceive' => [],
        'Completed' => [],
        'Cancelled' => [],
        'Scheduled' => []
    ];

    // Sort orders by status priority, then by order date
    usort($orders, function($a, $b) use ($statusOrder) {
        // Compare status priority
        $statusCompare = $statusOrder[$a['status']] <=> $statusOrder[$b['status']];
        
        if ($statusCompare === 0) {
            // If same status, sort by order date (newest first)
            return strtotime($b['order_date']) <=> strtotime($a['order_date']);
        }
        
        return $statusCompare;
    });

    // Group orders by status while maintaining sort order
    foreach ($orders as $order) {
        $status = $order['status'];
        $ordersByStatus[$status][] = $order;
    }

    // Create a display footer function for less redundancy
    // Fix the footer for last display, it doesn't display
    function displayFooter($lastStatus, $order, $total) {
        // <!-- FOOTER -->
        if ($lastStatus == 'ToPay') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo htmlspecialchars($order['payment_method']); ?></span>
                    <span class="dot text-muted"></span>
                    <span>Your order is awaiting payment</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="cancelorder rounded-2" data-bs-toggle="modal" data-bs-target="#cancelorder">Cancel Order</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        } else if ($lastStatus == 'Preparing') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo $order['payment_method']; ?></span>
                    <span class="dot text-muted"></span>
                    <span>Your order is being prepared</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="preparing rounded-2">Preparing</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        } else if ($lastStatus == 'ToReceive') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo $order['payment_method']; ?></span>
                    <span class="dot text-muted"></span>
                    <span> Your order is ready to pickup</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="cancelorder rounded-2" data-bs-toggle="modal" data-bs-target="#orderreceived">Order Received</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        } else if ($lastStatus == 'Completed') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo $order['payment_method']; ?></span>
                    <span class="dot text-muted"></span>
                    <span> Your order is completed</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <div class="d-flex gap-2">
                        <button class="likeorder rounded-2"><i class="fa-regular fa-heart me-2"></i>Like</button>
                        <button class="cancelorder rounded-2">Buy Again</button>
                    </div>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        } else if ($lastStatus == 'Cancelled') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo $order['payment_method']; ?></span>
                    <span class="dot text-muted"></span>
                    <span>Cancelled by you (Don't want to buy anymore)</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <div class="d-flex gap-2">
                        <button class="likeorder rounded-2"><i class="fa-regular fa-heart me-2"></i>Like</button>
                        <button class="cancelorder rounded-2">Buy Again</button>
                    </div>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        } else if ($lastStatus == 'Scheduled') {
            ?>
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: <?php echo $order['payment_method']; ?></span>
                    <span class="dot text-muted"></span>
                    <span>Scheduled on <?= $order['scheduled_date'] ?></span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="cancelorder rounded-2" data-product-id="<?php echo $order['product_id']; ?>">Cancel Order</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱<?= $total ?></span>
                    </div>
                </div>
            </div>
    <?php
        }
        if ($lastStatus) {
            echo '</div>';
        }
    }
?> 
<style>
    main{
        padding: 20px 120px;
    }
</style>
<script> const userId = <?php echo $user['user_session']; ?>; </script>
<main>
    <div class="nav-container d-flex gap-3 my-2">
        <a href="#all" class="nav-link" data-target="all">All</a>
        <a href="#topay" class="nav-link" data-target="topay">To Pay</a>
        <a href="#preparing" class="nav-link" data-target="preparing">Preparing</a>
        <a href="#toreceive" class="nav-link" data-target="toreceive">To Receive</a>
        <a href="#completed" class="nav-link" data-target="completed">Completed</a>
        <a href="#canceled" class="nav-link" data-target="canceled">Cancelled</a>
        <a href="#scheduled" class="nav-link" data-target="scheduled">Scheduled</a>
    </div>
    <form action="#" method="get" class="searchmenu rounded-2 mt-4 bg-white py-2 px-3">
        <input type="text" name="search" placeholder="Search" style="width: 100%;">
        <button type="submit" class="m-0 ms-2"><i class="fas fa-search fa-lg small"></i></button>
    </form>
    <div id="all" class="section-content">
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
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                         }    
                         $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, end($orders), $total);
        ?>
        </div>
    </div>
    
    <!-- SECTIONS -->
    <div id="topay" class="section-content">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'ToPay') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>


    <div id="preparing" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Preparing') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>


    <div id="toreceive" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'ToReceive') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php 
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>


    <div id="completed" class="section-content d-none">
        <?php
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Completed') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>


    <div id="canceled" class="section-content d-none">
        <?php 
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Cancelled') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>


    <div id="scheduled" class="section-content d-none">
        <?php 
            $currentStallName = null;
            $currentOrderId = null;
            $total = 0;
            $lastStatus = null;

            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                        if ($status !== 'Scheduled') {
                            continue;
                        }
                        if ($currentStallName !== $order['food_stall_name'] || $currentOrderId !== $order['order_id']) {
                            if ($currentOrderId !== null) {
                                displayFooter($lastStatus, $order, $total);
                                $total = 0;
                            }            

                            $currentStallName = $order['food_stall_name'];
                            $currentOrderId = $order['order_id'];
                            $lastStatus = $status;
        ?>
                        <!-- HEADER -->
                        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold"><?php echo $order['food_stall_name']; ?></span>
                                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                    <span class="dot text-muted"></span>
                                    <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($displayStatus); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        $total += $order['price'];
                        ?>

                        <!-- BODY -->
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: <?= $order['formatted_variations']; ?></span><br>
                                    <span>x<?= $order['quantity']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            displayFooter($lastStatus, $order, $total);
        ?>
        </div>
    </div>

    <br><br><br><br>

</main>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>