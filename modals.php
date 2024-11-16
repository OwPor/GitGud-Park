<style>
    .btn{
        width: 150px;
    }
    .ip{
        color: #CD5C08;
        font-weight: bold;
    }
</style>
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
                    <!-- If required, can be variation or choice group -->
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
                            <span class="px-2">Free</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between variationitem" onclick="document.getElementById('variationname3').click()">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variationname" id="variationname3">
                                <label class="form-check-label" for="variationname3">Variation Name</label>
                            </div>
                            <span class="px-2">Free</span>
                        </div>
                    </div>
                    <div class="addons mt-3">
                        <div class="d-flex align-items-center justify-content-between addon mb-2">
                            <h5 class="mb-0">Add-Ons</h5>
                            <span class="mx-2">Optional</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname1').click()">
                            <div class="form-check d-flex gap-2 align-items-center">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname1">
                                <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2">
                                <label class="form-check-label" for="addonname1">Add-On Name</label>
                            </div>
                            <span class="px-2">+ ₱10</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname2').click()">
                            <div class="form-check d-flex gap-2 align-items-center">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname2">
                                <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2">
                                <label class="form-check-label" for="addonname2">Add-On Name</label>
                            </div>
                            <span class="px-2">+ ₱15</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between addonitem" onclick="document.getElementById('addonname3').click()">
                            <div class="form-check d-flex gap-2 align-items-center"">
                                <input class="form-check-input" type="checkbox" name="addonname" id="addonname3">
                                <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2">
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

<!-- Delete Stall -->
<div class="modal fade" id="deletestall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete Stall</h4>
            <span>You are about to delete this stall.<br>Are you sure?</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Product -->
<div class="modal fade" id="deleteproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete Product</h4>
            <span>You are about to delete this product.<br>Are you sure?</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Category -->
<div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4">Add Category</h4>
            <div class="form-floating m-0">
                <input type="text" class="form-control" id="category" placeholder="Category">
                <label for="category">Category</label>
            </div>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Category -->
<div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4">Edit Category</h4>
            <div class="form-floating m-0">
                <input type="text" class="form-control" id="category" placeholder="Category" value="Category 1">
                <label for="category">Category</label>
            </div>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Product Info -->
<div class="modal fade" id="moreinfoproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content h-75 overflow-auto">
      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0">Product Name</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="p-3 rounded-2 border invvar">
            <div class="mb-2">
                <h5 class="fw-bold mb-1">Choose your Drink</h5>
                <span class="small text-muted">Customer is required to select one option</span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2 border">
                    <span>Coke Regular</span>
                </div>
                <span class="ip">Free</span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2 border">
                    <span >Product Name</span>
                </div>
                <span class="ip">₱12</span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2 border">
                    <span >Product Name</span>
                </div>
                <span class="ip">₱12</span>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Order -->
<div class="modal fade" id="cancelorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="modal-title m-0 fw-bold">Select Cancellation Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="reminder p-3 my-3"><i class="fa-solid fa-circle-exclamation me-1"></i> Please take note that this will cancel all items in the order and the action cannot be undone.</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">Need to modify order</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">Payment procedure too troublesome</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault3">Found cheaper elsewhere</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault4">Don't want to buy anymore</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault5">Others</label>
                </div>
                <div class="text-center mt-4">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="button" class="btn btn-primary">Cancel Order</button> <!-- if clicked, go to #cancelled -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Received -->
<div class="modal fade" id="orderreceived" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-check"></i> Received Order</h4>
            <span>Mark this order as received?</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>