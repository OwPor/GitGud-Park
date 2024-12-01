<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'bootstrap.php';  

    $businessName = "Sample Business"; // Example value
    $businessEmail = "samplebusiness@example.com"; // Example value
    $businessPhoneNumber = "9123456789"; // Example value
    $website = "https://www.samplebusiness.com"; // Example value
    $description = "This is a sample business description."; // Example value
    $selectedCategories = ['Category1', 'Category3']; // Replace with dynamic values
    $existingImage = 'assets/images/foodpark.jpg';
    $selectedPaymentMethods = ['Cash', 'G-Cash'];
?>
<link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
<style>
     main {
        padding: 20px 120px;
    }
    .form-floating input, .form-floating textarea, .form-floating label::after, .logo, .add-schedule, .schedule-list{
        background-color: #F8F8F8 !important;
    }
</style>
<main>
    <div class="d-flex justify-content-end">
        <button class="addpro mb-3 prev" onclick="window.location.href='stallpage.php';"><i class="fa-solid fa-chevron-left me-2"></i> Previous</button>
    </div>
    <form action="" class="srform rounded-2 bg-white p-5">
        <div class="pagehead mb-4 border-bottom">
            <div>
                <h4 class="fw-bold m-0">Edit Business Page</h4>
                <span></span>
            </div>
            <p class="par mt-2">Update your page to ensure it has the latest and most accurate information about your business. This will help people find and connect with your business more effectively.</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="logo px-4 py-5 text-center border flex-shrink-0" 
                id="logoContainer" 
                style="background-image: url('<?php echo $existingImage; ?>'); background-size: cover; background-position: center;"
                onclick="document.getElementById('stalllogo').click();">
                <?php if (empty($existingImage)): ?>
                    <i class="fa-solid fa-arrow-up-from-bracket fs-3 p-2 mb-1"></i><br>
                    <label for="stalllogo" class="fw-bold m-0 fs-6">Add Business Logo</label><br>
                    <p class="small mb-2">or drag and drop</p>
                    <span class="text-muted logorem">Image size must be less than 5MB. Only JPG, JPEG, and PNG formats are allowed.</span>
                <?php endif; ?>
                <input type="file" id="stalllogo" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayImage(event)">
            </div>
            <script src="assets/js/displayimage.js"></script>
            
            <div class="flex-grow-1 ms-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" style="color: black;" id="businessname" name="businessname" placeholder="Business Name" value="<?php echo $businessName; ?>">
                    <label for="businessname">Business Name <span style="color: #CD5C08;">*</span></label>
                </div>

                <div class="form-group m-0 select2Part select2multiple w-100 floating-group">
                    <label class="floating-label">Categories <span style="color: #CD5C08;">*</span></label>
                    <select name="categories[]" id="categories" class="form-control customSelectMultiple floating-control" multiple>
                        <?php
                        // Array of all categories
                        $allCategories = ['Category1', 'Category2', 'Category3', 'Category4', 'Category5'];

                        // Loop through categories and mark the selected ones
                        foreach ($allCategories as $category) {
                            $isSelected = in_array($category, $selectedCategories) ? 'selected' : '';
                            echo "<option value=\"$category\" $isSelected>$category</option>";
                        }
                        ?>
                    </select>
                </div>
                <script src="assets/js/selectcategory.js?v=<?php echo time(); ?>"></script>
                
                <div class="form-floating mt-3">
                    <textarea class="form-control" style="color: black;" placeholder="Description" id="description"><?php echo $description; ?></textarea>
                    <label for="description">Description <span style="color: #CD5C08;">*</span></label>
                </div>
            </div>
        </div>

        <div class="contact mt-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email" value="<?php echo $businessEmail; ?>">
                <label for="businessemail">Business Email <span style="color: #CD5C08;">*</span></label>
            </div>
            <div class="input-group mb-3 mt-0">
                <span class="input-group-text">+63</span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number" value="<?php echo $businessPhoneNumber; ?>">
                    <label for="businessphonenumber">Business Phone Number <span style="color: #CD5C08;">*</span></label>
                </div>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="<?php echo $website; ?>">
                <label for="website">Website</label>
            </div>
        </div>

        <div class="operatinghours">
            <div class="add-schedule mb-4">
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
            
            <div class="schedule-list">
                <h6>Operating Hours</h6>
                <div id="scheduleContainer"></div>
            </div>
            <script src="assets/js/editoperatinghours.js?v=<?php echo time(); ?>"></script>
        </div>
        
        <div class="paymentmethod mt-4">
            <div class="add-schedule">
                <label for="" class="mb-3">What payment methods does your business accept? <span style="color: #CD5C08;">*</span></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Cash" id="flexCheckCash" <?php echo in_array('Cash', $selectedPaymentMethods) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="flexCheckCash">Cash</label>
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="G-Cash" id="flexCheckGcash" <?php echo in_array('G-Cash', $selectedPaymentMethods) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="flexCheckGcash">G-Cash</label>
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="PayMaya" id="flexCheckPaymaya" <?php echo in_array('PayMaya', $selectedPaymentMethods) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="flexCheckPaymaya">PayMaya</label>
                </div>
            </div>
        </div>

        <div class="text-center pt-4 mt-4 createpage">
            <button type="submit" class="btn btn-primary send px-5">SAVE EDIT</button>
        </div>
    </form>
    <br><br><br><br>
</main>

<?php
    include_once 'footer.php'; 
?>