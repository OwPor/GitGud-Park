<style>
    .btn{
        width: 150px;
    }
    .ip{
        color: #CD5C08;
        font-weight: bold;
    }
    .select2-selection__choice__remove{
    font-size: 20px;
    margin-left: 10px;
    }
    .select2-selection {
    padding: 10px;
    }
    .select2-selection__choice {
    display: flex;
    align-items: center;
    flex-direction: row-reverse;
    background-color: #f8f8f8 !important; 
    border: 1px solid #ccc; 
    padding: 0 10px !important;
    border-radius: 30px !important; 
    margin: 4px !important;
    }

    .select2-selection__choice img,
    .select2-results__option img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin: 0;
    border: 1px solid #ccc; 
    margin-right: 7px;
    }
    .select2-selection__choice img{
    width: 25px;
    height: 25px;
    margin-right: 5px;
    }

    .select2-results__option{
    padding: 7px 15px;
    background-color: white !important;
    color: black !important;
    }
    .select2-results__option--highlighted{
    background-color: #e0e0e0 !important;
    }
    .actlog{
        border-bottom: 1px #ddd solid;
        padding: 10px 0;
    }
     .actlog:last-child {
        border-bottom: none;
        padding-bottom: 0;
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
                    <h5 class="card-title my-2" id="stall-id" data-stall-id="-1">Beef And Mushroom Pizza</h5>
                    <p class="card-text text-muted m-0"></p>
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
                            <div class="form-check d-flex gap-2 align-items-center">
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
            <button type="button" class="btn btn-primary w-100 add-to-cart-btn" 
            data-product-id="-1">Add to cart</button>
        </div>
    </div>
  </div>
</div>
<script src="assets/js/addtocart.js?v=<?php echo time(); ?>"></script>

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

<!-- Delete Stall -->
<div class="modal fade" id="deletestock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete Stock</h4>
            <span>You are about to delete this stock.<br>Are you sure?</span>
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
                <span class="ip">+ ₱12</span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <img src="assets/images/example.jpg" alt="" width="45px" height="45px" class="rounded-2 border">
                    <span >Product Name</span>
                </div>
                <span class="ip">- ₱12</span>
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

<!-- Prepare Order -->
<div class="modal fade" id="prepareorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-utensils me-2"></i> Prepare Order</h4>
            <p class="mb-2">Start preparing this order?</p>
            <span class="text-muted small">Preparing this order means that their payment is confirmed.</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Order Ready -->
<div class="modal fade" id="orderready" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-check me-2"></i> Order Ready</h4>
            <p class="mb-2">Mark this order as ready for pickup?</p>
            <span class="text-muted small">Marking this order will notify the customer about their order.</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Order Complete -->
<div class="modal fade" id="ordercomplete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-check me-2"></i> Order Complete</h4>
            <p class="mb-2">Mark this order as completed?</p>
            <span class="text-muted small">Marking this order means that the order is done.</span>
            <div class="mt-5 mb-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Rent Payment -->
<div class="modal fade" id="addpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4">Add Payment</h4>
                    <div class="input-group m-0 mb-3">
                        <label for="amountpaid">Amount Paid</label>
                        <input type="number" name="amountpaid" id="amountpaid" placeholder="Enter amount paid"/>            
                    </div>
                    <div class="input-group m-0 mb-3">
                        <label for="datepaid">Date Paid</label>
                        <input type="date" name="datepaid" id="datepaid" placeholder="Enter date paid"/>            
                    </div>
                    <div class="d-flex gap-2">
                        <div class="input-group m-0 mb-3">
                            <label for="startDate">Start Date</label>
                            <input type="date" name="startDate" id="startDate"/>
                        </div>
                        <div class="input-group m-0 mb-3">
                            <label for="endDate">End Date</label>
                            <input type="date" name="endDate" id="endDate"/>
                        </div>
                    </div>
                    <div class="input-group m-0 mb-4">
                        <label for="paymentmethod">Payment Method</label>
                        <select name="paymentmethod" id="paymentmethod" style="padding: 10.5px 0.75rem">
                            <option value="" disabled selected>Select</option>
                            <option value="cash">Cash</option>
                            <option value="gcash">GCash</option>
                            <option value="paymaya">PayMaya</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Rent Payment -->
<div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4">Edit Payment</h4>
                    <div class="input-group m-0 mb-3">
                        <label for="amountpaid">Amount Paid</label>
                        <input type="number" name="amountpaid" id="amountpaid" value="1000" placeholder="Enter amount paid" />
                    </div>
                    <div class="input-group m-0 mb-3">
                        <label for="datepaid">Date Paid</label>
                        <input type="date" name="datepaid" id="datepaid" value="2024-11-01" placeholder="Enter date paid" />
                    </div>
                    <div class="d-flex gap-2">
                        <div class="input-group m-0 mb-3">
                            <label for="startDate">Start Date</label>
                            <input type="date" name="startDate" id="startDate" value="2024-10-01" />
                        </div>
                        <div class="input-group m-0 mb-3">
                            <label for="endDate">End Date</label>
                            <input type="date" name="endDate" id="endDate" value="2024-12-31" />
                        </div>
                    </div>
                    <div class="input-group m-0 mb-4">
                        <label for="paymentmethod">Payment Method</label>
                        <select name="paymentmethod" id="paymentmethod" style="padding: 10.5px 0.75rem">
                            <option value="" disabled>Select</option>
                            <option value="cash" selected>Cash</option>
                            <option value="gcash">GCash</option>
                            <option value="paymaya">PayMaya</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 border-0 m-0">
                <h5 class="m-0">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 m-0">
                <form action="#" class="form w-100 border-0 p-0" method="POST">
                    <div class="progressbar">
                        <div class="progress" id="progress"></div>
                        <div class="progress-step progress-step-active" data-title="Name"></div>
                        <div class="progress-step" data-title="Contact"></div>
                        <div class="progress-step" data-title="Other"></div>
                        <div class="progress-step" data-title="Password"></div>
                    </div>

                    <div class="form-step form-step-active">
                        <div class="input-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Enter your first name" />
                        </div>
                        <div class="input-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter your last name" />
                        </div>
                        <div class="btns-group d-block text-center">
                            <input type="button" value="Next" class="button btn-next" />
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="form-group">
                            <label for="phone" class="mb-2">Phone Number</label>
                            <div class="input-group mt-0">
                                <span class="input-group-text">+63</span>
                                <input type="tel" name="phone" id="phone" class="form-control phone-input" placeholder="Enter your phone number" />
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" />
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <a href="#" class="button btn-next">Next</a>
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="input-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" />
                        </div>
                        <div class="input-group">
                            <label for="sex">Sex</label>
                            <select name="sex" id="sex" style="padding: 12px 0.75rem">
                                <option value="" disabled selected>Select your sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <a href="#" class="button btn-next">Next</a>
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" />
                        </div>
                        <div class="input-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" />
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <input type="submit" value="Add User" class="button" />
                        </div>
                    </div>
                </form>
                <script src="assets/js/adduser.js?v=<?php echo time(); ?>"></script>
            </div>
        </div>
    </div>
</div>

<!-- Edit User -->
<div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 border-0 m-0">
                <h5 class="m-0">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 m-0">
                <form action="#" class="form w-100 border-0 p-0" method="POST">
                    <div class="progressbar">
                        <div class="progress" id="progress"></div>
                        <div class="progress-step progress-step-active" data-title="Name"></div>
                        <div class="progress-step" data-title="Contact"></div>
                        <div class="progress-step" data-title="Other"></div>
                        <div class="progress-step" data-title="Password"></div>
                    </div>

                    <div class="form-step form-step-active">
                        <div class="input-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Enter your first name" value="Naila"/>
                        </div>
                        <div class="input-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter your last name" value="Haliluddin"/>
                        </div>
                        <div class="btns-group d-block text-center">
                            <input type="button" value="Next" class="button btn-next" />
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="form-group">
                            <label for="phone" class="mb-2">Phone Number</label>
                            <div class="input-group mt-0">
                                <span class="input-group-text">+63</span>
                                <input type="tel" name="phone" id="phone" class="form-control phone-input" placeholder="Enter your phone number" value="9123456789" />
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" value="example@gmail.com"/>
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <a href="#" class="button btn-next">Next</a>
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="input-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="2024-12-31"/>
                        </div>
                        <div class="input-group">
                            <label for="sex">Sex</label>
                            <select name="sex" id="sex" style="padding: 12px 0.75rem">
                                <option value="" disabled>Select your sex</option>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <a href="#" class="button btn-next">Next</a>
                        </div>
                    </div>

                    <div class="form-step">
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" value="123" />
                        </div>
                        <div class="input-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" value="123"/>
                        </div>
                        <div class="btns-group">
                            <a href="#" class="button btn-prev">Previous</a>
                            <input type="submit" value="Edit User" class="button" />
                        </div>
                    </div>
                </form>
                <script src="assets/js/edituser.js?v=<?php echo time(); ?>"></script>
            </div>
        </div>
    </div>
</div>

<!-- Delete User -->
<div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete User</h4>
                    <span>You are about to delete this user.<br>Are you sure?</span>
                    <div class="mt-5 mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Suspend User -->
<div class="modal fade" id="deactivateuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="modal-title m-0 fw-bold">Select Duration of Deactivation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="3days">
                    <label class="form-check-label" for="3days">3 Days</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="7days">
                    <label class="form-check-label" for="7days">7 Days</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="1month">
                    <label class="form-check-label" for="1month">1 Month</label>
                </div><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="forever">
                    <label class="form-check-label" for="forever">Forever</label>
                </div><br>
                <div class="text-center mt-4">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="button" class="btn btn-primary">Deactivate</button> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Activate User -->
<div class="modal fade" id="activateuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-check"></i> Activate User</h4>
                    <span>You are about to activate this user.<br>Are you sure?</span>
                    <div class="mt-5 mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Activate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- More Park Info -->
<div class="modal fade" id="moreparkinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0">More Info</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="fw-bold mb-3">Branches</h5>
                <div class="mb-4">
                    <span>1/3</span>
                </div>
                <h5 class="fw-bold mb-3">Business Contact</h5>
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Business Email</span>
                        <span>example@gmail.com</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Business Phone Number</span>
                        <span class="text-muted">+639123456789</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Operating Hours</h5>
                <div class="mb-4">
                    <div class="mb-2">
                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                        <span>7AM - 7PM</span>
                    </div>
                    <div class="">
                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                        <span>8AM - 9PM</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Business Permit</h5>
                <div  class="mb-4">
                    <i class="fa-solid fa-circle-check text-success me-2"></i>
                    <a href="#">screenshot.jpg</a>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Edit Food Park Modal -->
 <div class="modal fade" id="editfoodpark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom-width">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-4 align-items-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                </div>
                <button type="submit" class="btn btn-primary send py-2">SAVE</button>
            </div>
            <div class="modal-body modal-scrollable">
                <div class="text-center">
                    <img id="profileImage" src="assets/images/stall1.jpg" width="150px" height="150px" style="border-radius:50%;">
                    <input type="file" id="fileInput" style="display: none;" accept="image/*"><br><br>
                    <button id="uploadButton" class="disatc m-0">Upload Image</button><br><br>
                </div>

                <script>
                    const fileInput = document.getElementById('fileInput');
                    const uploadButton = document.getElementById('uploadButton');
                    const profileImage = document.getElementById('profileImage');

                    uploadButton.addEventListener('click', () => {
                        fileInput.click();
                    });

                    fileInput.addEventListener('change', (event) => {
                        const file = event.target.files[0]; 
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                profileImage.src = e.target.result; 
                            };
                            reader.readAsDataURL(file); 
                        }
                    });
                </script>

                <div class="border-top pt-3">
                    <h5 class="fw-bold mb-1">Tell us about your business</h5>
                    <p class="par mb-3">This information will be shown on the web so that customers can search and contact you in case they have any questions.</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="businessname" name="businessname" placeholder="Food Park Name" value="Food Park Name">
                        <label for="businessname">Business Name <span style="color: #CD5C08;">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email" value="example@gmail.com">
                        <label for="businessemail">Business Email <span style="color: #CD5C08;">*</span></label>
                    </div>
                    <div class="input-group mb-3 mt-0">
                        <span class="input-group-text">+63</span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number" value="9123456789">
                            <label for="businessphonenumber">Business Phone Number <span style="color: #CD5C08;">*</span></label>
                        </div>
                    </div>
                    <div class="operatinghours mb-3">
                        <div class="add-schedule mb-3" style="background-color:#F8F8F8;">
                            <label class="mb-3">What is your business operating hours? <span style="color: #CD5C08;">*</span></label>
                            <div id="timeForm">
                                <div class="oh">
                                    <div class="och mb-3">
                                        <!-- Open Time -->
                                        <label>Open at</label>
                                        <div>
                                            <select name="open_hour" id="open_hour">
                                                <script>
                                                    for (let i = 1; i <= 12; i++) {
                                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                                    }
                                                </script>
                                            </select>
                                            :
                                            <select name="open_minute" id="open_minute">
                                                <script>
                                                    for (let i = 0; i < 60; i++) {
                                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                                    }
                                                </script>
                                            </select>
                                            <select name="open_ampm" id="open_ampm">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="och mb-3">
                                        <!-- Close Time -->
                                        <label>Close at</label>
                                        <div>
                                            <select name="close_hour" id="close_hour">
                                                <script>
                                                    for (let i = 1; i <= 12; i++) {
                                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                                    }
                                                </script>
                                            </select>
                                            :
                                            <select name="close_minute" id="close_minute">
                                                <script>
                                                    for (let i = 0; i < 60; i++) {
                                                        document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                                                    }
                                                </script>
                                            </select>
                                            <select name="close_ampm" id="close_ampm">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                                <!-- Days of the Week -->
                                <div class="day-checkboxes mb-2">
                                    <label><input type="checkbox" name="days" value="Monday"> Monday</label>
                                    <label><input type="checkbox" name="days" value="Tuesday"> Tuesday</label>
                                    <label><input type="checkbox" name="days" value="Wednesday"> Wednesday</label>
                                    <label><input type="checkbox" name="days" value="Thursday"> Thursday</label>
                                    <label><input type="checkbox" name="days" value="Friday"> Friday</label>
                                    <label><input type="checkbox" name="days" value="Saturday"> Saturday</label>
                                    <label><input type="checkbox" name="days" value="Sunday"> Sunday</label>
                                </div>

                                <button type="button" class="add-hours-btn mt-2" onclick="addOperatingHours()">+ Add</button>
                            </div>
                        </div>
                        
                        <div class="schedule-list" style="background-color:#F8F8F8;">
                            <h6>Operating Hours</h6>
                            <div id="scheduleContainer"></div>
                        </div>
                        <script src="assets/js/editoperatinghours.js?v=<?php echo time(); ?>"></script>
                    </div>
                </div>
                
                <div class="border-top pt-3">
                    <h5 class="fw-bold m-0 mb-1">Where is your business located?</h5>
                    <p class="par mb-3">Customers will use this to find your business for directions and pickup options.</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control c" id="rpc" name="rpc" placeholder="Region, Province, City" value="Mindanao, Zamboanga Del Sur, Zamboanga City" readonly>
                        <label for="rpc">Region, Province, City <span style="color: #CD5C08;">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Barangay" value="Barangay Name">
                        <label for="barangay">Barangay <span style="color: #CD5C08;">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sbh" name="sbh" placeholder="Street Name, Building, House No." value="Unit 3, Building 13, AC">
                        <label for="sbh">Street Name, Building, House No. <span style="color: #CD5C08;">*</span></label>
                    </div>
                </div>

                <div class="border-top pt-3">
                    <h5 class="fw-bold m-0 mb-1">Add your business permit</h5>
                    <p class="par mb-3">We need your legal document to verify and approve your business registration.</p>
                    <label for="fplogo">Upload FULL pages of your Business Permit <span style="color: #CD5C08;">*</span></label>
                    <div class="logocon px-3 py-4 mt-3 text-center border">
                        <img src="assets/images/upload-icon.png" class="w-50 h-50 mb-2" alt=""><br>
                        <span>Maximum of 5MB and can accept only JPG, JPEG, PNG or PDF format</span>
                        <input type="file" id="fplogo" accept="image/jpeg, image/png, image/jpg, application/pdf" name="businesspermit" style="display:none;" />
                    </div>
                    <div id="uploaded-files" class="mt-4">
                        <!-- Uploaded files list will appear here -->
                    </div>
                    <script src="assets/js/editpermit.js?v=<?php echo time(); ?>"></script>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- Delete Park -->
<div class="modal fade" id="deletepark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete Food Park</h4>
                    <span>You are about to delete this food park.<br>Are you sure?</span>
                    <div class="mt-5 mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invite Stall Modal -->
<div class="modal fade" id="invitestall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0">
                <div class="d-flex gap-3 align-items-center">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Stall Owners</h1>
                    <i class="fa-regular fa-circle-question m-0" data-bs-toggle="tooltip" data-bs-placement="right" title="An email will be sent to them with an invitaion link to register their stall under your food park. Once they complete the registration, their stall will be added to your food park."></i>
                    <script>
                        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                    </script>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select id="emailInput" name="emails[]" class="form-control select2" multiple="multiple" aria-label="Email input with profile circle">
                    </select>
                </div>
                <script src="assets/js/sendemail.js?v=<?php echo time(); ?>"></script>

                <h6 class=" mb-3 mt-3 mt-1">People in your food park</h6>
                <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/user.jpg" alt="">
                        <div>
                            <span class="fw-bold">Naila Haliluddin (you)</span>
                            <p class="m-0">example@gmail.com</p>
                        </div>
                    </div>
                    <i class="text-muted small mr-1">Park Owner</i>
                </div>
                <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/profile.jpg" alt="">
                        <div>
                            <span class="fw-bold">Naila Haliluddin</span>
                            <p class="m-0">example@gmail.com</p>
                        </div>
                    </div>
                    <i class="text-muted small mr-1">Stall Owner</i>
                </div>
                <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="assets/images/profile.jpg" alt="">
                        <div>
                            <span class="fw-bold">Naila Haliluddin</span>
                            <p class="m-0">example@gmail.com</p>
                        </div>
                    </div>
                    <i class="text-muted small mr-1">Stall Owner</i>
                </div>
            </div>
            <div class="modal-footer pt-0 border-0">
                <button type="button" class="btn btn-primary send p-2" onclick="window.location.href='stallregistration.php';">Create Stall Page</button>
                <button type="button" class="btn btn-primary send p-2">Send Invitation Link</button>
            </div>
        </div>
    </div>
</div>

<!-- Select Food Park -->
 <div class="modal fade" id="selectpark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 75%;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Select which park the stall belong</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-scrollable">
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    <div class="col">
                        <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#invitestall">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                                <i class="fa-solid fa-ellipsis-vertical ellipsis-icon"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Food Park Name</h5>
                                    <p class="card-text text-muted "><i class="fa-solid fa-location-dot"></i> Street Name, Barangay, Zamboanga City</p>
                                    <span class="opennow">Open Now</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#invitestall">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                                <i class="fa-solid fa-ellipsis-vertical ellipsis-icon"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Food Park Name</h5>
                                    <p class="card-text text-muted "><i class="fa-solid fa-location-dot"></i> Street Name, Barangay, Zamboanga City</p>
                                    <span class="opennow">Open Now</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#invitestall">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                                <i class="fa-solid fa-ellipsis-vertical ellipsis-icon"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Food Park Name</h5>
                                    <p class="card-text text-muted "><i class="fa-solid fa-location-dot"></i> Street Name, Barangay, Zamboanga City</p>
                                    <span class="opennow">Open Now</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#invitestall">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                                <i class="fa-solid fa-ellipsis-vertical ellipsis-icon"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Food Park Name</h5>
                                    <p class="card-text text-muted "><i class="fa-solid fa-location-dot"></i> Street Name, Barangay, Zamboanga City</p>
                                    <span class="opennow">Open Now</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<!-- Select Food Stall -->
<div class="modal fade" id="selectstall" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 75%;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Select which stall the item belong</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-scrollable">
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    <div class="col">
                        <a href="addproduct.php" class="card-link text-decoration-none bg-white">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/stall1.jpg" class="card-img-top" alt="...">
                                <button class="add"><i class="fa-regular fa-heart"></i></button>
                                <div class="card-body">
                                    <div class="d-flex gap-2 align-items-center">
                                    <p class="card-text text-muted m-0">Category</p>
                                    <span class="dot text-muted"></span>
                                    <p class="card-text text-muted m-0">Category</p>
                                </div>
                                    <h5 class="card-title my-2">Food Stall Name</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-muted m-0">Description</p>
                                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="discount">With Promo</span>
                                        <span class="newopen">New Open</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="addproduct.php" class="card-link text-decoration-none bg-white">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/stall1.jpg" class="card-img-top" alt="...">
                                <button class="add"><i class="fa-regular fa-heart"></i></button>
                                <div class="card-body">
                                    <div class="d-flex gap-2 align-items-center">
                                    <p class="card-text text-muted m-0">Category</p>
                                    <span class="dot text-muted"></span>
                                    <p class="card-text text-muted m-0">Category</p>
                                </div>
                                    <h5 class="card-title my-2">Food Stall Name</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-muted m-0">Description</p>
                                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="discount">With Promo</span>
                                        <span class="newopen">New Open</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="addproduct.php" class="card-link text-decoration-none bg-white">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/stall1.jpg" class="card-img-top" alt="...">
                                <button class="add"><i class="fa-regular fa-heart"></i></button>
                                <div class="card-body">
                                    <div class="d-flex gap-2 align-items-center">
                                    <p class="card-text text-muted m-0">Category</p>
                                    <span class="dot text-muted"></span>
                                    <p class="card-text text-muted m-0">Category</p>
                                </div>
                                    <h5 class="card-title my-2">Food Stall Name</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-muted m-0">Description</p>
                                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="discount">With Promo</span>
                                        <span class="newopen">New Open</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="addproduct.php" class="card-link text-decoration-none bg-white">
                            <div class="card" style="position: relative;">
                                <img src="assets/images/stall1.jpg" class="card-img-top" alt="...">
                                <button class="add"><i class="fa-regular fa-heart"></i></button>
                                <div class="card-body">
                                    <div class="d-flex gap-2 align-items-center">
                                    <p class="card-text text-muted m-0">Category</p>
                                    <span class="dot text-muted"></span>
                                    <p class="card-text text-muted m-0">Category</p>
                                </div>
                                    <h5 class="card-title my-2">Food Stall Name</h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-muted m-0">Description</p>
                                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="discount">With Promo</span>
                                        <span class="newopen">New Open</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ifcash" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <i class="fa-regular fa-face-smile mb-3" style="color: #CD5C08; font-size: 80px"></i><br>
                    <span>Thank you for your order!</span>
                    <h5 class="fw-bold mt-2 mb-4">Your Order ID is <span style="color: #CD5C08;">0001</span></h5>
                    <p class="mb-3">Please proceed to each stall with this Order ID to complete your payment. Once payment is confirmed, your order will be in preparation queue. </p>
                    <span>For more details about your order, go to Purchase.</span>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="purchaseButton">Purchase</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Placed Order with Online Paymenyt -->
<div class="modal fade" id="ifcashless" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <i class="fa-regular fa-face-smile mb-3" style="color: #CD5C08; font-size: 80px"></i><br>
                    <span>Thank you for your order!</span>
                    <h5 class="fw-bold mt-2 mb-4">Your Order ID is <span style="color: #CD5C08;">0000</span></h5>
                    <p class="mb-3"> Your order at each stall is now in preparation queue, you will be notified when your items are ready for pickup.</p>
                    <span>For more details about your order, go to Purchase.</span>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Purchase</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
    async function fetchPaymentLink() {
        try {
            const response = await fetch('paymongo.php');
            const data = await response.json();

            if (data.checkout_url) {
                document.getElementById('purchaseButton').onclick = function () {
                    window.location.href = data.checkout_url;
                };
            } else {
                console.error('Error fetching payment link:', data.error);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
    window.onload = fetchPaymentLink;
</script>

<!-- Placed Order as scheduled with Online Paymenyt -->
<div class="modal fade" id="ifscheduled" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <i class="fa-solid fa-clock-rotate-left mb-3" style="color: #CD5C08; font-size: 80px"></i><br>
                    <span>Order Scheduled!</span>
                    <h5 class="fw-bold mt-2 mb-4">Your Order ID is <span style="color: #CD5C08;">0000</span></h5>
                    <p class="mb-3">Your order is scheduled for October 15, 2024 at 1:00 PM. You will receive a notification once your order is being prepared at that time.</p>
                    <span>For more details about your order, go to Purchase.</span>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Purchase</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Account Activity Log -->
<div class="modal fade" id="activitylog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom-width">
        <div class="modal-content">
            <div class="p-3 d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Activity Log</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-scrollable pt-0">
                <div>
                <div class="p-3 rounded-2 border mb-3">
                    <h6 class="mb-2">November 30, 2024</h6>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin searched on GitGud</p>
                                <p class="small text-muted m-0">"cheese"</p>
                                <p class="small text-muted m-0">7:43 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin visited on GitGud</p>
                                <p class="small text-muted m-0">"Stall Name"</p>
                                <p class="small text-muted m-0">7:05 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                </div>
                <div class="p-3 rounded-2 border mb-3">
                    <h6 class="mb-2">November 30, 2024</h6>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin searched on GitGud</p>
                                <p class="small text-muted m-0">"cheese"</p>
                                <p class="small text-muted m-0">7:43 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin visited on GitGud</p>
                                <p class="small text-muted m-0">"Stall Name"</p>
                                <p class="small text-muted m-0">7:05 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                </div>
                <div class="p-3 rounded-2 border mb-3">
                    <h6 class="mb-2">November 30, 2024</h6>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin searched on GitGud</p>
                                <p class="small text-muted m-0">"cheese"</p>
                                <p class="small text-muted m-0">7:43 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center actlog">
                        <div class="d-flex gap-3">
                            <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%">
                            <div>
                                <p class="m-0">Naila Haliluddin visited on GitGud</p>
                                <p class="small text-muted m-0">"Stall Name"</p>
                                <p class="small text-muted m-0">7:05 PM</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-trash rename" style="cursor: pointer;"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Payment -->
<div class="modal fade" id="confirmpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-question me-2"></i> Confirm Payment</h4>
                    <p class="mb-2">You are about to confirm the payment for Order ID 0000.<br>Are you sure?</p>
                    <ul class="text-muted small text-start">
                        <li>Please ensure that the total amount of PHP 250.00 has been collected.</li>
                        <li>The order will be in preparation queue once confirmed, please inform the customer.</li>
                    </ul>
                    <div class="mt-5 mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Cashier -->
<div class="modal fade" id="addcashier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 border-0 m-0">
                <h5 class="m-0">Add Cashier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 m-0">
                <form action="#" class="form w-100 border-0 p-0" method="POST">
                    <div class="input-group">
                        <label for="firstname">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter name of cashier" />
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter password" />
                    </div>
                    <div class="input-group">
                        <label for="shiftstart">Shift Start Time</label>
                        <input type="time" name="shiftstart" id="shiftstart">
                    </div>
                    <div class="input-group">
                        <label for="shiftend">Shift End Time</label>
                        <input type="time" name="shiftend" id="shiftend">
                    </div>
                    <input type="submit" value="Add Cashier" class="button" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Cashier -->
<div class="modal fade" id="editcashier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 border-0 m-0">
                <h5 class="m-0">Edit Cashier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 m-0">
                <form action="#" class="form w-100 border-0 p-0" method="POST">
                    <!-- Assuming cashier ID is passed for identification -->
                    <input type="hidden" name="cashier_id" id="cashier_id" value="1"> 
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="John Doe" placeholder="Enter name of cashier" />
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="123456" placeholder="Enter password" />
                    </div>
                    <div class="input-group">
                        <label for="shiftstart">Shift Start Time</label>
                        <input type="time" name="shiftstart" id="shiftstart" value="08:00">
                    </div>
                    <div class="input-group">
                        <label for="shiftend">Shift End Time</label>
                        <input type="time" name="shiftend" id="shiftend" value="16:00">
                    </div>
                    <input type="submit" value="Update Cashier" class="button" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Cashier -->
<div class="modal fade" id="deletecashier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold mb-4"><i class="fa-solid fa-circle-exclamation"></i> Delete Cashier</h4>
                    <span>You are about to delete this Cashier.<br>Are you sure?</span>
                    <div class="mt-5 mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="">
                    <h4 class="fw-bold">Change Password</h4>
                    <p class="small m-0 my-3">Your password must be at least 6 characters and should include a combination of numbers, letters and special characters (!$@%).</p>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="currentpassword" placeholder="Current Password (Updated 10/21/2023">
                        <label for="currentpassword">Current password (Updated 10/21/2023)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="newpassword" placeholder="New Password">
                        <label for="newpassword">New password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="retypepassword" placeholder="Re-type new password">
                        <label for="retypepassword">Re-type new password</label>
                    </div>
                    <a href="resetpassword.php" class="text-decoration-none" style=" color: #CD5C08;">Forgot Password?</a>
                    <div class="form-check mt-3 mb-5">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Log out of other devices. Choose this if someone else used your account.</label>
                    </div>
                    <input type="submit" value="Change Password" class="button" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account -->
<div class="modal fade" id="deleteaccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <h4 class="fw-bold">Delete Account</h4>
                    <p class="m-0 my-3">Deleting your account will remove all of your information from our database. This cannot be undone.</p>

                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="currentpassword" placeholder="Current Password (Updated 10/21/2023">
                        <label for="currentpassword">To confirm this, type "DELETE"</label>
                    </div>
                    <input type="submit" value="Delete Account" class="button" />
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <span>example@gmail.com</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Business Phone Number</span>
                        <span class="text-muted">+639123456789</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Operating Hours</h5>
                <div class="mb-4">
                    <div class="mb-2">
                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                        <span>7AM - 7PM</span>
                    </div>
                    <div class="">
                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                        <span>8AM - 9PM</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Payment Accepted</h5>
                <div class="mb-4">
                    <div class="mb-2">
                        <i class="fa-solid fa-check me-2"></i>
                        <span>Cash</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-check me-2"></i>
                        <span>GCash</span>
                    </div>
                </div>
                <button class="border-0 py-2 px-3 rounded-5 me-2"><i class="fa-regular fa-copy me-2 fs-5"></i>Share Link</button>
                <button class="border-0 py-2 px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#report"><i class="fa-regular fa-flag me-2 fs-5"></i>Report</button>
            </div>
        </div>
    </div>
</div>

<!-- See more food park -->
<div class="modal fade" id="seemorepark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <span>example@gmail.com</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Business Phone Number</span>
                        <span class="text-muted">+639123456789</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Operating Hours</h5>
                <div class="mb-4">
                    <div class="mb-2">
                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                        <span>7AM - 7PM</span>
                    </div>
                    <div class="">
                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                        <span>8AM - 9PM</span>
                    </div>
                </div>
                <button class="border-0 py-2 px-3 rounded-5 me-2"><i class="fa-regular fa-copy me-2 fs-5"></i>Share Link</button>
                <button class="border-0 py-2 px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#report"><i class="fa-regular fa-flag me-2 fs-5"></i>Report</button>
            </div>
        </div>
    </div>
</div>

<!-- Report -->
<div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <h4 class="fw-bold mb-4">Why are you reporting this?</h4>
            <div class="form-floating m-0">
                <textarea class="form-control" placeholder="Reason" id="reason" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                <label for="reason">Reason</label>
            </div>
            <div class="mt-4 mb-3">
                <input type="submit" value="Submit" class="button" />
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
