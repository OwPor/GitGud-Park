<?php 
    include_once 'links.php'; 
?>
<nav>
    <div class="top">
        <!-- NOT LOGIN -->
        <ul>
            <li><a href="signin.php">Sign In</a></li>
            <span style="color:white;">|</span>
            <li><a href="signup.php">Sign Up</a></li>
        </ul> 

        <!-- LOGIN 
        <ul>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
            <li><a href="notification.php"><i class="fa-solid fa-bell"></i>Notifications</a></li>
            <li>
                <div class="dropdown">
                    <a href="javascript:void(0)" onclick="toggleDropdown()">
                        <img src="assets/images/user.jpg" alt="Profile Image"> username
                    </a>
                    <div class="dropdown-content" id="dropdownMenu">
                        <a href="account.php"><i class="fa-regular fa-user"></i> Account</a>
                        <a href="purchase.php"><i class="fa-regular fa-credit-card"></i> Purchase</a>
                        <a href="favorites.php"><i class="fa-regular fa-heart"></i> Favorites</a>
                        <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
        -->

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
