<?php
    include_once 'modals.php'; 
    include_once 'links.php'; 
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
<section class="third">
    <br><br><br>
    <h2>All Food Parks in Zamboanga City</h2><br>
    
    <div class="row row-cols-1 row-cols-md-4 g-3">
        <?php
            $parks = $parkObj->getParks();
            foreach ($parks as $park) { 
                if ($park['business_status'] != 'Reject' && $park['business_status'] != 'Pending Approval') {
                    $uniqueLink = "./park.php?id=" . $park['url'];
                    ?>
                    <div class="col">
                        <div class="card">
                            <a href="<?= $uniqueLink ?>" class="card-link text-decoration-none">
                                <img src="<?= $park['business_permit'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark"><?= $park['business_name'] ?></h5>
                                    <p class="card-text text-muted"><i class="fa-solid fa-location-dot me-2"></i><?= $park['street_building_house'] ?>, <?= $park['barangay'] ?>, Zamboanga City</p>
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

