<?php
    include_once './links.php'; 
    include_once './secondheader.php'; 
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
        <img src="./assets/images/logo.png" alt="">
        <p>A streamlined ordering platform connecting customers to various food stalls.</p>
    </div>
    <form action="#" class="form">
        <h4>Sign In</h4>
        
        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" required/>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required/>
        </div>
        <div class="btns-group d-block text-center">
            <input type="submit" value="Sign In" class="button">
        </div>

        <br>
        <span class="d-block text-center" style="font-size: 15px;">
            <a href="">Forgot Password?</a>
        </span>
        <span class="d-block text-center">Don't have an account? <a href="signup.php">Sign Up</a></span>
    </form>
</section>
<script src="assets/js/script.js"></script>
<?php
    include_once './footer.php'; 
?>
