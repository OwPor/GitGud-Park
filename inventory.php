<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
?>
<style>
    main{
        padding: 20px 120px;
    }
</style>

<main>
    <div class="d-flex justify-content-end">
        <button class="addpro mb-3" onclick="window.location.href='addproduct.php';">+ Add Product</button>
    </div>
    <div class="inventory">
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
                <i class="fa-solid fa-box"></i>
                <i class="fa-solid fa-pen-to-square"></i>
                <i class="fa-solid fa-trash"></i>
            </div>
        </div>
        <div class="d-flex justify-content-between productdet">
            <div class="d-flex gap-4 align-items-center proinf">
                <img src="assets/images/foodpark.jpg" alt="">
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
                <i class="fa-solid fa-box"></i>
                <i class="fa-solid fa-pen-to-square"></i>
                <i class="fa-solid fa-trash"></i>
            </div>
        </div>
    </div>

</main>
<?php
    include_once './footer.php'; 
?>