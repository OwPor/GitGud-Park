<?php
    session_start();

    include_once 'links.php'; 
    include_once 'bootstrap.php'; 
    include_once 'secondheader.php';

    require_once './classes/db.class.php';
    require_once './classes/park.class.php';

    $userObj = new User();
    $parkObj = new Park();

    $stalllogo = $businessname = $description = $businessemail = $businessphonenumber = $website = '';
    $errors = [];

    if (isset($_GET['owner_email']) && isset($_GET['owner_id']) && isset($_GET['park_id'])) {
        $owner_email = $_GET['owner_email'];
        $owner_id = $_GET['owner_id'];
        $park_id = $_GET['park_id'];

        $user = $userObj->getUser($owner_id);
    } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $businessname = trim($_POST['businessname']);
        $description = trim($_POST['description']);
        $businessemail = trim($_POST['businessemail']);
        $businessphonenumber = trim($_POST['businessphonenumber']);
        $website = trim($_POST['website']);
        
        $categories = $_POST['categories'] ?? [];
        $payment_methods = $_POST['payment_methods'] ?? [];
        $operatingHoursJson = $_POST['operating_hours'] ?? '';
    
        if (empty($businessname)) {
            $errors[] = "Business name is required.";
        }
    
        if (empty($categories)) {
            $errors[] = "At least one category must be selected.";
        }
    
        if (empty($description)) {
            $errors[] = "Business description is required.";
        }
    
        if (!filter_var($businessemail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Enter a valid business email.";
        }
    
        if (!preg_match('/^[0-9]{10}$/', $businessphonenumber)) {
            $errors[] = "Enter a valid 10-digit Philippine phone number.";
        }
    
        if (isset($_FILES['stalllogo']) && $_FILES['stalllogo']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['stalllogo'];
            $fileSize = $file['size'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
            if ($fileSize > 5 * 1024 * 1024) {
                $errors[] = "Business logo must be less than 5MB.";
            }
    
            if (!in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                $errors[] = "Invalid file format. Only JPG, JPEG, and PNG allowed.";
            }
        } else {
            $errors[] = "Business logo is required.";
        }
    
        if (empty($payment_methods)) {
            $errors[] = "At least one payment method must be selected.";
        }
    
        if (empty($operatingHoursJson)) {
            $errors[] = "Operating hours are required.";
        }
    
        if (!isset($_POST['agreement'])) {
            $errors[] = "You must agree to the terms before proceeding.";
        }
    
        if (empty($errors)) {
            $stalllogo = ''; 
    
            if (isset($_FILES['stalllogo']) && $_FILES['stalllogo']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/business/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
                $uniqueFileName = uniqid('stall_', true) . '.' . $fileExtension;
                $uploadPath = $uploadDir . $uniqueFileName;
    
                if (move_uploaded_file($_FILES['stalllogo']['tmp_name'], $uploadPath)) {
                    $stalllogo = $uploadPath;
                }
            }
    
            $operatingHours = json_decode($operatingHoursJson, true);
    
            $stall = $parkObj->addStall($owner_id, $park_id, $businessname, $description, $businessemail, $businessphonenumber, $website, $stalllogo, $operatingHours, $categories, $payment_methods);
    
        }
    }
    
?>
<link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
<style>
    main {
        display: flex;
        height: calc(100vh - 65.61px); 
        overflow: hidden;
        background-color: white;
    }
    .fixed-image {
        width: 35%;
    }
    .srform {
        width: 65%;
        overflow-y: auto; 
        border: none;
        padding: 20px 80px;
    }
    .form-floating input, .form-floating textarea, .form-floating label::after, .logo, .add-schedule, .schedule-list{
        background-color: #F8F8F8 !important;
    }
</style>
<main>
    <img src="assets/images/rightbg.jpg" class="fixed-image">
    <form action="" class="srform" method="POST" enctype="multipart/form-data">
        <div class="d-flex gap-3 align-items-center">
            <div class="logo px-4 py-5 text-center border flex-shrink-0" id="logoContainer" onclick="document.getElementById('stalllogo').click();" 
                style="background-size: cover; background-position: center;">
                <i class="fa-solid fa-arrow-up-from-bracket fs-3 p-2 mb-1"></i><br>
                <label for="stalllogo" class="fw-bold m-0 fs-6">Add Business Logo</label><br>
                <input type="file" id="stalllogo" name="stalllogo" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayImage(event)">
                <p class="small mb-2">or drag and drop</p>
                <span class="text-muted logorem">Image size must be less than 5MB. Only JPG, JPEG, and PNG formats are allowed.</span>
            </div>
            <script>
                function displayImage(event) {
                    const file = event.target.files[0];
                    if (file && file.size <= 5 * 1024 * 1024) { // Check file size
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const logoContainer = document.getElementById('logoContainer');
                            logoContainer.style.backgroundImage = `url('${e.target.result}')`;
                            logoContainer.innerHTML = ''; // Remove icon and text
                            logoContainer.appendChild(event.target); // Re-append the input field
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert('File is too large or not supported. Please select a JPG, JPEG, or PNG image under 5MB.');
                    }
                }
            </script>
        </div>

        <div class="contact mt-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email" value="<?php echo htmlspecialchars($businessemail); ?>">
                <label for="businessemail">Business Email</label>
            </div>
            <div class="input-group mb-3 mt-0">
                <span class="input-group-text">+63</span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number" value="<?php echo htmlspecialchars($businessphonenumber); ?>">
                    <label for="businessphonenumber">Business Phone Number</label>
                </div>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="<?php echo htmlspecialchars($website); ?>">
                <label for="website">Website</label>
            </div>
        </div>

        <div class="paymentmethod mt-4">
            <div class="add-schedule">
                <label for="" class="mb-3">What payment methods does your business accept? <span style="color: #CD5C08;">*</span></label>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="payment_methods[]" value="Cash" id="flexCheckCash">
                    <label class="form-check-label" for="flexCheckCash">Cash</label>
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="payment_methods[]" value="GCash" id="flexCheckGcash">
                    <label class="form-check-label" for="flexCheckGcash">GCash</label>
                </div>
            </div>
        </div>


        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" id="agreement" name="agreement" value="1">
            <label class="form-check-label" for="agreement">
                By clicking this box, I confirm that I am authorised by the Vendor to accept this Registration Form and the following <a href="">Terms and Conditions.</a>
            </label>
        </div>
        <div class="text-center pt-4 mt-4 createpage">
            <button type="submit" class="btn btn-primary send px-5">CREATE PAGE</button>
        </div>
    </form>
</main>
<!-- Bootstrap Modal for Errors -->
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Form Errors</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul id="errorList" class="text-danger"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Frontend Script to Trigger Error Modal -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const errors = <?php echo json_encode($errors); ?>;
    if (errors.length > 0) {
        let errorList = document.getElementById("errorList");
        errors.forEach(error => {
            let li = document.createElement("li");
            li.textContent = error;
            errorList.appendChild(li);
        });
        new bootstrap.Modal(document.getElementById('errorModal')).show();
    }
});
</script>