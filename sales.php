<?php
    include_once 'header.php'; 
    include_once 'links.php'; 
    include_once 'modals.php'; 
    // include_once 'nav.php';
?>
<style>
    main{
        padding: 20px 120px;
    }
</style>

<main>
    <div class="nav-container d-flex gap-3 my-2">
        <a href="#today" class="nav-link" data-target="today">Today</a>
        <a href="#yesterday" class="nav-link" data-target="yesterday">Yesterday</a>
        <a href="#seven" class="nav-link" data-target="seven">7 Days</a>
        <a href="#thirty" class="nav-link" data-target="thirty">30 Days</a>
        <a href="#year" class="nav-link" data-target="year">1 Year</a>
    </div>
 
    <div id="today" class="section-content">
        <div class="d-flex gap-3 mb-3">
            <div class="bg-white border rounded-2 p-4 w-75">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2 align-items-center">
                        <h5 class="m-0 fw-bold">Sales Today</h5>
                        <span class="small text-muted">(Nov 19, 2024)</span>
                    </div>
                    <span class="small py-1 px-2 rounded-5 salesdr" style="color: #CD5C08;">Download Report
                        <i class="fa-regular fa-circle-down ms-2"></i>
                    </span>
                </div>
                <div class="w-100 d-flex my-4">
                    <div class="cartot btn-group w-50" role="group">
                        <button type="button" class="btn-toggle active rounded" id="outletView">Outlet View</button>
                        <button type="button" class="btn-toggle rounded" id="chartView">Chart View</button>
                    </div>
                    <div class="w-25 text-end">
                        <h4 class="m-0 fw-bold">53</h4>
                        <span class="small">Total Orders</span>
                    </div>
                    <div class="w-25 text-end">
                        <h4 class="m-0 fw-bold">₱433</h4>
                        <span class="small">Total Sales</span>
                    </div>
                </div>
                <!-- Outlet View (Table) -->
                <table class="salestable w-100" id="outletViewTable">
                    <tr>
                        <th class="w-50">Product Name</th>
                        <th class="text-end w-25">Order Count</th>
                        <th class="text-end w-25">Sales</th>
                    </tr>
                    <!-- Products -->
                    <tr>
                        <td>Product 1</td>
                        <td class="text-end">10</td>
                        <td class="text-end">₱100</td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td class="text-end">20</td>
                        <td class="text-end">₱200</td>
                    </tr>
                    <tr>
                        <td>Product 3</td>
                        <td class="text-end">30</td>
                        <td class="text-end">₱300</td>
                    </tr>
                    <tr>
                        <td>Product 4</td>
                        <td class="text-end">25</td>
                        <td class="text-end">₱250</td>
                    </tr>
                    <tr>
                        <td>Product 5</td>
                        <td class="text-end">15</td>
                        <td class="text-end">₱150</td>
                    </tr>
                    <tr>
                        <td>Product 6</td>
                        <td class="text-end">18</td>
                        <td class="text-end">₱180</td>
                    </tr>
                    <tr>
                        <td>Product 7</td>
                        <td class="text-end">22</td>
                        <td class="text-end">₱220</td>
                    </tr>
                    <tr>
                        <td>Product 8</td>
                        <td class="text-end">16</td>
                        <td class="text-end">₱160</td>
                    </tr>
                    <tr>
                        <td>Product 9</td>
                        <td class="text-end">12</td>
                        <td class="text-end">₱120</td>
                    </tr>
                    <tr>
                        <td>Product 10</td>
                        <td class="text-end">28</td>
                        <td class="text-end">₱280</td>
                    </tr>
                </table>

                <div class="d-flex gap-3 saletabpag align-items-center justify-content-center mt-3">
                    <!-- Pagination will be dynamically generated -->
                </div>

                <!-- Chart View (Graph) -->
                <div id="chartContainer" class="d-none">
                    <canvas id="salesChart" width="100%" height="271"></canvas>
                </div>
            </div>
            <div class="bg-white border p-4 w-25 rounded-2">
                <h5 class="m-0 fw-bold mb-1">Live Ops Monitor</h5>
                <span class="small text-muted">We found some ongoing issues for your food stall</span>
                <div class="d-flex align-items-center border rounded-2 py-2 my-2">
                    <h4 class="text-danger px-3 m-0 fw-bold">2</h4>
                    <div>
                        <p class="m-0 fw-bold">Canceled Orders</p>
                        <span class="text-muted small">Today</span>
                    </div>
                    <i class="fa-solid fa-angle-right ms-auto me-3"></i> <!-- The ms-auto class pushes the icon to the right -->
                </div>
                <div class="d-flex align-items-center border rounded-2 py-2 mb-2">
                    <h4 class="text-success px-3 m-0 fw-bold">3</h4>
                    <div>
                        <p class="m-0 fw-bold">Likes</p>
                        <span class="text-muted small">Today</span>
                    </div>
                    <i class="fa-solid fa-angle-right ms-auto me-3"></i> <!-- The ms-auto class pushes the icon to the right -->
                </div>
                <div class="d-flex align-items-center border rounded-2 py-2 mb-2">
                    <h4 class="text-success px-3 m-0 fw-bold">3</h4>
                    <div>
                        <p class="m-0 fw-bold">New Customers</p>
                        <span class="text-muted small">Today</span>
                    </div>
                    <i class="fa-solid fa-angle-right ms-auto me-3"></i> <!-- The ms-auto class pushes the icon to the right -->
                </div>
                <div class="d-flex align-items-center border rounded-2 py-2">
                    <h4 class="text-success px-3 m-0 fw-bold">3</h4>
                    <div>
                        <p class="m-0 fw-bold">Repeated Customers</p>
                        <span class="text-muted small">Today</span>
                    </div>
                    <i class="fa-solid fa-angle-right ms-auto me-3"></i> <!-- The ms-auto class pushes the icon to the right -->
                </div>
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="bg-white border rounded-2 p-4 w-50">
                <h5 class="m-0 fw-bold mb-1">Operations Health</h5>
                <span class="small text-muted">We found some ongoing issues for your food stall</span>
                <div class="d-flex gap-3 my-3">
                    <div class="p-3 d-flex align-items-end border w-50 rounded-2" style="background-color: #f4f4f4;">
                        <div class="w-50">
                            <h5 class="m-0 fw-bold">₱100</h5>
                            <span>Online</span>
                        </div>
                        <span>vs.</span>
                        <div class="w-50 text-end">
                            <h5 class="m-0 fw-bold flex-end">₱100</h5>
                            <span>Cash</span>
                        </div>
                    </div>
                    <div class="p-3 d-flex align-items-end border w-50 rounded-2" style="background-color: #f4f4f4;">
                        <div class="w-50">
                            <h5 class="m-0 fw-bold">₱100</h5>
                            <span>Dine In</span>
                        </div>
                        <span>vs.</span>
                        <div class="w-50 text-end">
                            <h5 class="m-0 fw-bold flex-end">₱100</h5>
                            <span>Take Out</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="p-3 rounded-2 w-50 border" style="background-color: #f4f4f4;">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="m-0 fw-bold mb-1">12 min</h5>
                            <i class="fa-solid fa-arrow-up text-danger small fw-bold"></i>
                        </div>
                        <p class="mb-4">Avg. Preparation Time</p>
                        <span class="text-muted small">Today</span>
                    </div>
                    <div class="p-3 rounded-2 w-50 border" style="background-color: #f4f4f4;">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="m-0 fw-bold mb-1">₱100</h5>
                            <i class="fa-solid fa-arrow-down text-success small fw-bold"></i>
                        </div>
                        <p class="mb-4">Lost Sales Due to Cancel</p>
                        <span class="text-muted small">Today</span>
                    </div>
                </div>
            </div>
            <div class="bg-white border rounded-2 p-4 w-50">
                <h5 class="m-0 fw-bold mb-1">Highest Selling Product</h5>
                <span class="small text-muted">We found some ongoing issues for your food stall</span>
                <table class="salestable w-100 mt-4">
                    <tr>
                        <th class="w-50">Product Name</th>
                        <th class="text-end w-25">Order Count</th>
                        <th class="text-end w-25">Sales</th>
                    </tr>
                    <tr>
                        <td class="fw-normal">Product 1</td>
                        <td class="text-end fw-normal">10</td>
                        <td class="text-end fw-normal">₱100</td>
                    </tr>
                    <tr>
                        <td class="fw-normal">Product 2</td>
                        <td class="text-end fw-normal">20</td>
                        <td class="text-end fw-normal">₱200</td>
                    </tr>
                    <tr>
                        <td class="fw-normal">Product 3</td>
                        <td class="text-end fw-normal">30</td>
                        <td class="text-end fw-normal">₱300</td>
                    </tr>
                    <tr>
                        <td class="fw-normal">Product 4</td>
                        <td class="text-end fw-normal">25</td>
                        <td class="text-end fw-normal">₱250</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    <div id="yesterday" class="section-content d-none">

    </div>
    <div id="seven" class="section-content d-none">
    
    </div>
    <div id="thirty" class="section-content d-none">
       
    </div>
    <div id="year" class="section-content d-none">
        
    </div>
    <br><br><br><br>

</main>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>
<script src="./assets/js/sales.js?v=<?php echo time(); ?>"></script>

<?php
    include_once './footer.php'; 
?>