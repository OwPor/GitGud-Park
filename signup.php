<?php
    include_once 'links.php'; 
    include_once 'secondheader.php';
    require_once './classes/db.class.php';

    $first_name = $last_name = $phone = $email = $dob = $sex = $password = $confirm_password = '';
    $first_name_err = $last_name_err = $phone_err = $email_err = $dob_err = $sex_err = $password_err = $confirm_password_err = '';

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['sex']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                $first_name = htmlspecialchars(trim($_POST['firstname']));
                $last_name = htmlspecialchars(trim($_POST['lastname']));
                $phone = htmlspecialchars(trim($_POST['phone']));
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $dob = htmlspecialchars(trim($_POST['dob']));
                $sex = htmlspecialchars(trim($_POST['sex']));
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                
                if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) {
                    $first_name_err = "Only letters and white space allowed";
                }

                if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
                    $last_name_err = "Only letters and white space allowed";
                }

                if ($password !== $confirm_password) {
                    $password_err = 'Passwords do not match';
                } else if ($password < 8) {
                    $password_err = 'Password must be at least 8 characters';
                } else {
                    $customer = new Customer();
                    $customer->first_name = $first_name;
                    $customer->last_name = $last_name;
                    $customer->phone = $phone;
                    $customer->email = $email;
                    $customer->birth_date = $dob;
                    $customer->sex = $sex;
                    $customer->password = $password;

                    if ($customer->addCustomer()) {
                        header('Location: signin.php');
                        exit();
                    } else {
                        echo '<script>alert("Failed to sign up")</script>';
                    }
                }
            } else {
                if (empty($_POST['firstname'])) {
                    $first_name_err = 'First name is required';
                }
                if (empty($_POST['lastname'])) {
                    $last_name_err = 'Last name is required';
                }
                if (empty($_POST['phone'])) {
                    $phone_err = 'Phone is required';
                }
                if (empty($_POST['email'])) {
                    $email_err = 'Email is required';
                } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email_err = 'Invalid email format';
                }
                if (empty($_POST['dob'])) {
                    $dob_err = 'Date of birth is required';
                }
                if (empty($_POST['sex'])) {
                    $sex_err = "Sex is required";
                }
                if (empty($_POST['password'])) {
                    $password_err = 'Password is required';
                }
                if (empty($_POST['confirm_password'])) {
                    $confirm_password_err = 'Confirm password is required';
                }
            }
            break;
        case 'GET':
            if (isset($_GET['firstname']))
                $first_name = $_GET['firstname'];

            if (isset($_GET['lastname']))
                $last_name = $_GET['lastname'];

            if (isset($_GET['phone']))
                $phone = $_GET['phone'];

            if (isset($_GET['email']))
                $email = $_GET['email'];

            if (isset($_GET['dob']))
                $dob = $_GET['dob'];

            if (isset($_GET['sex'])) 
                $sex = $_GET['sex'];

            if (isset($_GET['password']))
                $password = $_GET['password'];

            if (isset($_GET['confirm_password']))
                $confirm_password = $_GET['confirm_password'];
            break;
    }
?>
<title>Sign Up</title>
<style>
    .form-group {
        margin-bottom: 0.5rem;
    }
    .input-group {
        margin-top: 0;
    }
    .input-group-text {
        height: 100%;
    }
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
<section class="whole">
    <div class="leftside">
        <img src="./assets/images/logo.png" alt="">
        <p>A streamlined ordering platform connecting customers to various food stalls.</p>
    </div>
    <form action="#" class="form" method="POST">
        <h4>Sign Up</h4>
        <span>Already have an account? <a href="./signin.php">Sign In</a></span>

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
                <input type="text" name="firstname" id="firstname" placeholder="Enter your first name" value="<?= $first_name ?>" required/>
                <span class="text-danger"><?= $first_name_err ?></span>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your last name" value="<?= $last_name ?>" required/>
                <span class="text-danger"><?= $last_name_err ?></span>
            </div>
            <div class="btns-group d-block text-center">
                <input type="button" value="Next" class="button btn-next">
            </div>
        </div>

        <div class="form-step">
            <div class="form-group">
                <label for="phone" class="mb-1">Phone Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+63</span>
                    </div>
                    <input type="tel" name="phone" id="phone" class="form-control phone-input" value="<?= $phone ?>" maxlength="10" min="10" max="10" required>
                    <span class="text-danger"><?= $phone_err ?></span>
                </div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= $email ?>" required/>
                <span class="text-danger"><?= $email_err ?></span>
            </div>
            <div class="btns-group">
                <a href="#" class="button btn-prev">Previous</a>
                <a href="#" class="button btn-next">Next</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="<?= $dob ?>" required/>
            </div>
            <div class="input-group">
                <label for="sex">Sex</label>
                <select name="sex" id="sex" value="<?= $sex ?>" required>
                    <option value="" disabled <?php echo empty($sex) ? "selected" : ""; ?>>Select your sex</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="text-danger" id="sex_err"></span>
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
                <span class="text-danger"><?= $password_err ?></span>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required/>
                <span class="text-danger"><?= $confirm_password_err ?></span>
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
    include_once './footer.php'; 
?>
