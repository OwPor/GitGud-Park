<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'nav.php'; 
    include_once 'modals.php'; 
?>
<style>
    main{
        padding: 20px 120px;
    }
    .editcategory{
        color: #CD5C08;
    }
    .accordion-item, .accordion-button{
        background-color: #f4f4f4 !important;
    }
    .dropdown-menu .dropdown-item {
        padding: 10px 20px;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #f1f1f1;
        color: black;
    }

    /*
Color Palette:
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
</style>

<main>

    <div class="dropdown d-flex justify-content-end">
        <button class="addpro mb-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">+ Add New</button>
        <ul class="dropdown-menu dropdown-menu-end p-0">
            <li><a class="dropdown-item" href="addproduct.php"><i class="fa-solid fa-burger me-2"></i> Item</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-list me-2"></i> Category</a></li>
        </ul>
    </div>
    
    <div class="accordion" id="categoryitems">
        <div class="accordion-item border-0 mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button d-flex align-items-center gap-2 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#categoryitem1" aria-expanded="true" aria-controls="categoryitem1">
                    <span class="fs-5 fw-bold">Category 1</span>
                    <i class="fa-solid fa-pen rename"></i>  
                </button>
            </h2>
            <div id="categoryitem1" class="accordion-collapse collapse show">
                <div class="accordion-body p-0 pt-3">
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
                                    <button class="moreinfo" data-bs-toggle="modal" data-bs-target="#moreinfoproduct"><i class="fa-solid fa-circle-info"></i> More info</button>
                                </div>
                            </div>
                            <div class="proaction d-flex gap-2 mt-3">
                                <i class="fa-solid fa-box" onclick="window.location.href='stocks.php';"></i>
                                <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="accordion-item border-0 mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed d-flex align-items-center gap-2 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#categoryitem2" aria-expanded="false" aria-controls="categoryitem2">
                    <span class="fs-5 fw-bold">Category 2</span>
                    <i class="fa-solid fa-pen rename"></i>  
                </button>
            </h2>
            <div id="categoryitem2" class="accordion-collapse">
                <div class="accordion-body p-0 pt-3">
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
                                    <button class="moreinfo" data-bs-toggle="modal" data-bs-target="#moreinfoproduct"><i class="fa-solid fa-circle-info"></i> More info</button>
                                </div>
                            </div>
                            <div class="proaction d-flex gap-2 mt-3">
                                <i class="fa-solid fa-box" onclick="window.location.href='stocks.php';"></i>
                                <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="accordion-item border-0 mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed d-flex align-items-center gap-2 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#categoryitem3" aria-expanded="false" aria-controls="categoryitem3">
                    <span class="fs-5 fw-bold">Category 3</span>
                    <i class="fa-solid fa-pen rename"></i>  
                </button>
            </h2>
            <div id="categoryitem3" class="accordion-collapse">
                <div class="accordion-body p-0 pt-3">
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
                                    <button class="moreinfo" data-bs-toggle="modal" data-bs-target="#moreinfoproduct"><i class="fa-solid fa-circle-info"></i> More info</button>
                                </div>
                            </div>
                            <div class="proaction d-flex gap-2 mt-3">
                                <i class="fa-solid fa-box" onclick="window.location.href='stocks.php';"></i>
                                <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</main>
<?php
    include_once './footer.php'; 
?>