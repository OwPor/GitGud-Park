<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    require_once __DIR__ . '/classes/product.class.php';
    require_once __DIR__ . '/classes/stall.class.php';

    $stallObj   = new Stall();
    $productObj = new Product();

    if (isset($_GET['id'])) {
        $stall_id = intval($_GET['id']);
        
        $stall = $parkObj->getStall($stall_id); 
        
        $products = $stallObj->getProducts($stall_id);

        $categories = $productObj->getCategories($stall_id);

        $totalProducts = $stallObj->getTotalProducts($stall_id);
    }
?>

<main>
    <div class="pageinfo pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4 align-items-center pagelogo">
                <img src="<?= htmlspecialchars($stall['logo']); ?>" alt="Stall Logo">
                <div>
                    <div class="d-flex gap-2 align-items-center">
                        <?php 
                            $stall_categories = explode(',', $stall['stall_categories']); 
                            foreach ($stall_categories as $index => $cat) { 
                        ?>
                            <p class="card-text text-muted m-0"><?= trim($cat); ?></p>
                            <?php if ($index !== array_key_last($stall_categories)) { ?>
                                <span class="dot text-muted"></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <h5 class="my-2 fw-bold fs-2"><?= htmlspecialchars($stall['name']); ?></h5>
                    <p class="text-muted m-0"><?= htmlspecialchars($stall['description']); ?></p>
                    <div class="d-flex gap-2 align-items-center my-2">
                        <span class="pageon">Open now</span>
                        <span class="dot text-muted"></span>
                        <button class="conopepay" data-bs-toggle="modal" data-bs-target="#morestallinfo"
                            data-email="<?= htmlspecialchars($stall['email']); ?>"
                            data-phone="<?= htmlspecialchars($stall['phone']); ?>"
                            data-hours="<?= htmlspecialchars($stall['stall_operating_hours']); ?>"
                            data-payment-methods="<?= htmlspecialchars($stall['stall_payment_methods']); ?>">
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
                            <span class="likpro"><?= $totalProducts; ?></span>
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
            <?php foreach ($categories as $cat): ?>
                <a href="#category<?= $cat['id']; ?>" class="nav-link"><?= htmlspecialchars($cat['name']); ?></a>
            <?php endforeach; ?>
        </div>

        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>

    <?php foreach ($categories as $cat): ?>
        <section id="category<?= $cat['id']; ?>" class="pt-3 mt-3">
            <h5><?= htmlspecialchars($cat['name']); ?></h5>
            <div class="row row-cols-1 row-cols-md-4 g-3">
                <?php 
                    $hasProducts = false;
                    foreach ($products as $product):
                        if ($product['category_id'] == $cat['id']):
                            $hasProducts = true;
                ?>
                            <div class="col">
                                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal<?= $product['id']; ?>">
                                    <div class="card position-relative">
                                        <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                                        <div class="card-body">
                                            <p class="card-text text-muted m-0"><?= htmlspecialchars($cat['name']); ?></p>
                                            <h5 class="card-title my-2"><?= htmlspecialchars($product['name']); ?></h5>
                                            <p class="card-text text-muted m-0"><?= htmlspecialchars($product['description']); ?></p>
                                            <div class="d-flex align-items-center justify-content-between my-3">
                                                <div>
                                                    <span class="proprice">₱<?= number_format($product['base_price'], 2); ?></span>
                                                    <span class="pricebefore small">₱<?= number_format($product['base_price'], 2); ?></span>
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

                            <!-- Modal for the product -->
                            <div class="modal fade menumodal" id="menumodal<?= $product['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $product['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card border-0 position-relative rounded-0">
                                                <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top custom-img rounded-0" alt="<?= htmlspecialchars($product['name']); ?>">
                                                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="card-body">
                                                    <p class="card-text text-muted m-0"><?= htmlspecialchars($cat['name']); ?></p>
                                                    <h5 class="card-title my-2"><?= htmlspecialchars($product['name']); ?></h5>
                                                    <p class="card-text text-muted m-0"><?= htmlspecialchars($product['description']); ?></p>
                                                    <div class="d-flex align-items-center justify-content-between my-3">
                                                        <div>
                                                            <span class="proprice">₱<?= number_format($product['base_price'], 2); ?></span>
                                                            <span class="pricebefore small">₱<?= number_format($product['base_price'], 2); ?></span>
                                                        </div>
                                                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                                                    </div>                          
                                                    <div class="m-0">
                                                        <span class="opennow">Popular</span>
                                                        <span class="discount">10% off</span>
                                                        <span class="newopen">New</span>
                                                    </div>
                                                    <hr>
                                                    <?php 
                                                        $variations = $stallObj->getProductVariations($product['id']);
                                                        if (!empty($variations)):
                                                    ?>
                                                        <?php foreach ($variations as $variation): ?>
                                                            <div class="vrtn mt-3">
                                                                <div class="variation-group mb-3" data-variation-id="<?= $variation['id']; ?>">
                                                                    <div class="d-flex justify-content-between variation mb-2">
                                                                        <div>
                                                                            <h5 class="mb-0"><?= htmlspecialchars($variation['name']); ?></h5>
                                                                            <span class="mt-2 tangina">Select 1</span>
                                                                        </div>
                                                                        <span class="mx-2 variationspan rounded-4 px-2 py-1 m-0">Required</span>
                                                                    </div>
                                                                    <?php 
                                                                        $options = $stallObj->getVariationOptions($variation['id']);
                                                                        foreach ($options as $option):
                                                                    ?>
                                                                        <div class="d-flex align-items-center justify-content-between variationitem mb-2" onclick="document.getElementById('variation<?= $option['id']; ?>').click()">
                                                                            <div class="form-check d-flex gap-2 align-items-center">
                                                                                <input 
                                                                                    class="form-check-input" 
                                                                                    type="radio" 
                                                                                    name="variation_<?= $variation['id']; ?>"  
                                                                                    id="variation<?= $option['id']; ?>"
                                                                                    data-addprice="<?= $option['add_price']; ?>"
                                                                                    data-subtractprice="<?= $option['subtract_price']; ?>"
                                                                                >
                                                                                <img src="<?= htmlspecialchars($option['image']); ?>" alt="<?= htmlspecialchars($option['name']); ?>" width="45px" height="45px" class="rounded-2">
                                                                                <label class="form-check-label" for="variation<?= $option['id']; ?>"><?= htmlspecialchars($option['name']); ?></label>
                                                                            </div>
                                                                            <span class="px-2">
                                                                                <?= ($option['add_price'] > 0) ? '+ ₱' . number_format($option['add_price'], 2) : (($option['subtract_price'] > 0) ? '- ₱' . number_format($option['subtract_price'], 2) : 'Free'); ?>
                                                                            </span>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <div class="speins mt-4 mb-5">
                                                        <div class="mb-3">
                                                            <h5 class="mb-0">Special Instructions</h5>
                                                            <span class="mt-2">Special requests are subject to the restaurant's approval. Tell us here!</span>
                                                        </div>
                                                        <div class="input-group m-0">
                                                            <textarea 
                                                                name="specialinstructions<?= $product['id'] ?>" 
                                                                id="specialinstructions<?= $product['id'] ?>" 
                                                                placeholder="e.g. No mayo (Optional)" 
                                                                class="rounded-2" 
                                                                rows="3"
                                                            ></textarea>
                                                        </div>                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-3 ordquantity">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-minus" onclick="updateQuantity(<?= $product['id']; ?>, -1)"></i>
                                                <span id="quantity<?= $product['id']; ?>" class="ordquanum">1</span>
                                                <i class="fa-solid fa-plus" onclick="updateQuantity(<?= $product['id']; ?>, 1)"></i>
                                            </div>
                                            <button type="button" class="btn btn-primary w-100" onclick="addToCart(<?= $product['id']; ?>)">Add to cart</button>
                                        </div>
                                        <script>
                                            function addToCart(productId) {
                                                let quantity = parseInt(document.getElementById("quantity" + productId).innerText);
                                                let specialInstructions = document.getElementById("specialinstructions" + productId)?.value || '';
                                                let modal = document.getElementById("menumodal" + productId);
                                                let variationGroups = modal.querySelectorAll(".variation-group");
                                                let variationOptionIds = [];
                                                let basePriceText = modal.querySelector(".proprice").innerText;
                                                let basePrice = parseFloat(basePriceText.replace("₱", "").trim());

                                                variationGroups.forEach(group => {
                                                    let checked = group.querySelector("input[type='radio']:checked");
                                                    if (checked) {
                                                        variationOptionIds.push(checked.id.replace("variation", ""));
                                                    }
                                                });
                                                
                                                let params = `product_id=${productId}&quantity=${quantity}&base_price=${basePrice}&request=${encodeURIComponent(specialInstructions)}`;
                                                variationOptionIds.forEach(id => {
                                                    params += `&variation_options[]=${id}`;
                                                });
                                                
                                                let xhr = new XMLHttpRequest();
                                                xhr.open("POST", "add_to_cart.php", true);
                                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                xhr.onreadystatechange = function () {
                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                        alert(xhr.responseText);
                                                    }
                                                };
                                                
                                                xhr.send(params);
                                            }

                                        </script>
                                    </form>
                                </div>
                            </div>
                <?php 
                        endif;
                    endforeach;
                ?>
                <?php if (!$hasProducts): ?>
                    <div class="col">
                        <p>No products found for this category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endforeach; ?>

    <br><br><br><br><br><br>
    
    <script>
        function updateQuantity(productId, change) {
            const quantitySpan = document.getElementById("quantity" + productId);
            let quantity = parseInt(quantitySpan.innerText);
            quantity = Math.max(1, quantity + change);
            quantitySpan.innerText = quantity;
        }
    </script>
    
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

            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            const hours = button.getAttribute('data-hours');
            const paymentMethods = button.getAttribute('data-payment-methods');

            modal.querySelector('.modal-body span[data-email]').textContent = email || 'N/A';
            modal.querySelector('.modal-body span[data-phone]').textContent = phone || 'N/A';

            const hoursContainer = modal.querySelector('.modal-body div[data-hours]');
            hoursContainer.innerHTML = hours
                ? hours.split('; ').map(hour => `<p>${hour}</p>`).join('')
                : '<p>No operating hours available</p>';

            const paymentContainer = modal.querySelector('.modal-body div[data-payment-methods]');
            paymentContainer.innerHTML = paymentMethods
                ? paymentMethods.split(', ').map(method => `<div><i class="fa-solid fa-check me-2"></i><span>${method}</span></div>`).join('')
                : '<p>No payment methods available</p>';
        });

    </script>
    
    <script src="assets/js/navigation.js?v=<?php echo time(); ?>"></script>

</main>

<?php
    include_once 'modals.php'; 
    include_once './footer.php'; 
?>
