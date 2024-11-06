<?php
    include_once 'links.php'; 
    include_once 'secondheader.php'; 
?>
<style>
    .pageinfo{
        background-color: white;
        padding: 20px 120px;
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

    /*
    Color Palette:
    #CD5C08
    #FFF5E4
    #C1D8C3
    #6A9C89
    */
</style>
<main>
    <div class="pageinfo">
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
        <div>
            <div>
                <a href=""></a>
            </div>
        </div>
    </div>
</main>
<?php
    include_once './footer.php'; 
?>