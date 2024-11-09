<link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">

<!-- Menu Modal -->
<div class="modal fade" id="menumodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body p-0">
            <div class="card border-0 position-relative rounded-0">
                <img src="assets/images/example.jpg" class="card-img-top custom-img rounded-0" alt="...">
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <hr>
                    <div class="vrtn mt-3">
                        <div class="d-flex align-items-center justify-content-between variation mb-2">
                            <h5 class="mb-0">Choose your Drink</h5>
                            <span class="mx-2">Required</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between variationitem" onclick="document.getElementById('variationname1').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variationname" id="variationname1">
                                <label class="form-check-label" for="variationname1">Variation Name</label>
                            </div>
                            <span class="px-2">+ ₱13</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between variationitem" onclick="document.getElementById('variationname2').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variationname" id="variationname2">
                                <label class="form-check-label" for="variationname2">Variation Name</label>
                            </div>
                            <span class="px-2">+ ₱13</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between variationitem" onclick="document.getElementById('variationname3').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variationname" id="variationname3">
                                <label class="form-check-label" for="variationname3">Variation Name</label>
                            </div>
                            <span class="px-2">+ ₱13</span>
                        </div>
                    </div>
                    <div class="addons mt-3">
                        <div class="d-flex align-items-center justify-content-between addon mb-2">
                            <h5 class="mb-0">Add-Ons</h5>
                            <span class="mx-2">Optional</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname1').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname1">
                                <label class="form-check-label" for="addonname1">Add-On Name</label>
                            </div>
                            <span class="px-2">+ ₱10</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname2').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname2">
                                <label class="form-check-label" for="addonname2">Add-On Name</label>
                            </div>
                            <span class="px-2">+ ₱15</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname3').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname3">
                                <label class="form-check-label" for="addonname3">Add-On Name</label>
                            </div>
                            <span class="px-2">+ ₱20</span>
                        </div>
                    </div>
                    <div class="speins mt-4 mb-5">
                        <div class="mb-3">
                            <h5 class="mb-0">Special Instructions</h5>
                            <span class="mt-2">Special requests are subject to the restaurant's approval. Tell us here!</span>
                        </div>
                        <div class="input-group m-0">
                            <textarea name="specialinstructions" id="specialinstructions" placeholder="e.g. No mayo (Optional)" class="rounded-2"rows="3"></textarea>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3 ordquantity">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-minus" onclick="updateQuantity(-1)"></i>
                <span id="quantity" class="ordquanum">1</span>
                <i class="fa-solid fa-plus" onclick="updateQuantity(1)"></i>
            </div>
            <script>
                function updateQuantity(change) {
                    const quantitySpan = document.getElementById("quantity");
                    let quantity = parseInt(quantitySpan.innerText);
                    quantity = Math.max(1, quantity + change);
                    quantitySpan.innerText = quantity;
                }
            </script>
            <button type="button" class="btn btn-primary w-100">Add to cart</button>
        </div>
    </div>
  </div>
</div>