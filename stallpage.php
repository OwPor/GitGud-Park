<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'modals.php'; 
    require_once __DIR__ . '/classes/park.class.php';
    require_once __DIR__ . '/classes/stall.class.php';

    $parkObj = new Park();
    $stallObj = new Stall();

    if (isset($_GET['pid']) && isset($_GET['sid'])) {
        $park_link = filter_var($_GET['pid'] , FILTER_SANITIZE_STRING);
        $park = $parkObj->getPark($park_link);

        $stall_id = filter_var($_GET['sid'] , FILTER_SANITIZE_STRING);

        if (!$park) {
            header('Location: index.php');
            exit();
        }

        $stall = $stallObj->getStall($stall_id);

        if (!$stall) {
            echo 'No stall found.';
        }
    } else {
        header('Location: index.php');
        exit();
    }
?>
<main>
    <div class="pageinfo pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4 align-items-center pagelogo">
                <img src="assets/images/foodpark.jpg" alt="">
                <div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="text-muted m-0">Category</span>
                        <span class="dot text-muted"></span>
                        <span class="text-muted m-0">Category</span>
                        <span class="dot text-muted"></span>
                        <span class="text-muted m-0">Category</span>
                    </div>
                    <h5 class="my-2 fw-bold fs-2"><?= $stall['name'] ?></h5>
                    <p class="text-muted m-0"><?= $stall['description'] ?></p>

                    <div class="d-flex gap-2 align-items-center my-2">
                        <span class="pageon">Open now</span>
                        <span class="dot text-muted"></span>
                        <button class="conopepay"><i class="fa-solid fa-circle-info"></i> More info</button>
                    </div>

                    <div class="d-flex gap-5 m-0">
                        <div class="d-flex gap-2">
                            <span>Likes</span>
                            <span class="likpro">999</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>Products</span>
                            <span class="likpro">999</span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="pagelike">Like</button>
        </div>
    </div>

    <div class="d-flex pagefilter align-items-center gap-3">
        <div class="d-flex align-items-center gap-3 leftfilter">
            <form action="#" method="get" class="searchmenu">
                <button type="submit"><i class="fas fa-search fa-lg"></i></button>
                <input type="text" name="search" placeholder="Search in menu">
            </form>
            <a href="#popular" class="nav-link"><i class="fa-solid fa-fire-flame-curved"></i> Popular</a>
            <a href="#new" class="nav-link"><i class="fa-solid fa-ribbon"></i> New</a>
            <a href="#promo" class="nav-link"><i class="fa-solid fa-percent"></i> Promo</a>
        </div>

        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>

        <div class="d-flex rightfilter gap-3">
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
        </div>

        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>

    <section id="popular" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">POPULAR</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="new" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">NEW</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="promo" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">PROMO</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="category1" class="pt-3 mt-3">
        <h5>Category 1</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="category2" class="pt-3 mt-3">
        <h5>Category 2</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section id="category3" class="pt-3 mt-3">
        <h5>Category 3</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <script src="assets/js/navigation.js?v=<?php echo time(); ?>"></script>

    <br><br>
</main>
<?php
    include_once './footer.php'; 
?>