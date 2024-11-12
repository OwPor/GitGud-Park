<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
?>
<style>
    main{
        padding: 20px 120px;
    }
    .stostatus{
        padding: 20px 0;
    }
    .stostatus h1{
        font-weight: bold;
        margin: 15px 0 0 0;
    }
    .stostatus span{
        color: #CD5C08;
    }
    .stostatus i{
        margin-right: 5px;
    }
    .stostatus div{
        text-align: center;
    }
    .stockaction input, .stockaction select{
        padding: 5px 10px;
        outline: none;
        border-radius: 0;
        border: 1px #ccc solid;
    }
    .stockin input[type="number"]{
        width: 150px;
    }
    .stockaction select{
        width: 100%;
    }
    .stockin input[type="submit"]{
        background-color: ;
    }
    .stockaction table th{
        padding: 10px 0;
        border: 2px solid white;
    }
    .stockaction table td{
        border-bottom: 1px #ccc solid;
        padding: 10px 0;
    }
    .stockaction table th{
        background-color: #C1D8C3;
        color: #6A9C89;
    }
    .stockaction table {
        width: 100%;
        text-align: center;
        border-collapse: collapse !important;
    }
    .stoaction i{
        padding: 4px;
        font-size: 15px;
    }
    .stoaction{
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }
    .stockleft{
    padding: 20px;
    border-right: 1px #ccc solid;
    }
    .stockright{
    padding: 20px;
    }
    .prev{
        background-color: gray;
    }
    .prev:hover{
        background-color: #8F8F8F;
    }
</style>

<main>
    <div class="d-flex justify-content-end">
        <button class="addpro mb-3 prev" onclick="window.location.href='inventory.php';"><i class="fa-solid fa-chevron-left me-2"></i> Previous</button>
    </div>
    <div class="d-flex justify-content-between productdet">
        <div class="d-flex gap-4 align-items-center proinf">
            <div class="position-relative">
                <img src="assets/images/user.jpg" alt="">
                <div class="prostockstat">LOW STOCK</div>
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
                <button class="moreinfo"><i class="fa-solid fa-circle-info"></i> More info</button>
            </div>
        </div>
        <div class="proaction d-flex gap-2 mt-3">
            <i class="fa-solid fa-pen-to-square"></i>
            <i class="fa-solid fa-trash"></i>
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
            <form class="d-flex stockin mt-1 mb-3">
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
            <table>
                <tr>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td>Restock</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td>Restock</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td>Restock</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td>Restock</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            </table>
            <div>
                
            </div>
        </div>
        <div class="flex-grow-1 stockright">
            <span class="text-muted fw-bold">Stock Out</span>
            <form class="d-flex stockin mt-1 mb-3">
                <input type="number" name="stockout" id="stockout" placeholder="# of items">      
                <select name="stockoutreason" id="stockoutreason">
                    <option value="">Select a reason</option>
                    <option value="Restock">Spoilage</option>
                    <option value="Inventory Adjustment">Expired</option>
                    <option value="Bulk Orders">Inventory Adjustment</option>
                    <option value="Others">Theft or Loss</option>
                    <option value="Others">Others</option>
                </select>
                <input type="submit" value="Go">
            </form>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>07/29/2024 22:59</td>
                    <td>Theft or Loss</td>
                    <td class="stoaction">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</main>
<?php
    include_once './footer.php'; 
?>