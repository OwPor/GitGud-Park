<?php
    include_once 'links.php'; 
    include_once 'secondheader.php'; 
?>
<style>
.progressbar{
    max-width: 80%;
    margin: 2rem auto 4rem;
}
main {
  display: flex;
  height: calc(100vh - 65.61px); 
  overflow: hidden;
  background-color: white;
}

.fixed-image {
  width: 50%;
  object-fit: cover; 
}

.form {
  width: 50%;
  overflow-y: auto; 
  padding: 0 120px; 
  margin-top: 30px;
  border: none;
}
.btns-group, .btn-group{
    position: sticky;
    bottom: 0;
    padding: 30px 0;
    background-color: white;
    border-top: 3px solid #ccc;
    border-radius: 0;
    z-index: 100;
}
.mb{
    margin-bottom: 50%;
}
.form-floating input, .form-floating .form-select, .form-floating label::after {
    background-color: #F8F8F8 !important;
}
</style>
<main>

    <img src="assets/images/background.jpg" class="fixed-image">
    
    <form action="#" class="form">
        <div class="progressbar">
            <div class="progress" id="progress"></div>
            <div class="progress-step progress-step-active" data-title="Owner"></div>
            <div class="progress-step" data-title="Details"></div>
            <div class="progress-step" data-title="Address"></div>
            <div class="progress-step" data-title="Document"></div>
            <div class="progress-step" data-title="Submit"></div>
        </div>
        <div class="form-step form-step-active">
            <div class="mb">
                <h4 class="fw-bold">Confirm business owner details</h4>
                <p class="par mb-4">
                    The account you registered is linked to the business owner's details including name, email, and contact number. 
                    By proceeding, you will be associating this food park with your account. 
                    If this is correct, continue with your registration below. 
                    If you need to register with different owner details, please create a new account.
                </p>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control c" id="firstname" name="firstname" placeholder="First Name" value="Naila" readonly>
                    <label for="firstname">First Name <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control c" id="lastname" name="lastname" placeholder="Last Name" value="Haliluddin" readonly>
                    <label for="lastname">Last Name <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control c" id="email" name="email" placeholder="Email" value="example@gmail.com" readonly>
                    <label for="email">Email <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="input-group mb-3 mt-0">
                    <span class="input-group-text c">+63</span>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control c" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="9123456789" readonly>
                        <label for="phonenumber">Phone Number <span style="color: #CD5C08;">*</span></label>
                    </div>
                </div>
            </div>
            <div class="btn-group w-100">
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>
        <div class="form-step">
            <div class="mb">
                <h4 class="fw-bold">Tell us about your business</h4>
                <p class="par mb-4">This information will be shown on the web so that customers can search and contact you in case they have any questions.</p>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="businessname" name="businessname" placeholder="Food Park Name">
                    <label for="businessname">Business Name <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="row g-2 mb-4">
                    <div class="col-md-8">
                        <div class="form-floating">
                            <select class="form-select" id="businesstype" aria-label="Floating label select example">
                                <option value="Food Park" selected>Food Park</option>
                                <option value="Food Stall" disabled>Food Stall</option>
                            </select>
                            <label for="businesstype">Business Type <span style="color: #CD5C08;">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating position-relative">
                            <input type="text" class="form-control" id="branches" name="branches" placeholder="Branches">
                            <label for="branches">Branches <span style="color: #CD5C08;">*</span></label>
                            <i class="fa-regular fa-circle-question position-absolute end-0 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="You will be able to complete the registration of the first branch. Once you've finished the process, an account executive will contact you to complete the registration of the other branches."></i>
                            <script>
                                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                            </script>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control c" id="email" name="email" placeholder="Email" value="example@gmail.com" readonly>
                    <label for="email">Email <span style="color: #CD5C08;">*</span></label>
                </div>

                <div class="form-floating mb-3" id="businessemailGroup" style="display: none;">
                    <input type="text" class="form-control" id="businessemail" name="businessemail" placeholder="Business Email">
                    <label for="businessemail">Business Email <span style="color: #CD5C08;">*</span></label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckEmail" checked onchange="toggleBusinessEmailInput()">
                    <label class="form-check-label" for="flexCheckEmail">My Business and Personal Emails are the same</label>
                </div>

                <div class="input-group mb-3 mt-0">
                    <span class="input-group-text c">+63</span>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control c" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="9123456789" readonly>
                        <label for="phonenumber">Phone Number <span style="color: #CD5C08;">*</span></label>
                    </div>
                </div>

                <div class="input-group mb-3 mt-0" id="businessphonenumberGroup" style="display: none;">
                    <span class="input-group-text">+63</span>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="businessphonenumber" name="businessphonenumber" placeholder="Business Phone Number">
                        <label for="businessphonenumber">Business Phone Number <span style="color: #CD5C08;">*</span></label>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked onchange="toggleBusinessPhoneNumberInput()">
                    <label class="form-check-label" for="flexCheckChecked">My Business and Personal Phone numbers are the same</label>
                </div>

                <script>
                    function toggleBusinessPhoneNumberInput() {
                        const phoneInput = document.getElementById('phonenumber');
                        const businessPhoneNumberGroup = document.getElementById('businessphonenumberGroup');
                        const checkbox = document.getElementById('flexCheckChecked');

                        if (checkbox.checked) {
                            businessPhoneNumberGroup.style.display = 'none';
                            phoneInput.readOnly = true;
                        } else {
                            businessPhoneNumberGroup.style.display = 'flex';
                            phoneInput.readOnly = false;
                        }
                    }

                    function toggleBusinessEmailInput() {
                        const emailInput = document.getElementById('email');
                        const businessEmailGroup = document.getElementById('businessemailGroup');
                        const emailCheckbox = document.getElementById('flexCheckEmail');

                        if (emailCheckbox.checked) {
                            businessEmailGroup.style.display = 'none';
                            emailInput.readOnly = true;
                        } else {
                            businessEmailGroup.style.display = 'block';
                            emailInput.readOnly = false;
                        }
                    }
                </script>


                <div class="add-schedule mb-4 small">
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
                
                <div class="schedule-list small">
                    <h6>Operating Hours</h6>
                    <div id="scheduleContainer"></div>
                </div>
                <script src="assets/js/display.js"></script>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>
        <div class="form-step">
            <div class="mb">
                <h4 class="fw-bold">Where is your business located?</h4>
                <p class="par mb-4">
                    Customers will use this to find your business for directions and pickup options.
                </p>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control c" id="rpc" name="rpc" placeholder="Region, Province, City" value="Mindanao, Zamboanga Del Sur, Zamboanga City" readonly>
                    <label for="rpc">Region, Province, City <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Barangay">
                    <label for="barangay">Barangay <span style="color: #CD5C08;">*</span></label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="sbh" name="sbh" placeholder="Street Name, Building, House No.">
                    <label for="sbh">Street Name, Building, House No. <span style="color: #CD5C08;">*</span></label>
                </div>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>
        <div class="form-step">
            <div class="mb">
                <h4 class="fw-bold">Add your business permit</h4>
                <p class="par mb-4">
                    We need your legal document to verify and approve your business registration.
                </p>
                <div>
                    <label for="fplogo">Upload FULL pages of your Business Permit <span style="color: #CD5C08;">*</span></label>
                    <div class="logocon px-3 py-4 mt-3 text-center border">
                        <img src="assets/images/upload-icon.png" class="w-50 h-50 mb-2" alt=""><br>
                        <span>Maximum of 5 files of 2GB each and can accept only JPG, JPEG, PNG or PDF format</span>
                        <input type="file" id="fplogo" accept="image/jpeg, image/png, image/jpg, application/pdf" style="display:none;" multiple>
                    </div>
                    
                    <div id="uploaded-files" class="mt-4">
                        <h6 class="mb-3">Uploaded Files</h6>
                        <!-- Uploaded files list will appear here -->
                    </div>
                </div>
                <script src="assets/js/uploadedfiles.js"></script>
            </div>
            <div class="btns-group">
                <a href="" class="button btn-prev">Previous</a>
                <a href="" class="button btn-next">Next</a>
            </div>
        </div>
        <div class="form-step">
            <div class="mb">
                <h4 class="fw-bold">Review your details</h4>
                <p class="par mb-4">
                    Check carefully before you send us all the importance information.
                </p>
                <div class="box py-3 fs">
                    <div class="mb-2">
                        <h6 class="fw-bold">Business Owner</h6>
                        <a href="">Edit</a>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">First Name</span>
                        <span>Naila</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Last Name</span>
                        <span>Haliluddin</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Email</span>
                        <span>example@gmail.com</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Mobile Phone Number</span>
                        <span>+639123456789</span>
                    </div>
                </div>
                
                <div class="box py-3 fs">
                    <div class="mb-2">
                        <h6 class="fw-bold">Business Details</h6>
                        <a href="">Edit</a>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Business Name</span>
                        <span>GitGud</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Business Type</span>
                        <span>Food Park</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Number of Branches</span>
                        <span>1</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Business Phone Number</span>
                        <span>+639123456789</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Operating Hours</span>
                        <span>Mon - Sun (7:00 AM - 7:00 PM)</span>
                    </div>
                </div>

                <div class="box py-3 fs">
                    <div class="mb-3">
                        <h6 class="fw-bold">Business Address</h6>
                        <a href="">Edit</a>
                    </div>
                    <span class="mb-1">Unit 3, Building 13, Aplaya Compound, 
                        Rio Hondo, Zamboanga City, Zamboanga Del Sur, Mindanao, 7000
                    </span>
                </div>
                
                <div class="box py-3 mb-4 fs">
                    <div class="mb-2">
                        <h6 class="fw-bold">Business Document</h6>
                        <a href="">Edit</a>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Files</span>
                        <span>businesspermit.pdf</span>
                    </div>
                </div>

                <div class="form-check mb-4 last">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        By clicking this box, I confirm that I am authorised by the Vendor to accept this Registration Form and the following <a href="">Terms and Conditions.</a>
                    </label>
                </div>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <input type="submit" value="Submit" class="button" />
            </div>
        </div>  
        
    </form>
    <script src="assets/js/script.js"></script>
</main>

