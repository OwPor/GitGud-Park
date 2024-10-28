<?php
    session_start();
    include_once './links.php'; 
    include_once './secondheader.php'; 
    require_once './classes/db.class.php';
    $customerObj = new Customer();
    $email = $password = '';
    $err = $email_err = $password_err = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = 'Invalid email format';
            } else {
                $customerObj->email = $email;
                $customerObj->password = $password;
                
                $_SESSION['customer'] = $customerObj->checkCustomer();
                if ($_SESSION['customer']) {
                    header('Location: index.php');
                    exit();
                } else {
                    $err = 'Invalid email or password';
                }
            }
        } else {
            if (empty($_POST['email'])) {
                $email_err = 'Email is required';
            }
            if (empty($_POST['password'])) {
                $password_err = 'Password is required';
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['email']))
            $email = filter_var(trim($_GET['email']), FILTER_SANITIZE_EMAIL);
        
    } else if (isset($_SESSION['customer'])) {
        header('Location: index.php');
        exit();
    }
?>
<style>
    .whole {
        height: 100vh;
    }
    input {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }
</style>
<title>Sign In</title>
<section class="whole">
    <div class="leftside">
        <img src="./assets/images/logo.png" alt="">
        <p>A streamlined ordering platform connecting customers to various food stalls.</p>
    </div>
    <form action="" class="form" method="POST">
        <h4>Sign In</h4>
        <span class="text-danger"><?php echo $err; ?></span>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" required/>
            <span class="text-danger"><?php echo $email_err; ?></span>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required/>
            <span class="text-danger"><?php echo $password_err; ?></span>
        </div>
        <div class="btns-group d-block text-center">
            <input type="submit" value="Sign In" class="button">
        </div>

        <br>
        <span class="d-block text-center" style="font-size: 15px;">
            <a href="">Forgot Password?</a>
        </span>
        <span class="d-block text-center">Don't have an account? <a href="./signup.php">Sign Up</a></span>
    </form>
</section>
<script src="./assets/js/script.js"></script>
<?php
    include_once './footer.php'; 
?>
