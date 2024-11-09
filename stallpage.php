<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'modals.php'; 
?>
<style>
    .pageinfo{
        background-color: white;
        padding: 30px 120px 0 120px;
    }
    .pagelogo img{
        width: 250px;
        height: 250px;
        border-radius: 50%;
    }
    .likpro {
        color: #6A9C89;
        font-weight: bold;
    }
    .conopepay{
        font-size: 15px;
    }
    .pageon{
        font-size: 14px;
        color: #6A9C89;
        margin-right: 10px;
    }


    .pagefilter {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 10;
        padding: 0 120px;
        border-bottom: 1px #ccc solid;
    }
    .searchmenu{
        display: flex;
        border-radius: 50px;
        padding: 5px 10px;
        border: #ccc 1px solid;
        align-items: center;
    }
    .searchmenu input{
        border: 0;
        outline: none;
        width: 170px;
    }
    .searchmenu button{
        background-color: #fff;
        border: none;
        margin-right: 8px;
        font-size: 12px;
        color: gray;
    }
    .pagefilter a {
        text-decoration: none;
        color: black;
        padding: 20px 12px;
        white-space: nowrap; 
    }

    .pagefilter a:hover,
    .pagefilter a.active {
        border-bottom: 2px solid #CD5C08;
    }

    .pagefilter a i {
        color: #CD5C08;
    }


    .rightfilter {
        overflow-x: auto;
        scrollbar-width: none;
    }

    .scroll-arrow {
        cursor: pointer;
        color: gray;
        display: flex;
        align-items: center;
        padding: 6px 7px;
        border-radius: 50%;
        border: 1px #ddd solid;
    }
    .scroll-arrow:hover{
        background-color: #e5e5e5;
        transform: scale(1.2);
    }
    section{
        padding: 0 120px;
    }
    .addtocart {
        background-color: #FFF5E4;
        color: #CD5C08;
        font-size: 30px;
        border-radius: 50%;
        width: 40px;           
        height: 40px;        
        border: #ddd 0.5px solid;
        transition: transform 0.3s ease;
        top: 10px;
        right: 10px;
    }
    .addtocart:hover {
        transform: scale(1.1);
    }

    .pricebefore{
        text-decoration: line-through;
        color: gray;
    }


    /*
    Color Palette:
    #CD5C08
    #FFF5E4
    #C1D8C3
    #6A9C89
    */
</style>
<main>
    <div class="pageinfo pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4 align-items-center pagelogo">
                <img src="assets/images/foodpark.jpg" alt="">
                <div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="text-muted m-0">Category</span>
                        <span class="dot text-muted"></span>
                        <span class="text-muted m-0">Category</span>
                        <span class="dot text-muted"></span>
                        <span class="text-muted m-0">Category</span>
                    </div>
                    <h5 class="my-2 fw-bold fs-2">Food Stall Name</h5>
                    <p class="text-muted m-0">Description</p>

                    <div class="d-flex gap-2 align-items-center my-2">
                        <span class="pageon">Open now</span>
                        <span class="dot text-muted"></span>
                        <button class="conopepay"><i class="fa-solid fa-circle-info"></i> More info</button>
                    </div>

                    <div class="d-flex gap-5 m-0">
                        <div class="d-flex gap-2">
                            <span>Likes</span>
                            <span class="likpro">999</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>Products</span>
                            <span class="likpro">999</span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="pagelike">Like</button>
        </div>
    </div>

    <div class="d-flex pagefilter align-items-center gap-3">
        <div class="d-flex align-items-center gap-3 leftfilter">
            <form action="#" method="get" class="searchmenu">
                <button type="submit"><i class="fas fa-search fa-lg"></i></button>
                <input type="text" name="search" placeholder="Search in menu">
            </form>
            <a href="#popular" class="nav-link"><i class="fa-solid fa-fire-flame-curved"></i> Popular</a>
            <a href="#new" class="nav-link"><i class="fa-solid fa-ribbon"></i> New</a>
            <a href="#promo" class="nav-link"><i class="fa-solid fa-percent"></i> Promo</a>
        </div>

        <i class="fa-solid fa-arrow-left scroll-arrow left-arrow" style="display: none;"></i>

        <div class="d-flex rightfilter gap-3">
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
            <a href="#category1" class="nav-link">Category 1</a>
            <a href="#category2" class="nav-link">Category 2</a>
            <a href="#category3" class="nav-link">Category 3</a>
        </div>

        <i class="fa-solid fa-arrow-right scroll-arrow right-arrow"></i>
    </div>

    <section id="popular" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">POPULAR</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#menumodal">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="new" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">NEW</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="promo" class="pt-3 mt-3">
        <h5 class="mb-3 fw-bold">PROMO</h5>
        <div class="row row-cols-1 row-cols-md-4 g-3">
            <div class="col">
                <a href="#" class="card-link text-decoration-none">
                    <div class="card position-relative">
                        <img src="assets/images/example.jpg" class="card-img-top" alt="...">
                        <button class="addtocart position-absolute fw-bold d-flex justify-content-center align-items-center">+</button>
                        <div class="card-body">
                            <p class="card-text text-muted m-0">Category</p>
                            <h5 class="card-title my-2">Beef And Mushroom Pizza</h5>
                            <p class="card-text text-muted m-0">Beef and cheese on a thin crust Pizza</p>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div>
                                    <span class="proprice">₱103</span>
                                    <span class="pricebefore small">₱103</span>
                                </div>
                                <span class="prolikes small"><i class="fa-solid fa-heart"></i> 189</span>
                            </div>                          
                            <div class="m-0">
                                <span class="opennow">Popular</span>
                                <span class="discount">10% off</span>
                                <span class="newopen">New</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="category1">
        <h5>Category 1</h5>
    </section>

    <section id="category2">
        <h5>Category 2</h5>
    </section>
    
    <section id="category3">
        <h5>Category 3</h5>
    </section>
    <script src="assets/js/navigation.js?v=<?php echo time(); ?>"></script>

    <br><br>
</main>
<?php
    include_once './footer.php'; 
?>