<?php
    include_once 'links.php'; 
    /*include_once 'header.php'; 
    include_once 'nav.php'; */
?>
<style>
    main{
        padding: 20px 120px;
    }
    .dashicon{
        height: 40;
        width: 40px;
        border-radius: 50%;
        background-color: #f4f4f4;
        color: gray;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<main>
    <div class="d-flex align-items-center gap-3">
        <div class="p-3 rounded-2 border bg-white w-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="m-0">Total Food Stalls</p>
                    <span class="small" style="color: #ccc;">Jan 04, 2025</span>
                </div>
                <i class="fa-solid fa-parachute-box dashicon fs-5"></i>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h2 class="fw-bold m-0">10</h2>
                <div class="d-flex align-items-center small text-success gap-1">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span class="text-success">11%</span>
                </div>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="m-0">Total Sales</p>
                    <span class="small" style="color: #ccc;">Jan 04, 2025</span>
                </div>
                <i class="fa-solid fa-parachute-box dashicon fs-5"></i>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h2 class="fw-bold m-0">₱1,000</h2>
                <div class="d-flex align-items-center small text-success gap-1">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span class="text-success">11%</span>
                </div>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="m-0">Total Transaction</p>
                    <span class="small" style="color: #ccc;">Jan 04, 2025</span>
                </div>
                <i class="fa-solid fa-parachute-box dashicon fs-5"></i>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h2 class="fw-bold m-0">20</h2>
                <div class="d-flex align-items-center small text-success gap-1">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span class="text-success">11%</span>
                </div>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="m-0">Total Visit</p>
                    <span class="small" style="color: #ccc;">Jan 04, 2025</span>
                </div>
                <i class="fa-solid fa-parachute-box dashicon fs-5"></i>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h2 class="fw-bold m-0">10</h2>
                <div class="d-flex align-items-center small text-success gap-1">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span class="text-success">11%</span>
                </div>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="m-0">Total Food Stalls</p>
                    <span class="small" style="color: #ccc;">Jan 04, 2025</span>
                </div>
                <i class="fa-solid fa-parachute-box dashicon fs-5"></i>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h2 class="fw-bold m-0">10</h2>
                <div class="d-flex align-items-center small text-success gap-1">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span class="text-success">11%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-3 my-3">
        <div class="p-4 rounded-2 border bg-white w-75">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0 fw-bold">Food Stall Performance</h5>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <div class="mt-3">
                <canvas id="stallPerformanceChart" width="100%" height="300"></canvas>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-25">

        </div>
    </div>
    <div class="d-flex gap-3 my-3">
        <div class="p-4 rounded-2 border bg-white w-75">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0 fw-bold">Food Stall Performance</h5>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <div class="mt-3">
                <canvas id="salesChart" height="110"></canvas>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-25">

        </div>
    </div>
    <div class="d-flex gap-3 my-3">
        <div class="p-4 rounded-2 border bg-white w-75">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="m-0 fw-bold">Food Stall Performance</h5>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <div class="mt-3">
                <canvas id="salesChart" width="100%" height="300"></canvas>
            </div>
        </div>
        <div class="p-3 rounded-2 border bg-white w-25">

        </div>
    </div>
    <br><br><br><br>
</main>
<script src="assets/js/dashboardchart.js?v=<?php echo time(); ?>"></script>
<script src="./assets/js/sales.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>