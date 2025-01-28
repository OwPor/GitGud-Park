<?php
    include_once 'header.php'; 
    include_once 'links.php'; 
    include_once 'nav.php';
    include_once 'modals.php';
    require_once __DIR__ . '/classes/stall.class.php';

    $stallObj = new Stall();
    $stallId = $stallObj->getStallId($_SESSION['user']['id']);
    $products = $stallObj->getProducts($stallId);
?>
<style>
    main{
        padding: 20px 120px;
    }
</style>

<main>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-3 align-items-center">
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2 bg-white">
                <option value="all">All</option>
            </select>
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2 bg-white">
                <option value="all">All</option>
            </select>
            <i class="fa-regular fa-circle-down rename bg-white"></i>
            <div class="d-flex gap-2 align-items-center small rename py-1 px-2 bg-white">
                <span style="cursor: context-menu;">47s</span>
                <i class="fa-solid fa-arrow-rotate-left"></i>
            </div>
            <form action="#" method="get" class="searchmenu bg-white">
                <button type="submit"><i class="fas fa-search fa-lg small"></i></button>
                <input type="text" name="search" placeholder="Search">
            </form>
        </div>
        <div class="dropdown">
            <button class="addpro dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">+ Add New</button>
            <ul class="dropdown-menu dropdown-menu-end p-0">
                <li><a class="dropdown-item" href="addproduct.php"><i class="fa-solid fa-burger me-2"></i> Item</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addcategory"><i class="fa-solid fa-list me-2"></i> Category</a></li>
            </ul>
        </div>
    </div>
    <div class="accordion" id="categoryitems">
        <div class="accordion-item">
            <h2 class="accordion-header m-0">
                <button class="accordion-button d-flex align-items-center gap-2 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <p class="m-0 fw-bold">Bundle Meal</p>
                    <span class="editcategory" data-bs-toggle="modal" data-bs-target="#editcategory">Edit Category</span>  
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body pt-0 pb-4">
                    <div class="inventory">
                        <!-- <div class="d-flex justify-content-between productdet rounded-2">
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
                                <i class="fa-solid fa-box" onclick="window.location.href='stocks.php';"></i>
                                <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
                            </div>
                        </div> -->
                        <?php
                            if ($products && count($products) > 0) {
                                foreach ($products as $product) {
                                    echo '<div class="d-flex justify-content-between productdet rounded-2">';
                                    echo '    <div class="d-flex gap-4 align-items-center proinf">';
                                    echo '        <div class="position-relative">';
                                    echo '            <img src="' . htmlspecialchars($product['file_path']) . '" alt="">';
                                    if ($product['stock'] > 0 && $product['stock_warn'] >= $product['stock']) 
                                        echo '<div class="prostockstat" style="background-color: #ff9800;">LOW STOCK</div>';
                                    else if ($product['stock'] == 0)
                                        echo '<div class="prostockstat" style="background-color: #dc3545;">OUT OF STOCK</div>';

                                    $hasDiscount = false;
                                    if ($product['discount'] > 0) {
                                        $hasDiscount = true;
                                        if ($product['discount_type'] == 'Percentage')
                                            echo '<div class="prodis">' . $product['discount'] . '%</div>';
                                        else
                                            echo '<div class="prodis">P' . $product['discount'] . '</div>';
                                    }

                                    echo '        </div>';
                                    echo '        <div>';
                                    echo '            <div class="d-flex gap-3 m-0 small">';
                                    echo '                <span>' . htmlspecialchars($product['code']) . '</span>';
                                    echo '                <span>|</span>';
                                    echo '                <span>' . htmlspecialchars($product['category_name']) . '</span>';
                                    echo '            </div>';
                                    echo '            <h5 class="fw-bold my-2">' . htmlspecialchars($product['name']) . '</h5>';
                                    echo '            <span class="small">' . htmlspecialchars($product['description']) . '</span>';
                                    echo '            <div class="d-flex gap-5 align-items-center propl">';

                                    if ($hasDiscount) {
                                        if ($product['discount_type'] == 'Percentage')
                                            echo '<span class="proprice">P' . number_format($product['price'] - ($product['price'] * ($product['discount'] / 100)), 2) . '</span>';
                                        else
                                            echo '<span class="proprice">P' . number_format($product['price'] - $product['discount'], 2) . '</span>';
                                    } else {
                                        echo '<span class="proprice">P' . number_format($product['price'], 2) . '</span>';
                                    }
                                    
                                    echo '                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>';
                                    echo '            </div>';
                                    echo '            <button class="moreinfo" data-bs-toggle="modal" data-bs-target="#moreinfoproduct"><i class="fa-solid fa-circle-info"></i> More info</button>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '    <div class="proaction d-flex gap-2 mt-3">';
                                    echo '        <i class="fa-solid fa-box" onclick="window.location.href=\'stocks.php\';"></i>';
                                    echo '        <i class="fa-solid fa-pen-to-square" onclick="window.location.href=\'editproduct.php?id=' . $product['id'] . '\';"></i>';
                                    echo '        <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct" data-product-id="' . $product['id'] . '"></i>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>No products found for this stall.</p>'; // Message if no products are available
                            }
                            ?>
                        <div class="d-flex justify-content-between productdet rounded-2">
                            <div class="d-flex gap-4 align-items-center proinf">
                                <div class="position-relative">
                                    <img src="assets/images/food2.jpg" alt="">
                                    <div class="prostockstat" style="background-color: #dc3545;">OUT OF STOCK</div>
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
        <div class="accordion-item">
            <h2 class="accordion-header m-0">
                <button class="accordion-button d-flex align-items-center gap-2 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <p class="m-0 fw-bold">Other Meal</p>
                    <span class="editcategory" data-bs-toggle="modal" data-bs-target="#editcategory">Edit Category</span>  
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show">
                <div class="accordion-body pt-0 pb-4">
                    <div class="inventory">
                        <div class="d-flex justify-content-between productdet rounded-2">
                            <div class="d-flex gap-4 align-items-center proinf">
                                <div class="position-relative">
                                    <img src="assets/images/food3.jpg" alt="">
                                    <div class="prostockstat" style="background-color: #dc3545;">OUT OF STOCK</div>
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
                        <div class="d-flex justify-content-between productdet rounded-2">
                            <div class="d-flex gap-4 align-items-center proinf">
                                <div class="position-relative">
                                    <img src="assets/images/food4.jpg" alt="">
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
                        <div class="d-flex justify-content-between productdet rounded-2">
                            <div class="d-flex gap-4 align-items-center proinf">
                                <div class="position-relative">
                                    <img src="assets/images/food5.jpg" alt="">
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
                                <i class="fa-solid fa-box" onclick="window.location.href='stocks.php';"></i>
                                <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editproduct.php';"></i>
                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteproduct"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
</main>
<?php
    include_once './footer.php'; 
?>