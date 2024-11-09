<!-- Menu Modal -->
 <style>
    .variation span, .addon span{
        padding: 3px 8px;
        border-radius: 40px;
        color: white;
        background-color: #CD5C08;
        font-size: 11px;
    }
    .addon span{
        background-color: gray;
    }
    .variation, .addon {
        padding: 7px;
    }
    .variationitem, .addonitem {
        padding: 7px;
        cursor: pointer;
    }

    .variationitem:hover {
        background-color: #FFD9D2;
        border-radius: 5px;
    }
    .addonitem:hover{
        background-color: #e5e5e5;
        border-radius: 5px;
    }

    .variationitem:hover .form-check-input {
        border-width: 2px;
        border-color: #CD5C08;
    }
    .vrtn, .addons{
        background-color: #FFF5E4;
        border: 1px #ccc solid;
        border-radius: 5px;
        padding: 12px 7px;
    }
    .addons{
        background-color: #f4f4f4;
    }
    #menumodal .modal-dialog {
        max-width: 40%; 
    }
    #menumodal .modal-content {
        height: 600px; 
        overflow: auto; 
    }
    .btn-close{
        background-color: white;
        opacity: 1;
        border-radius: 50%;
        padding: 10px;
        border: 1px #ccc solid;
    }
    .btn-close:focus {
        outline: none;
        box-shadow: none; 
    }
    .btn-close:hover {
        background-color: #e5e5e5;
        opacity: 1;
    }
    .custom-img {
        height: 300px; /* Adjust the height as needed */
        object-fit: cover; /* Ensures the image fills the container without distortion */
    }
 </style>
<div class="modal fade" id="menumodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card border-0 position-relative rounded-0">
            <img src="assets/images/example.jpg" class="card-img-top custom-img" alt="...">
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

            </div>
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>