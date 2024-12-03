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
    <div class="d-flex justify-content-end">
        <button class="addpro mb-3 prev" onclick="window.history.back();"><i class="fa-solid fa-chevron-left me-2"></i> Previous</button>
    </div>
    <div class="d-flex justify-content-between productdet rounded-2">
        <div class="d-flex gap-4 align-items-center proinf">
            <div class="position-relative">
                <img src="assets/images/food1.jpg" alt="">
                <div class="prostockstat" style="background-color: #ff9800;">LOW STOCK</div>
                <div class="prodis">-20%</div>
            </div>
            <div>
                <div class="d-flex gap-3 m-0 small">
                    <span>Product Code</span>
                    <span>|</span>
                    <span>Category</span>
                </div>
                <h5 class="fw-bold my-2">Product Name</h5>
                <span class="small">Description</span>
                <div class="d-flex gap-5 align-items-center propl">
                    <span class="proprice">P129</span>
                    <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                </div>
                <button class="moreinfo" data-bs-toggle="modal" data-bs-target="#moreinfoproduct"><i class="fa-solid fa-circle-info"></i> More info</button>
            </div>
        </div>
        <div class="proaction d-flex gap-2 mt-3">
            <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
            <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
        </div>
    </div>
    <div class="d-flex justify-content-around stostatus bg-white rounded-2 border my-3">
        <div>
            <span><i class="fa-solid fa-arrow-right-to-bracket"></i> Total Stock In</span>
            <h1>20</h1>
        </div>
        <div>
            <span><i class="fa-solid fa-arrow-right-from-bracket"></i> Total Stock Out</span>
            <h1>20</h1>
        </div>
        <div>
            <span><i class="fa-solid fa-box"></i> Current Stock</span>
            <h1>20</h1>
        </div>
        <div>
            <span> <i class="fa-solid fa-sack-dollar"></i> Stock Value</span>
            <h1>P20</h1>
        </div>
        <div>
            <span><i class="fa-solid fa-spinner"></i> Status</span>
            <h1>LOW</h1>
        </div>
    </div>
    <div class="stockaction d-flex bg-white border rounded-2 mb-5">
        <div class="flex-grow-1 stockleft">
            <span class="text-muted fw-bold">Stock In</span>
            <form class="d-flex stockin mt-1 mb-3" id="stockin-form">
                <input type="number" name="stockin" id="stockin" placeholder="# of items">      
                <select name="stockinreason" id="stockinreason">
                    <option value="">Select a reason</option>
                    <option value="Restock">Restock</option>
                    <option value="Inventory Adjustment">Inventory Adjustment</option>
                    <option value="Bulk Orders">Bulk Orders</option>
                    <option value="Others">Others</option>
                </select>
                <input type="submit" value="Go">
            </form>
            <table id="stockin-table">
                <tr>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td class="items">34</td>
                    <td class="reason">Restock</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square edit-icon"></i>
                        <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deletestock"></i>
                    </td>
                </tr>
            </table>
        </div>
        <div class="flex-grow-1 stockright">
            <span class="text-muted fw-bold">Stock Out</span>
            <form class="d-flex stockin mt-1 mb-3">
                <input type="number" name="stockout" id="stockout" placeholder="# of items">      
                <select name="stockoutreason" id="stockoutreason">
                    <option value="">Select a reason</option>
                    <option value="Spoilage">Spoilage</option>
                    <option value="Expired">Expired</option>
                    <option value="Inventory Adjustment">Inventory Adjustment</option>
                    <option value="Theft or Loss">Theft or Loss</option>
                    <option value="Others">Others</option>
                </select>
                <input type="submit" value="Go">
            </form>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td class="items">20</td>
                    <td class="reason">Theft or Loss</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square edit-icon"></i>
                        <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deletestock"></i>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br><br> <br><br>
    <script src="assets/js/stock.js?v=<?php echo time(); ?>"></script>
</main>
<?php
    include_once './footer.php'; 
?>