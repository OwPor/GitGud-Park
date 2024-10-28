<?php
    include_once 'links.php'; 
    include_once 'secondheader.php';

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        // Compare password and confirmPassword before proceeding
        if ($password != $confirmPassword) {
            echo "<script>alert('Passwords do not match!')</script>";
        } else {
            // Proceed with registration
        }
    }
?>
<style>
    input {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }
</style>
<section class="whole">
    <div class="leftside">
        <img src="assets/images/logo.png" alt="">
        <p>A streamlined ordering platform connecting customers to various food stalls.</p>
    </div>
    <form action="#" class="form" method="POST">
        <h4>Sign Up</h4>
        <span>Already have an account? <a href="signin.php">Sign In</a></span>

        <div class="progressbar">
            <div class="progress" id="progress"></div>
            <div class="progress-step progress-step-active" data-title="Name"></div>
            <div class="progress-step" data-title="Contact"></div>
            <div class="progress-step" data-title="Other"></div>
            <div class="progress-step" data-title="Password"></div>
        </div>

        <div class="form-step form-step-active">
            <div class="input-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" placeholder="Enter your first name" required/>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your last name" required/>
            </div>
            <div class="btns-group d-block text-center">
                <input type="button" value="Next" class="button btn-next">
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required/>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email" required/>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob"/>
            </div>
            <div class="input-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" id="gender" placeholder="Enter your gender" required/>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required/>
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password" required/>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <input type="submit" value="Sign Up" class="button" />
            </div>
        </div>
        <br>
        <span class="d-block text-center" style="font-size: 15px;">
            By signing up, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
        </span>
    </form>
</section>
<script src="./assets/js/script.js"></script>
<?php
    include_once 'footer.php'; 
?>
