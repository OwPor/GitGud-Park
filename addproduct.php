<?php
    include_once 'links.php'; 
    include_once 'header.php';
    require_once __DIR__ . '/classes/db.class.php';
    require_once __DIR__ . '/classes/stall.class.php';
    $userObj = new User();
    $stallObj = new Stall();
    $code = $name = $category = $description = $price = $image = $stall_id = '';
    $codeErr = $nameErr = $categoryErr = $priceErr = $imageErr = $stall_idErr = '';

    if (isset($_SESSION['user']['id'])) {
        if ($userObj->isVerified($_SESSION['user']['id']) == 1) {
            $stall_id = $stallObj->getStallId($_SESSION['user']['id']);
        } else {
            header('Location: email/verify_email.php');
            exit();
        }
    } else {
        header('Location: login.php');
        exit();
    }



    require_once __DIR__ . '/classes/product.class.php';
    $productObj = new Product();

    $selectCategories = $productObj->getCategories();
    
    $uploadDir = 'uploads/images/';
    $allowedType = ['jpg', 'jpeg', 'png'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['product_image'])) {
            $name = filter_var($_POST['productname'], FILTER_SANITIZE_STRING);
            $code = filter_var($_POST['productcode'], FILTER_SANITIZE_STRING);
            $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $price = filter_var($_POST['sellingPrice'], FILTER_SANITIZE_STRING);
            $image = $_FILES['product_image']['name'] ?? '';
            $imageTemp = $_FILES['product_image']['tmp_name'] ?? '';


            // $discount = filter_var($_POST['discount'], FILTER_SANITIZE_STRING);
            // $startDate = filter_var($_POST['startDate'], FILTER_SANITIZE_STRING);
            // $endDate = filter_var($_POST['endDate'], FILTER_SANITIZE_STRING);

            if (empty($name)) {
                $nameErr = 'Product name is required.';
            } else if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
                $nameErr = 'Only letters, numbers, and white spaces are allowed.';
            }

            if (empty($code)) {
                $codeErr = 'Product code is required.';
            } else if (!preg_match("/^[a-zA-Z0-9 ]*$/", $code)) {
                $codeErr = 'Only letters, numbers, and white spaces are allowed.';
            }

            if (empty($category)) {
                $categoryErr = 'Category is required.';
            }

            if (empty($price)) {
                $priceErr = 'Selling price is required.';
            } else if (!is_numeric($price)) {
                $priceErr = 'Only numbers are allowed.';
            } else if ($price <= 0) {
                $priceErr = 'Price must be greater than 0.';
            }

            $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (empty($image)) {
                $imageErr = 'Product image is required.';
            } else if (!in_array($imageFileType, $allowedType)) {
                $imageErr = 'Accepted files are jpg, jpeg, and png only.';
            } else if ($_FILES['product_image']['size'] > 5000000) {
                $imageErr = "Only files under 5MB are allowed.";
            }
        } else {
            $imageErr = 'Product image is required.';
        }

        if (!empty($imageErr)) {
            echo json_encode([
                'imageErr' => $imageErr
            ]);
            exit;
        }

        if(empty($codeErr) && empty($nameErr) && empty($categoryErr) && empty($priceErr) && empty($imageErr) && empty($stall_idErr) ) {
            $targetImage = $uploadDir . uniqid() . basename($image);
            if($productObj->addProduct($name, $code, $description, $price, $category, $stall_id, $targetImage)){
                move_uploaded_file($imageTemp, $targetImage);
                header('Location: index.php');
                exit();
            }
            exit;
        }
    }
?>
<style>
    main{
        padding: 40px 200px
    }
    .getcg td{
        padding: 20px;
        border-bottom: 1px solid #ddd;
        line-height: 1.5;
    }
    .getcg .st{
        vertical-align: top;
    }
    .addchogro{
        text-decoration: none;
        color: #CD5C08;
        margin-top: 10px;
    }
    .addchogro:hover{
        color: black;
    }
    
</style>
<div class="prohelp d-flex align-items-center gap-4 justify-content-center">
    <span class="helpspn">HELP</span>
    <p class="m-0">Provide all the necessary information in the fields below to successfully add a new product to your inventory.</p>
    <a href="">Terms and Conditions <i class="fa-solid fa-arrow-right"></i></a>
</div>
<main>
    <form class="productcon" method="POST" enctype="multipart/form-data">
        <div>
            <label for="productimage" class="mb-2">Product Image</label>
            <div class="productimage text-center py-5 px-3 mb-3" id="productimageContainer" onclick="document.getElementById('product_image').click();">
                <div id="product_image_div">
                    <i class="fa-solid fa-arrow-up-long mb-3"></i>
                    <p class="small m-0">Select an image to upload. Or drag the image file here.</p>
                </div>
                <input type="file" name="product_image" id="product_image" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayProductImage(event)">
            </div>
            <p class="text-muted pirem m-0">Recommended size is 160x151. Image must be less than 500kb. Only JPG, JPEG, and PNG formats are allowed. File name can only be in English letters and numbers.</p>
            <script src="assets/js/displayimage.js?v=<?php echo time(); ?>"></script>
        </div>

        <div class="flex-grow-1">
            <div class="input-group m-0 mb-4">
                <label for="productname">Product Name</label>
                <input type="productname" name="productname" id="productname" placeholder="Enter product name"/>            
            </div>
            <div class="d-flex gap-3">
                <div class="input-group m-0 mb-4">
                    <label for="productcode">Product Code</label>
                    <input type="productcode" name="productcode" id="productcode" placeholder="Enter product code"/>            
                </div>
                <div class="input-group m-0 mb-4">
                    <label for="category">Category</label>
                    <select name="category" id="category" style="padding: 10.5px 0.75rem">
                        <option value="" disabled selected>Select</option>
                        <?php
                            foreach($selectCategories as $category){
                                echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="input-group m-0 mb-4">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter product description"></textarea>
            </div>
            
            <div class="d-flex gap-3">
                <div class="input-group m-0 mb-4">
                    <label for="sellingPrice">Selling Price</label>
                    <input type="number" name="sellingPrice" id="sellingPrice" placeholder="Enter selling price" step="0.01" min="0" />
                </div>
            </div>

            <!-- Variation -->
            <div class="input-group m-0 mb-4">
                <label for="">Variants (Optional)</label>
                <div class="variation-container">
                    <div class="d-flex justify-content-end pe-3">
                        <button type="button" class="variation-btn addvar" onclick="addVariationForm()">+ Add Variation</button>
                    </div>
                    <div class="variation-forms-wrapper" id="variation-forms-list"></div>
                </div>
            </div>
            <script src="./assets/js/variation.js?v=<?php echo time(); ?>"></script>

            <!-- Choice Group -->
            <!-- <div class="input-group m-0 mb-5">
                <label for="choicegroup">Choice Groups (Optional)</label>
                <table class="border bg-white w-100 getcg">
                    <tr>
                        <td class="pe-0"><input type="checkbox"></td>
                        <td class="st text-nowrap">
                            <p class="mb-1">Choice of First Pizza</p>
                            <span class="cg">Required (Single), 6 Choices</span>
                        </td>
                        <td class="st ">Pepperoni, Margarita, Hawaiian, Vegetarian Special, Meat Special, Tomatoes</td>
                        <td><i class="fa-solid fa-pen rename" onclick="window.location.href='editchoicegroup.php';"></i></td>
                    </tr>
                    <tr>
                        <td class="pe-0"><input type="checkbox"></td>
                        <td class="st text-nowrap">
                            <p class="mb-1">Choice of Drink</p>
                            <span class="cg">Optional (Multiple), 3 Choices</span>
                        </td>
                        <td class="st ">Coca Cola, Bottled Water, Green Tee</td>
                        <td><i class="fa-solid fa-pen rename" onclick="window.location.href='editchoicegroup.php';"></i></td>
                    </tr>
                </table>
                <a href="createchoicegroup.php" class="addchogro">+ Add Choice Group</a>
            </div> -->

            <div class="d-flex gap-3">
                <div class="input-group w-50 m-0 mb-4">
                    <label for="discount">Discount (Optional)</label>
                    <input type="number" name="discount" id="discount" placeholder="Enter discount" step="0.01"/>
                </div>
                <div class="d-flex gap-2 w-50">
                    <div class="input-group m-0 mb-4">
                        <label for="startDate">Start Date</label>
                        <input type="date" name="startDate" id="startDate"/>
                    </div>
                    <div class="input-group m-0 mb-4">
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