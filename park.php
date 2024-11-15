<?php 
    include_once 'links.php'; 
    include_once 'header.php';
    /*require_once __DIR__ . '/classes/db.class.php';
    require_once __DIR__ . '/classes/park.class.php';
    $userObj = new User();
    $parkObj = new Park();
    $isLoggedIn = false;

    if (isset($_SESSION['user']['id'])) {
        if ($userObj->isVerified($_SESSION['user']['id']) == 1) {
            $isLoggedIn = true;
        } else {
            header('Location: email/verify_email.php');
            exit();
        }
    }
    
    if (isset($_GET['id'])) {
        $park_link = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
        $park = $parkObj->getPark($park_link);

        if (!$park) {
            header('Location: index.php');
            exit();
        }

        $stalls = $parkObj->getStalls($park);

        if (!$stalls) {
            echo 'No stalls found.';
        }
    } else {
        header('Location: index.php');
        exit();
    }*/

?>

<style>
    main{
        background-color: white;
    }
</style>
<main>
<section>
    <br>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/foodpark.jpg" class="d-block w-100 h-50 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/images/foodpark.jpg" class="d-block w-100 h-50 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/images/foodpark.jpg" class="d-block w-100 h-50 rounded" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- <section class="third">
    <br><br>
    <h3 class="mb-3">Categories</h3>
    <div class="tpdiv position-relative">
        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>
        <div class="d-flex rightfilter gap-3">
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
            <a href="#" class="text-decoration-none text-center">
                <img src="assets/images/foodpark.jpg" width="110px" height="110px" class="rounded-2">
                <span class="text-dark d-block mt-1">Chicken</span>
            </a>
        </div>
        <a href="stallpage.php" class="card-link text-decoration-none">
        </a>
        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>

</section> -->

<section>
    <br><br>
    <h3 class="mb-3">Top Rated</h3>
    <div class="tpdiv position-relative">
        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>
        <div class="d-flex rightfilter gap-3">
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
        </div>
        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>
</section>

<section>
    <br><br>
    <h3 class="mb-3">With Promo</h3>
    <div class="tpdiv position-relative">
        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>
        <div class="d-flex rightfilter gap-3">
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
        </div>
        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>
</section>

<section>
    <br><br>
    <h3 class="mb-3">New Open</h3>
    <div class="tpdiv position-relative">
        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>
        <div class="d-flex rightfilter gap-3">
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                    <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
            <a href="stallpage.php" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative">
                <button class="add"><i class="fa-regular fa-heart"></i></button>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="p-3" style="width:500px;">
                     <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                    <h5 class="card-title my-2" style="color: black;">Food Stall Name Food Stall Name</h5>
                    <div class="d-flex justify-content-between">
                        <p class="card-text text-muted m-0">Description</p>
                        <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                    </div>
                    <div class="mt-2">
                        <span class="opennow">Top Rated</span>
                        <span class="discount">With Promo</span>
                        <span class="newopen">New Open</span>
                    </div>
                </div>
            </a>
        </div>
        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>
</section>

<section>
    <br><br>
    <h3 class="mb-3">All Food Stalls</h3>
    <div class="oc">
        <button class="btn btn-outline-secondary" onclick="filterStalls('open')">Top Rated</button>
        <button class="btn btn-outline-secondary" onclick="filterStalls('closed')">Closed</button>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-3">
        <div class="col">
            <a href="stallpage.php" class="card-link text-decoration-none bg-white">
                <div class="card" style="position: relative;">
                    <img src="assets/images/user.jpg" class="card-img-top" alt="...">
                    <div class="closed">Closed until Wed 10:00 AM</div>
                    <button class="add"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                         <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                        <h5 class="card-title my-2">Food Stall Name</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text text-muted m-0">Description</p>
                            <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                        </div>
                        <div class="mt-2">
                            <span class="discount">With Promo</span>
                            <span class="newopen">New Open</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- <div class="col">
            <a href="stallpage.php" class="card-link text-decoration-none bg-white">
                <div class="card" style="position: relative;">
                    <img src="assets/images/foodpark.jpg" class="card-img-top" alt="...">
                    <button class="add"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                         <div class="d-flex gap-2 align-items-center">
                        <p class="card-text text-muted m-0">Category</p>
                        <span class="dot text-muted"></span>
                        <p class="card-text text-muted m-0">Category</p>
                    </div>
                        <h5 class="card-title my-2">Food Stall Name</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text text-muted m-0">Description</p>
                            <span style="color:#6A9C89;"><i class="fa-solid fa-heart"></i> 200</span>
                        </div>
                        <div class="mt-2">
                            <span class="opennow">Top Rated</span>
                            <span class="discount">With Promo</span>
                            <span class="newopen">New Open</span>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->

        <?php
            foreach ($stalls as $stall) {
                if ($stall['status'] == 'Open') {
                    $uniqueLink = "./stallpage.php?id=" . $stall['id'];
                    ?>
                    <div class="col open-stall">
                        <a href="<?= $uniqueLink ?>" class="card-link text-decoration-none bg-white">
                            <div class="card" style="position: relative;">
                                <img src="<?= $stall['img'] ?>" class="card-img-top" alt="...">
                                <button class="add"><i class="fa-regular fa-heart"></i></button>
                                <div class="card-body">
                                    <h5 class="card-title my-2"><?= $stall['name'] ?></h5>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text text-muted m-0"><?= $stall['description'] ?></p>
                                    </div>
                                    <div class="mt-2">
                                        <span class="opennow">Top Rated</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                } else if ($stall['status'] == 'Closed') {
                    $uniqueLink = "./stallpage.php?id=" . $stall['id'];
                    ?>
                    <div class="col closed-stall" hidden>
                        <div class="card card-link text-decoration-none bg-white" style="position: relative;">
                            <img src="<?= $stall['img'] ?>" class="card-img-top" alt="...">
                            <button class="add"><i class="fa-regular fa-heart"></i></button>
                            <div class="card-body">
                                <h5 class="card-title my-2"><?= $stall['name'] ?></h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text text-muted m-0"><?= $stall['description'] ?></p>
                                </div>
                                <div class="mt-2">
                                    <span class="opennow">Closed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } 
        ?>
    </div>
    <br><br>
</section>
</main> 

<script src="assets/js/filterstalls.js"></script>
<script src="./assets/js/parkcard.js?v=<?php echo time(); ?>"></script>
<?php
    include_once 'footer.php'; 
?>
