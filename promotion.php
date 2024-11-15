<?php 
    include_once 'links.php'; 
    include_once 'header.php';
    include_once 'modals.php';
?>
<style>
    /*
Color Palette:
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
    main{
        background-color: white;
        padding: 20px 120px;
    }
    .fsname:hover{
        text-decoration: underline;
    }
    .disatc{
        background-color: #CD5C08;
        color: white;
        height: fit-content;
        border: none;
        padding: 5px 20px;
        border-radius: 5px;
    }
    .disother{
        top: 5px;
        left: 5px;
    }
    .dispro{
        background-color: #C1D8C3;
        padding: 30px;
    }
</style>
<main>
    <div class="dispro border rounded-4">
        <div class="d-flex align-items-center justify-content-between">
            <img src="assets/images/bg.png" width="200px" height="100px">
            <h1 class="m-0 fs-1 text-white fw-bold">Don't Miss Out Limited Time Discount</h1>
            <img src="assets/images/bg.png" width="200px" height="100px">
        </div>
        <div class="tpdiv position-relative">
            <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>
            <div class="d-flex rightfilter gap-3">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative" style="width: 320px;">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <div class="position-absolute disother">
                            <span class="opennow">Popular</span>
                            <span class="newopen">New</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                            <h5 class="card-title mt-2 mb-4">Beef And Mushroom Pizza</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="pricebefore small">₱103</span>
                                        <span style="color: #6A9C89;"><i class="fa-solid fa-tags"></i>10% off</span>
                                    </div>
                                    <h1 class="proprice fs-1 my-1">₱103</h1>                         
                                    <span class="text-muted">Until March 20, 2024</span>
                                </div>
                                <button class="disatc m-0">ADD</button>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative" style="width: 320px;">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <div class="position-absolute disother">
                            <span class="opennow">Popular</span>
                            <span class="newopen">New</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                            <h5 class="card-title mt-2 mb-4">Beef And Mushroom Pizza</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="pricebefore small">₱103</span>
                                        <span style="color: #6A9C89;"><i class="fa-solid fa-tags"></i>10% off</span>
                                    </div>
                                    <h1 class="proprice fs-1 my-1">₱103</h1>                         
                                    <span class="text-muted">Until March 20, 2024</span>
                                </div>
                                <button class="disatc m-0">ADD</button>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative" style="width: 320px;">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <div class="position-absolute disother">
                            <span class="opennow">Popular</span>
                            <span class="newopen">New</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                            <h5 class="card-title mt-2 mb-4">Beef And Mushroom Pizza</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="pricebefore small">₱103</span>
                                        <span style="color: #6A9C89;"><i class="fa-solid fa-tags"></i>10% off</span>
                                    </div>
                                    <h1 class="proprice fs-1 my-1">₱103</h1>                         
                                    <span class="text-muted">Until March 20, 2024</span>
                                </div>
                                <button class="disatc m-0">ADD</button>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative" style="width: 320px;">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <div class="position-absolute disother">
                            <span class="opennow">Popular</span>
                            <span class="newopen">New</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                            <h5 class="card-title mt-2 mb-4">Beef And Mushroom Pizza</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="pricebefore small">₱103</span>
                                        <span style="color: #6A9C89;"><i class="fa-solid fa-tags"></i>10% off</span>
                                    </div>
                                    <h1 class="proprice fs-1 my-1">₱103</h1>                         
                                    <span class="text-muted">Until March 20, 2024</span>
                                </div>
                                <button class="disatc m-0">ADD</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
        </div>
    </div>
    <!--<div class="d-flex pagefilter gap-5 justify-content-center">
        <a href="#alltime" class="nav-link">All Time Favorites</a>
        <a href="#discount" class="nav-link">Discounted Picks</a>
        <a href="#new" class="nav-link">New & Trending</a>
    </div>
    <br>
    <section id="alltime">
        <h4 class="py-3 m-0">All Time Favorites</h4>
        <div class="inventory">
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                <h5 class="ranknumber">1</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">2</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">3</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">4</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <br><br>
    <section id="discount">
        <h4 class="py-3 m-0">Discounted Picks</h4>
        <div class="inventory">
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">1</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">2</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">3</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">4</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <br><br>
    <section id="new">
        <h4 class="py-3 m-0">New & Trending</h4>
        <div class="inventory">
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">1</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">2</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">3</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
            <a href="#" class="text-decoration-none bg-white d-flex align-items-center border rounded-2 position-relative" data-bs-toggle="modal" data-bs-target="#menumodal">
                <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>

                <h5 class="ranknumber">4</h5>
                <img src="assets/images/foodpark.jpg" class="h-100 rounded-start-2" width="150px">
                <div class="py-2 px-3 w-100">
                    <p class="card-text text-muted m-0 fsname" onclick="window.location.href='stallpage.php';">Food Stall Name</p>
                    <h5 class="card-title my-2" style="color: black;">Beef And Mushroom Pizza</h5>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="proprice">₱103</span>
                            <span class="pricebefore small">₱103</span>
                        </div>
                        <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                    </div>  
                    <div class="mt-2">
                        <span class="opennow">Popular</span>
                        <span class="discount">10% off</span>
                        <span class="newopen">New</span>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <br><br><br><br><br><br>-->
</main> 

<script src="assets/js/filterstalls.js"></script>
<script src="./assets/js/navigation.js?v=<?php echo time(); ?>"></script>
<?php
    include_once 'footer.php'; 
?>
