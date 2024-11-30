<?php
    include_once 'links.php'; 
    include_once 'bootstrap.php'; 
    include_once 'secondheader.php';
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
    <form action="" class="srform">
        <div class="mb-4 border-bottom">
            <div class="d-flex gap-3 align-items-center">
                <h4 class="fw-bold m-0">Create a business page</h4>
                <i class="fa-regular fa-circle-question" data-bs-toggle="tooltip" data-bs-placement="right" title="Your food stall will be registered under the food park that sent you this invitation link. Ensure that the invitation is from the correct food park, as this will determine where your stall is listed and managed." style="color: #CD5C08;"></i>
                <script>
                    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                </script>
            </div>
            <p class="par mt-2">
                Your page is where people go to learn more about your business. Make sure yours has all the information they may need.
            </p>
        </div>
        <div class="d-flex justify-content-between align-items-center border rounded-2 py-2 px-3 mb-4" style="background-color: #F8F8F8;">
            <div class="d-flex gap-4 align-items-center">
                <img src="assets/images/profile.jpg" width="65" height="65" style="border-radius: 50%;">
                <div>
                    <h4 class="fw-bold mb-1">Naila Haliluddin</h4>
                    <div class="d-flex gap-2 text-muted align-items-center">
                        <span><i class="fa-solid fa-envelope"></i> example@gmail.com</span>
                        <span class="dot"></span>
                        <span><i class="fa-solid fa-phone small"></i> +639554638281</span>
                    </div>
                </div>
            </div>
            <i class="text-muted">Stall Owner</i>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="logo px-4 py-5 text-center border flex-shrink-0" id="logoContainer" onclick="document.getElementById('stalllogo').click();">
                <i class="fa-solid fa-arrow-up-from-bracket fs-3 p-2 mb-1"></i><br>
                <label for="stalllogo" class="fw-bold m-0 fs-6">Add Business Logo</label><br>
                <input type="file" id="stalllogo" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displayImage(event)">
                <p class="small mb-2">or drag and drop</p>
                <span class="text-muted logorem">Image size must be less than 5MB. Only JPG, JPEG, and PNG formats are allowed.</span>
            </div>
            <script src="assets/js/displayimage.js"></script>
            
            <div class="flex-grow-1 ms-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" style="color: black;" id="businessname" name="businessname" placeholder="Business Name">
                    <label for="businessname">Business Name <span style="color: #CD5C08;">*</span></label>
                </div>

                <div class="form-group m-0 select2Part select2multiple w-100 floating-group">
                    <label class="floating-label">Categories <span style="color: #CD5C08;">*</span></label>
                    <select name="categories" id="categories" class="form-control customSelectMultiple floating-control" multiple>
                        <option value="Category">Category</option>
                        <option value="Category">Category</option>
                        <option value="Category">Category</option>
                        <option value="Category">Category</option>
                        <option value="Category">Category</option>
                        <option value="Category">Category</option>
                    </select>
                </div>
                <script src="assets/js/selectcategory.js"></script>
                
                <div class="form-floating mt-3">
                    <textarea class="form-control" style="color: black;" placeholder="Description" id="description"></textarea>
                    <label for="description">Description <span style="color: #CD5C08;">*</span></label>
                </div>
            </div>
        </div>

        <div class="contact mt-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email">
                <label for="businessemail">Business Email</label>
            </div>
            <div class="input-group mb-3 mt-0">
                <span class="input-group-text">+63</span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number">
                    <label for="businessphonenumber">Business Phone Number</label>
                </div>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
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
            <script src="assets/js/display.js?v=<?php echo time(); ?>"></script>
        </div>
        
        <div class="paymentmethod mt-4">
            <div class="add-schedule">
                <label for="" class="mb-3">What payment methods does your business accept? <span style="color: #CD5C08;">*</span></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Cash" id="flexCheckCash">
                    <label class="form-check-label" for="flexCheckCash">Cash</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="G-Cash" id="flexCheckGcash">
                    <label class="form-check-label" for="flexCheckGcash">G-Cash</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="PayMaya" id="flexCheckPaymaya">
                    <label class="form-check-label" for="flexCheckPaymaya">PayMaya</label>
                </div>
            </div>
        </div>
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                By clicking this box, I confirm that I am authorised by the Vendor to accept this Registration Form and the following <a href="">Terms and Conditions.</a>
            </label>
        </div>
        <div class="text-center pt-4 mt-4 createpage">
            <button type="submit" class="btn btn-primary send px-5">CREATE PAGE</button>
        </div>
    </form>
</main>



