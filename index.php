<?php
    include_once 'header.php';
    // include_once 'landingheader.php';
    include_once 'links.php'; 
    include_once 'modals.php';
    require_once __DIR__ . '/classes/db.class.php';
    require_once __DIR__ . '/classes/park.class.php';
    $userObj = new User();
    $parkObj = new Park();
    $isLoggedIn = false;
    
    if (isset($_SESSION['user'])) {
        if ($userObj->isVerified($_SESSION['user']['id']) == 1) {
            $isLoggedIn = true;
        } else {
            header('Location: email/verify_email.php');
            exit();
        }
    }
?>
<title>GitGud PMS</title>
<style>
    .lpseemore{
        background-color: #e5e5e5;
        cursor: pointer;
    }
</style>
<section class="first">
    <div class="firstinside">
        <div>
            <h1>Bringing taste and community together</h1>
            <p>Experience the flavor of connection at your local Food Park</p>
            <form action="" method="">
                <input type="text" name="" placeholder="Search Food Park">
                <button type="submit"><i class="fas fa-search fa-lg"></i></button>
            </form>
        </div>
        <img src="assets/images/first.png">
    </div>
</section>

<section class="second">
    <div class="secondinside">
        <img src="assets/images/owner.jpg">
        <div>
            <h1>Promote Your Food Park with Us!</h1>
            <p>
                Looking to attract more customers to your food park? We've got you covered!<br><br>
                We'll list your stalls' menus online and simplify the ordering process, helping you reach hungry customers quickly. From street food to local favorites, we'll boost your park's visibility.<br><br>
                Ready to grow your audience? Let's partner today!
            </p>
            <?php if ($isLoggedIn) { ?>
                <button onclick="window.location.href='parkregistration.php'">Get Started</button>
            <?php } else { ?>
                <button onclick="window.location.href='signup.php'">Get Started</button>
            <?php } ?>
        </div>
    </div>
</section>

<section class="third">
    <br><br><br>
    <h2>All Food Parks in Zamboanga City</h2><br>
    
    <div class="row row-cols-1 row-cols-md-4 g-3">
        <!-- <div class="col">
            <a href="./homepage.php" class="card-link text-decoration-none">
                <div class="card" style="position: relative;">
                    <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                    <i class="fa-solid fa-ellipsis-vertical ellipsis-icon"></i>
                    <div class="card-body">
                        <h5 class="card-title">Food Park Name</h5>
                        <p class="card-text text-muted "><i class="fa-solid fa-location-dot"></i> Street Name, Barangay, Zamboanga City</p>
                        <span class="opennow">Open Now</span>
                    </div>
                </div>
            </a>
        </div> -->
        <?php
            $parks = $parkObj->getParks();
            foreach ($parks as $park) { 
                if ($park['status'] != 'Maintenance' && $park['status'] != 'Pending Approval') {
                    $uniqueLink = "./park.php?id=" . $park['url'];
                    ?>
                    <div class="col">
                        <div class="card">
                            <a href="<?= $uniqueLink ?>" class="card-link text-decoration-none">
                                <img src="<?= $park['image'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark"><?= $park['name'] ?></h5>
                                    <p class="card-text text-muted"><i class="fa-solid fa-location-dot me-2"></i><?= $park['location'] ?></p>
                                    <span class="opennow">Open Now</span>
                                </div>
                            </a>
                            <div class="text-center p-2 lpseemore rounded-4 mx-3 mb-3 small" data-bs-toggle="modal" data-bs-target="#seemorepark">See more...</div>
                        </div>
                    </div>
            <?php 
                }
            }
            ?>
    </div>
    <br><br><br>
</section>
<?php
    include_once 'footer.php'; 
?>

