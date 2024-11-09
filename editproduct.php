<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
?>
<style>
    main{
        padding: 40px 200px
    }
</style>
<div class="prohelp d-flex align-items-center gap-4 justify-content-center">
    <span class="helpspn">HELP</span>
    <p class="m-0">Provide all the necessary information in the fields below to successfully add a new product to your inventory.</p>
    <a href="">Terms and Conditions <i class="fa-solid fa-arrow-right"></i></a>
</div>
<main>
    <form class="productcon">
        <div>
            <label for="productimage" class="mb-2">Product Image</label>
            <div class="productimage text-center py-5 px-3 mb-3" id="productimageContainer" onclick="document.getElementById('productimage').click();">
                <i class="fa-solid fa-arrow-up-long mb-3"></i>
                <input type="file" id="productimage" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayProductImage(event)">
                <p class="small m-0">Select an image to upload. Or drag the image file here.</p>
            </div>
            <p class="text-muted pirem m-0">Recommended size is 160x151. Image must be less than 500kb. Only JPG, JPEG, and PNG formats are allowed. File name can only be in English letters and numbers.</p>
            <script src="assets/js/displayimage.js?v=<?php echo time(); ?>"></script>
        </div>
        
        <div class="flex-grow-1">
            <div class="input-group m-0">
                <label for="productname">Product Name</label>
                <input type="productname" name="productname" id="productname" placeholder="Enter product name"/>            
            </div>
            <div class="d-flex gap-3">
                <div class="input-group">
                    <label for="productcode">Product Code</label>
                    <input type="productcode" name="productcode" id="productcode" placeholder="Enter product code"/>            
                </div>
                <div class="input-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" style="padding: 10.5px 0.75rem">
                        <option value="">Select</option>
                        <option value="category1">Category1</option>
                        <option value="category2">Category2</option>
                    </select>
                </div>
            </div>
            <div class="input-group mt-0">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter product description"></textarea>
            </div>

            <!-- Variation -->
            <div class="input-group m-0">
                <label for="">Variants (Optional)</label>
                <div class="variation-container">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="variation-btn addvar" onclick="addVariationForm()">+ Add Variation</button>
                    </div>
                    <div class="variation-forms-wrapper" id="variation-forms-list"></div>
                </div>
            </div>
            <script src="./assets/js/variation.js?v=<?php echo time(); ?>"></script>

            <!-- Add On -->
            <div class="input-grp">
                <label for="">Add Ons (Optional)</label>
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search for products to add" oninput="filterDropdown()">
                    <div class="dropdown-list" id="dropdown-list"></div>
                </div>
                <div class="addon-list" id="addon-list"></div>
            </div>
            <script src="./assets/js/addon.js?v=<?php echo time(); ?>"></script>

            <div class="d-flex gap-3">
                <div class="input-group m-0">
                    <label for="sellingPrice">Selling Price</label>
                    <input type="number" name="sellingPrice" id="sellingPrice" placeholder="Enter selling price" step="0.01"/>
                </div>
                <div class="input-group m-0">
                    <label for="costPrice">Cost Price</label>
                    <input type="number" name="costPrice" id="costPrice" placeholder="Enter cost price" step="0.01"/>
                </div>
            </div>

            <div class="d-flex gap-3">
                <div class="input-group w-50 mb-3">
                    <label for="discount">Discount (Optional)</label>
                    <input type="number" name="discount" id="discount" placeholder="Enter discount" step="0.01"/>
                </div>
                <div class="d-flex gap-2 w-50">
                    <div class="input-group mb-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" name="startDate" id="startDate"/>
                    </div>
                    <div class="input-group mb-3">
                        <label for="endDate">End Date</label>
                        <input type="date" name="endDate" id="endDate"/>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary send px-5 mt-3">ADD PRODUCT</button><br><br><br><br>
        </div>
    </form>
</main>
<?php
    include_once './footer.php'; 
?>