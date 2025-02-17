<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    require_once __DIR__ . '/classes/product.class.php';
    require_once __DIR__ . '/classes/stall.class.php';

    $stallObj   = new Stall();
    $productObj = new Product();

    if (isset($_GET['id'])) {
        $stall_id = intval($_GET['id']);
        $stall = $stallObj->getStall($stall_id); 
        $products = $stallObj->getProducts($stall_id);
        $categories = $productObj->getCategories($stall_id);
        $totalProducts = $stallObj->getTotalProducts($stall_id);
    }
?>

<main>
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
                                                let totalAdditional = 0;
                                                let totalSubtraction = 0;
                                                
                                                variationGroups.forEach(group => {
                                                    let checked = group.querySelector("input[type='radio']:checked");
                                                    if (checked) {
                                                        variationOptionIds.push(checked.id.replace("variation", ""));
                                                        totalAdditional += parseFloat(checked.dataset.addprice) || 0;
                                                        totalSubtraction += parseFloat(checked.dataset.subtractprice) || 0;
                                                    }
                                                });
                                                
                                                let basePriceText = modal.querySelector(".proprice").innerText;
                                                let basePrice = parseFloat(basePriceText.replace("₱", "").trim());
                                                let finalPrice = basePrice + totalAdditional - totalSubtraction;
                                                let params = `product_id=${productId}&quantity=${quantity}&price=${finalPrice}&request=${encodeURIComponent(specialInstructions)}`;
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
</main>

<?php
    include_once 'modals.php'; 
    include_once './footer.php'; 
?>
