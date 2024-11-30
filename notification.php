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
    <div class="d-flex justify-content-between align-items-center border py-3 px-4 rounded-2 bg-white mb-3 carttop">
        <h4 class="fw-bold mb-0">Notifications</h4>
        <button>Mark all as read</button>
    </div>
    <div class="d-flex justify-content-between align-items-center border py-3 px-4 rounded-2 bg-white border-bottom">
        <div class="d-flex gap-3 align-items-center">
            <img src="assets/images/stall1.jpg" weight="85" height="85">
            <div>
                <h5 class="fw-bold m-0">Order ID 0034: Ready to pickup!</h5>
                <p class="my-1">Your order at Stall Name is ready for pickup. Please proceed to the counter with your receipt to collect your order</p>
                <span class="text-muted">10/02/2024 22:00</span>
            </div>
        </div>
        <button class="p-1 border bg-white small" onclick="window.location.href='purchase.php#toreceive';">View Details</button>
    </div>
    <div class="d-flex justify-content-between align-items-center border py-3 px-4 rounded-2 bg-white border-bottom">
        <div class="d-flex gap-3 align-items-center">
            <img src="assets/images/stall1.jpg" weight="85" height="85">
            <div>
                <h5 class="fw-bold m-0">Order ID 0034: Preparing Order</h5>
                <p class="my-1">Your order at Stall Name is now in preparation queue</p>
                <span class="text-muted">10/02/2024 22:00</span>
            </div>
        </div>
        <button class="p-1 border bg-white small" onclick="window.location.href='purchase.php#preparing';">View Details</button>
    </div>
    <div class="d-flex justify-content-between align-items-center border py-3 px-4 rounded-2 bg-white border-bottom">
        <div class="d-flex gap-3 align-items-center">
            <img src="assets/images/gitgud.png" weight="85" height="85">
            <div>
                <h5 class="fw-bold m-0">Order ID 0034: Payment Confirmed!</h5>
                <p class="my-1">All your payments have been successfully confirmed! Here's your receipt—click to view and download</p>
                <span class="text-muted">10/02/2024 22:00</span>
            </div>
        </div>
        <button class="p-1 border bg-white small" onclick="window.location.href='#';">View Receipt</button>
    </div>
    <br><br><br><br><br>
</main>
<?php 
    include_once 'footer.php'; 
?>