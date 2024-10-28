<?php 
    session_start();
    include_once 'links.php'; 
?>
<style>
    .name {
        margin-right: 1rem;
    }
    
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .profileIMG {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    
</style>
<nav>
    <div class="top">
        <?php
            if (isset($_SESSION['customer'])) {
                // LOGGED IN
                ?>
                <ul>
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
                    <li><a href="notification.php"><i class="fa-solid fa-bell"></i>Notifications</a></li>
                    <li>
                        <span class="name">
                            <?php echo $_SESSION['customer']['first_name']; ?> <?php echo $_SESSION['customer']['last_name']; ?>
                        </span>
                        <div class="dropdown">
                            <a onclick="toggleDropdown()">
                                <img class="profileIMG" src="assets/images/user.jpg" alt="Profile Image">
                            </a>
                            <div class="dropdown-content" id="dropdownMenu">
                                <a href="account.php"><i class="fa-regular fa-user"></i> <span> Account </span></a>
                                <a href="purchase.php"><i class="fa-regular fa-credit-card"></i> <span> Purchase </span></a>
                                <a href="favorites.php"><i class="fa-regular fa-heart"></i> <span> Favorites </span></a>
                                <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> <span> Logout </span></a>
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
