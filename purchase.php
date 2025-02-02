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
        <a href="#canceled" class="nav-link" data-target="canceled">Canceled</a>
        <a href="#scheduled" class="nav-link" data-target="scheduled">Scheduled</a>
    </div>
    <form action="#" method="get" class="searchmenu rounded-2 mt-4 bg-white py-2 px-3">
        <input type="text" name="search" placeholder="Search" style="width: 100%;">
        <button type="submit" class="m-0 ms-2"><i class="fas fa-search fa-lg small"></i></button>
    </form>
    <div id="all" class="section-content">
        <?php
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
            
            foreach ($orders as $order) {
                $status = $order['status'];
                if (isset($ordersByStatus[$status])) {
                    $ordersByStatus[$status][] = $order;
                }
            }
            
            foreach ($ordersByStatus as $status => $statusOrders) {
                if (!empty($statusOrders)) {
                    $displayStatus = isset($statusDisplayNames[$status]) ? $statusDisplayNames[$status] : $status;
                    foreach ($statusOrders as $order) {
                    ?>
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
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: Chocolate, Medium</span><br>
                                    <span>x1</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
            }
        ?>
    </div>
    <div id="topay" class="section-content">
        <?php
            foreach ($orders as $order) {
                if ($order['status'] == "ToPay") {
                ?>
                <div class="border py-3 px-4 rounded-2 bg-white mb-3">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                        <div class="d-flex gap-3 align-items-center">
                            <span class="fw-bold">ORDER ID: <?php echo htmlspecialchars($order['order_id']); ?></span>
                            <span class="dot text-muted"></span>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="fw-bold"><?php echo htmlspecialchars($order['food_stall_name']); ?></span>
                                <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <span style="color: #6A9C89" class="small"><?php echo htmlspecialchars($order['order_date']); ?></span>
                            <span class="dot text-muted"></span>
                            <span class="fw-bold" style="color: #CD5C08"><?php echo htmlspecialchars($order['status']); ?></span>
                        </div>
                    </div>
                    <?php
                    // foreach ($order['items'] as $item) {
                        ?>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="assets/images/food1.jpg" width="85px" height="85px" class="border rounded-2">
                                <div>
                                    <span class="fs-5"><?php echo htmlspecialchars($order['food_name']); ?></span><br>
                                    <span class="small text-muted">Variation: Chocolate, Medium</span><br>
                                    <span>x1</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end">
                                <span class="fw-bold">₱103</span>
                            </div>
                        </div>
                        <?php
                    // }
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
                                <span class="fw-bold fs-4">₱<?php echo htmlspecialchars($order['price']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        ?>
    </div>
    <div id="preparing" class="section-content d-none">
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="fw-bold">Food Stall Name</span>
                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                    <span class="dot text-muted"></span>
                    <span class="fw-bold" style="color: #CD5C08">PREPARING</span>
                </div>
            </div>
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: Cash</span>
                    <span class="dot text-muted"></span>
                    <span>Your order is being prepared</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="preparing rounded-2">Preparing</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div id="toreceive" class="section-content d-none">
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="fw-bold">Food Stall Name</span>
                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                    <span class="dot text-muted"></span>
                    <span class="fw-bold" style="color: #CD5C08">TO RECEIVE</span>
                </div>
            </div>
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: Cash</span>
                    <span class="dot text-muted"></span>
                    <span> Your order is ready to pickup</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="cancelorder rounded-2" data-bs-toggle="modal" data-bs-target="#orderreceived">Order Received</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div id="completed" class="section-content d-none">
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="fw-bold">Food Stall Name</span>
                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                    <span class="dot text-muted"></span>
                    <span class="fw-bold" style="color: #CD5C08">COMPLETED</span>
                </div>
            </div>
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: Cash</span>
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
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div id="canceled" class="section-content d-none">
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="fw-bold">Food Stall Name</span>
                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                    <span class="dot text-muted"></span>
                    <span class="fw-bold" style="color: #CD5C08">CANCELED</span>
                </div>
            </div>
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: Cash</span>
                    <span class="dot text-muted"></span>
                    <span>Canceled by you (Don't want to buy anymore)</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <div class="d-flex gap-2">
                        <button class="likeorder rounded-2"><i class="fa-regular fa-heart me-2"></i>Like</button>
                        <button class="cancelorder rounded-2">Buy Again</button>
                    </div>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div id="scheduled" class="section-content d-none">
        <div class="border py-3 px-4 rounded-2 bg-white mb-3">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold">ORDER ID: 0000</span>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="fw-bold">Food Stall Name</span>
                        <button class="viewstall border bg-white small px-2" onclick="window.location.href='stall.php';">View Stall</button>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span style="color: #6A9C89" class="small">07/29/2024 22:59</span>
                    <span class="dot text-muted"></span>
                    <span class="fw-bold" style="color: #CD5C08">SCHEDULED</span>
                </div>
            </div>
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between border-bottom py-2">
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
            <div class="d-flex justify-content-between pt-2">
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span>Payment Method: Cash</span>
                    <span class="dot text-muted"></span>
                    <span>Scheduled on October 15, 2024 at 1:00 PM</span>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <button class="cancelorder rounded-2" data-product-id="<?php echo $item['product_id']; ?>">Cancel Order</button>
                    <span class="dot text-muted"></span>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="text-muted">Sub Total:</span>
                        <span class="fw-bold fs-4">₱103</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <br><br><br><br>

</main>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>