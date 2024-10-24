<?php
    include_once 'links.php'; 
    include_once 'secondheader.php'; 
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
    <form action="#" class="form">
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
                <input type="text" name="firstname" id="firstname" placeholder="Enter your first name"/>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your last name"/>
            </div>
            <div class="">
                <a href="#" class="button btn-next width-50 ml-auto">Next</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone number"/>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email"/>
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
                <input type="text" name="gender" id="gender" placeholder="Enter your gender"/>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"/>
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password"/>
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
<script src="assets/js/script.js"></script>
<?php
    include_once 'footer.php'; 
?>
