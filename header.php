<?php 
    session_start();
    include_once 'links.php'; 
    require_once __DIR__ . '/classes/db.class.php';
    $userObj = new User();
?>

<nav>
    <div class="top">
        <?php
            if (isset($_SESSION['user'])) {
                // LOGGED IN
                if ($_SESSION['user']['isVerified'] == 0) {
                    header('Location: ./email/verify_email.php');
                    exit();
                }
                
                $user = $userObj->getUser($_SESSION['user']['id']);

                ?>
                <ul>
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
                    <li><a href="notification.php"><i class="fa-solid fa-bell"></i>Notifications</a></li>
                    <li>
                        <div class="dropdown">
                            <a href="javascript:void(0)" onclick="toggleDropdown()">
                                <img src="assets/images/user.jpg" alt="Profile Image"> 
                                <span><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></span>
                            </a>
                            <div class="dropdown-content" id="dropdownMenu">
                                <a href="account.php"><i class="fa-regular fa-user"></i> Account</a>
                                <a href="purchase.php"><i class="fa-regular fa-credit-card"></i> Purchase</a>
                                <a href="favorites.php"><i class="fa-regular fa-heart"></i> Favorites</a>
                                <a href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php
            } else {
                // NOT LOGGED IN
                ?>
                <ul>
                    <li><a href="signin.php">Sign In</a></li>
                    <span style="color:white;">|</span>
                    <li><a href="signup.php">Sign Up</a></li>
                </ul>
                <?php
            }
        ?>
        

    </div>
    <div class="bottom">
        <a href="landingpage.php">
            <img src="assets/images/logo.png" alt="">
        </a>
        <div>
            <form action="#" method="get">
                <input type="text" name="search" placeholder="Search">
                <button type="submit"><i class="fas fa-search fa-lg"></i></button>
            </form>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="popular.php">Popular</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="new.php">New</a></li>
                <li><a href="promotion.php">Promotion</a></li>
            </ul>
        </div>
    </div> 
</nav>

<script src="assets/js/script.js"></script>
<script src="assets/js/dropdown.js"></script>
