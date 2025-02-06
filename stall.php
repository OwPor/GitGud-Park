<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    require_once __DIR__ . '/classes/product.class.php';
    require_once __DIR__ . '/classes/stall.class.php';
    
    $stallObj = new Stall();
    $productObj = new Product();

    if (isset($_GET['id'])) {
        $stall_id = intval($_GET['id']); 
        
        $stall = $parkObj->getStall($stall_id); 

        $totalProducts = $stallObj->getTotalProducts($stall_id);
    }

    /*if (isset($_GET['pid']) && isset($_GET['sid'])) {
        $park_link = htmlspecialchars($_GET['pid'], ENT_QUOTES, 'UTF-8');
        $park = $parkObj->getPark($park_link);

        $stall_id = htmlspecialchars($_GET['sid'], ENT_QUOTES, 'UTF-8');

        if (!$park) {
            header('Location: index.php');
            exit();
        }

        $stall = $stallObj->getStall($stall_id);
        $totalProducts = $stallObj->getTotalProducts($stall_id);

        if (!$stall) {
            header('Location: index.php');
            exit();
        }
    } else {
        header('Location: index.php');
        exit();
    }*/

?>
<main>
    <div class="pageinfo pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4 align-items-center pagelogo">
                <img src="<?= $stall['logo'] ?>">
                <div>
                    <div class="d-flex gap-2 align-items-center">
                        <?php 
                            $stall_categories = explode(',', $stall['stall_categories']); 
                            foreach ($stall_categories as $index => $category) { 
                        ?>
                            <p class="card-text text-muted m-0"><?= trim($category) ?></p>
                            <?php if ($index !== array_key_last($stall_categories)) { ?>
                                <span class="dot text-muted"></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <h5 class="my-2 fw-bold fs-2"><?= $stall['name'] ?></h5>
                    <p class="text-muted m-0"><?= $stall['description'] ?></p>

                    <div class="d-flex gap-2 align-items-center my-2">
                        <span class="pageon">Open now</span>
                        <span class="dot text-muted"></span>
                        <button class="conopepay" data-bs-toggle="modal" data-bs-target="#morestallinfo"
                            data-email="<?= htmlspecialchars($stall['email']) ?>"
                            data-phone="<?= htmlspecialchars($stall['phone']) ?>"
                            data-hours="<?= htmlspecialchars($stall['stall_operating_hours']) ?>"
                            data-payment-methods="<?= htmlspecialchars($stall['stall_payment_methods']) ?>">
                            <i class="fa-solid fa-circle-info"></i> More info
                        </button>
                    </div>

                    <div class="d-flex gap-5 m-0">
                        <div class="d-flex gap-2">
                            <span>Likes</span>
                            <span class="likpro">999</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>Products</span>
                            <span class="likpro"><?php echo $totalProducts; ?></span>
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
        <?php
            $products = $productObj->getProducts($stall_id);

            if ($products) {
                foreach ($products as $product) {
                    echo '
                        <div class="col">
                            <a href="#" 
                            class="card-link text-decoration-none" 
                            data-bs-toggle="modal" 
                            data-bs-target="#menumodal"
                            data-name="' . htmlspecialchars($product['name']) . '"
                            data-description="' . htmlspecialchars($product['description']) . '"
                            data-price="' . number_format($product['price'], 2) . '"
                            data-image="' . htmlspecialchars($product['file_path']) . '"
                            data-product-id="' . htmlspecialchars($product['id']) . '"
                            data-stall-id="' . htmlspecialchars($stall_id) . '"
                            >
                                <div class="card position-relative">
                                    <img src="' . htmlspecialchars($product['file_path']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">
                                    <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                                    <div class="card-body">
                                        <p class="card-text text-muted m-0">' . htmlspecialchars($product['category']) . '</p>
                                        <h5 class="card-title my-2">' . htmlspecialchars($product['name']) . '</h5>
                                        <p class="card-text text-muted m-0">' . htmlspecialchars($product['description']) . '</p>
                                        <div class="d-flex align-items-center justify-content-between my-3">
                                            <div>
                                                <span class="proprice">₱' . number_format($product['price'], 2) . '</span>
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
                    ';
                }
            }
        ?>
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



    <!-- More stall info -->
    <div class="modal fade" id="morestallinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold m-0">More Info</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h5 class="fw-bold mb-3">Business Contact</h5>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Business Email</span>
                            <span data-email></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Business Phone Number</span>
                            <span data-phone>+639123456789</span>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Operating Hours</h5>
                    <div class="mb-4" data-hours>
                        <!-- Dynamically added operating hours -->
                    </div>

                    <h5 class="fw-bold mb-3">Payment Accepted</h5>
                    <div class="mb-4" data-payment-methods>
                    
                    </div>

                    <button class="border-0 py-2 px-3 rounded-5 me-2"><i class="fa-regular fa-copy me-2 fs-5"></i>Share Link</button>
                    <button class="border-0 py-2 px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#report"><i class="fa-regular fa-flag me-2 fs-5"></i>Report</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = document.getElementById('morestallinfo');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Get data attributes
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            const hours = button.getAttribute('data-hours');
            const paymentMethods = button.getAttribute('data-payment-methods');

            // Populate modal fields
            modal.querySelector('.modal-body span[data-email]').textContent = email || 'N/A';
            modal.querySelector('.modal-body span[data-phone]').textContent = phone || 'N/A';

            // Populate operating hours
            const hoursContainer = modal.querySelector('.modal-body div[data-hours]');
            hoursContainer.innerHTML = hours
                ? hours.split('; ').map(hour => `<p>${hour}</p>`).join('')
                : '<p>No operating hours available</p>';

            // Populate payment methods
            const paymentContainer = modal.querySelector('.modal-body div[data-payment-methods]');
            paymentContainer.innerHTML = paymentMethods
                ? paymentMethods.split(', ').map(method => `<div><i class="fa-solid fa-check me-2"></i><span>${method}</span></div>`).join('')
                : '<p>No payment methods available</p>';
        });

    </script>

    <script src="assets/js/navigation.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/productmodal.js?v=<?php echo time(); ?>"></script>
    <br><br>  

</main>

<?php
    include_once 'modals.php'; 
    include_once './footer.php'; 
?>
