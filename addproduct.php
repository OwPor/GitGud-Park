<?php
    include_once 'links.php'; 
    include_once 'secondheader.php'; 
?>
<style>
    .productimage{
        width: 210px;
        height: 210px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        cursor: pointer;
        background-color: #e8e8e8;
    }
    .productimage i{
        background-color: #bbbbbb;
        border-radius: 50%;
        padding: 10px 12px;
        color: white;
    }
    .productimage:hover{
        border: 1px solid black !important;
    }
    .pirem{
        font-size: small;
        width: 210px;
    }
    .productcon{
        display: flex;
        gap: 80px;
    }

    /* variation */

    .variation-container {
        background-color: white;
        padding: 12px 0.75rem;
    }
    .variation-header, .variation-row{
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
    }
    .variation-form {
        padding-left: 7px;
        padding-bottom: 20px;
    }
    .variation-btn {all: unset;}
    .variation-btn.rename:hover, .variation-btn.delete:hover, .variation-btn.addrem:hover,
    .remove-btn:hover, .edit-btn:hover{
        background-color: #e5e5e5;
        border-radius: 50px;
    }
    .variation-btn.addvar:hover{
        
    }
    .variation-btn.addvar{
        color: #CD5C08;
    }
    .variation-btn-group{
        display: flex;
        gap: 5px;
        font-size: 14px;
        margin-top: 15px;
    }
    .variation-btn.addrem{
        border-radius: 50px;
        padding: 6px 12px;
        background-color: #f2f2f2;
    }
    .variation-btn.delete{
        font-size: large;
        padding: 5px 7px;
        color: gray;
    }
    .variation-btn.rename {
        font-size: small;
        padding: 8px;
        color: gray;
    }



     /* Add On */

    .search-bar {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        z-index: 10;
        display: none;
    }
    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0.75rem;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }
    .dropdown-item:last-child {
        border-bottom: none;
    }
    .dropdown-item:hover {
        background-color: #f0f0f0;
    }
    .product-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .product-image {
        width: 40px;
        height: 40px;
        border-radius: 3px;
        object-fit: cover;
    }
    .addon-list {
        margin-top: 10px;
        background-color: white;
    }
    .rempro{
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .addon-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 8px;
    }

    .addon-item input {
        width: 70px;
        padding: 5px;
        border: none;
        background-color: white;
    }
    .edit-btn, .remove-btn{all: unset;}
    .remove-btn{
        padding: 5px 7px;
        font-size: large;
    }
    .edit-btn {
        font-size: small;
        padding: 8px;
        color: gray;
    }
  
</style>
<main>
    <div class="productcon">
        <div>
            <label for="productimage" class="mb-2">Product Image</label>
            <div class="productimage text-center py-5 px-3 mb-3" id="productimageContainer" onclick="document.getElementById('productimage').click();">
                <i class="fa-solid fa-arrow-up-long mb-3"></i>
                <input type="file" id="productimage" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayImage(event)">
                <p class="small m-0">Select an image to upload. Or drag the image file here.</p>
            </div>
            <p class="text-muted pirem m-0">Recommended size is 160x151. Image must be less than 500kb. Only JPG, JPEG, and PNG formats are allowed. File name can only be in English letters and numbers.</p>
            <script src="assets/js/displayimage.js"></script>
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
                <label for="">Variants</label>
                <div class="variation-container">
                    <div class="d-flex justify-content-end">
                        <button class="variation-btn addvar" onclick="addVariationForm()">+ Add Variation</button>
                    </div>
                    <div class="variation-forms-wrapper" id="variation-forms-list"></div>
                </div>
            </div>
            <script src="./assets/js/variation.js?v=<?php echo time(); ?>"></script>

            <!-- Add On -->
            <div class="input-group mt-0">
                <label for="">Add Ons</label>
            </div>

            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search for products..." oninput="filterDropdown()">
                <div class="dropdown-list" id="dropdown-list"></div>
            </div>
            <div class="addon-list" id="addon-list"></div>
            <script src="./assets/js/addon.js?v=<?php echo time(); ?>"></script>

        </div>
    </div>
</main>
<?php
    include_once './footer.php'; 
?>