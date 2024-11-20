<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'nav.php'; 
?>
<style>
    main {
        padding: 20px 120px;
    }
    #profileImage {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }
</style>
<main>
    <form class="bg-white rounded-2 p-5">
        <h4 class="fw-bold text-center mb-5">Manage Account</h4>
        <div class="d-flex ">
            <div class="d-flex justify-content-center" style="width: 40%;">
                <div class="text-center flex-grow-1">
                    <img id="profileImage" src="assets/images/profile.jpg" alt="Profile Image">
                    <input type="file" id="fileInput" style="display: none;" accept="image/*"><br><br>
                    <button id="uploadButton" class="disatc m-0">Upload Image</button><br><br>
                    <span class="text-muted">File size: maximum 1 MB<br>File extension: .JPEG, .PNG</span>
                </div>
                <script src="assets/js/editdisplayimage.js?v=<?php echo time(); ?>"></script>
            </div>
            
            <div  style="width: 60%;">
                <div class="input-group m-0 mb-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="firstname" class="m-0 text-muted" style="width: 250px;">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Enter your first name" value="John" required />
                    </div>
                </div>
                <div class="input-group m-0 mb-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="lastname" class="m-0 text-muted" style="width: 250px;">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Enter your last name" value="Doe" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="phone" class="mb-2 text-muted" style="width: 250px;">Phone Number</label>
                        <div class="input-group m-0 mb-4">
                            <span class="input-group-text rounded-0">+63</span>
                            <input type="tel" name="phone" id="phone" class="form-control phone-input rounded-0" value="9123456789" maxlength="10" placeholder="Enter your phone number" required>
                        </div>
                    </div>
                </div>
                <div class="input-group m-0 mb-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="email" class="m-0 text-muted" style="width: 250px;">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" value="johndoe@example.com" required />
                    </div>
                </div>
                <div class="input-group m-0 mb-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="dob" class="m-0 text-muted" style="width: 250px;">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="2000-01-01" required />
                    </div>
                </div>
                <div class="input-group m-0 mb-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <label for="sex" class="m-0 text-muted" style="width: 250px;">Sex</label>
                        <select name="sex" id="sex" required style="padding: 12px 0.75rem; flex-grow: 1;">
                            <option value="" disabled>Select your sex</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="text-danger" id="sex_err"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <input type="submit" class="addpro px-5" value="Save">
        </div>
    </form>
    <br><br><br><br>
</main>
<?php include_once 'footer.php'; ?>
