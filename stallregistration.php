<?php
    include_once 'links.php'; 
    include_once 'bootstrap.php'; 
    include_once 'secondheader.php'; 
?>
<style>
    .form-floating input{
        border-color: ;
    }
    .logo{
        height: 240px;
        width: 240px;
        cursor: pointer;
        border-radius: 50%;
        background-color: white;
    }
    .logo i{
        background-color: #D9D9D9;
        border-radius: 50%;
    }
    .logo:hover{
        
    }
    .logorem{
        line-height: 1.2;
        font-size: 12px;
    }
    /*main {
        background-image: url('assets/images/stall.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: calc(100vh - 65.61px); 
    }*/
    .srform{
        border: 1px #ccc solid;
        padding: 30px 40px;
        background-color: white;
        margin: 0 200px;
        border-radius: 20px;
    }
    .form-floating input, .form-floating textarea, .form-floating label::after, .logo{
        background-color: #F8F8F8 !important;
    }
</style>
<main>
    <form action="" class="srform">
        <h4 class="fw-bold">Confirm business owner details</h4>
        <p class="par mb-4">
            The account you registered is linked to the business owner's details including name, email, and contact number. 
            By proceeding, you will be associating this food park with your account. 
            If this is correct, continue with your registration below. 
            If you need to register with different owner details, please create a new account.
        </p>
        <div class="d-flex gap-4 align-items-center">
            <div class="logo px-4 py-5 text-center border flex-shrink-0">
                <i class="fa-solid fa-arrow-up-from-bracket fs-3 p-2 mb-1"></i><br>
                <label for="stalllogo" class="fw-bold m-0 fs-6">Add Business Logo</label><br>
                <input type="file" id="stalllogo" accept="image/jpeg, image/png, image/jpg" style="display:none;">
                <p class="small">or drag and drop</p>
                <span class="text-muted logorem">Image size must be less than 5MB. Only JPG, JPEG, and PNG formats are allowed.</span>
            </div>
            
            <div class="flex-grow-1 ms-4">
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" style="color: black;" id="businessname" name="businessname" placeholder="Business Name">
                    <label for="businessname">Business Name <span style="color: #CD5C08;">*</span></label>
                </div>

                <div class="form-group m-0 select2Part select2multiple w-100 floating-group">
                    <label class="floating-label">Business Category <span style="color: #CD5C08;">*</span></label>
                    <select name="" id="" class="form-control customSelectMultiple floating-control" multiple>
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

        <div class="contact">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email">
                <label for="businessemail">Business Email <span style="color: #CD5C08;">*</span></label>
            </div>
            <div class="input-group mb-3 mt-0">
                <span class="input-group-text">+63</span>
                <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number">
                    <label for="businessphonenumber">Business Phone Number <span style="color: #CD5C08;">*</span></label>
                </div>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                <label for="website">Website <span style="color: #CD5C08;">*</span></label>
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
            <script src="assets/js/display.js"></script>
        </div>
        <div class="paymentmethod">
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
    </form>
</main>

