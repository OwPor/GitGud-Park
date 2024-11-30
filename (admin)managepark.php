<?php 
    include_once 'links.php'; 
    /*include_once 'header.php'; 
    include_once 'nav.php'; */
    include_once 'modals.php'; 
?>
<style>
    main{
        padding: 10px 120px;
    }
</style>
<main>
    <div class="row row-cols-1 row-cols-md-3 g-3">
        <div class="col">
            <div class="text-center p-3 bg-white border rounded-2">
                <div class="profile-picture" data-bs-toggle="modal" data-bs-target="#editfoodpark">
                    <img src="assets/images/stall1.jpg" alt="Profile Picture" class="profile-img rounded-5">
                    <div class="camera-overlay">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <h4 class="fw-bold m-0 mb-2 mt-3">Food Park Name</h4>
                <span class="text-muted">Amethyst St. Johnston Subd. San Jose Rd. 7000 Zamboanga City, Philippines</span>
                <div class="d-flex gap-2 text-muted align-items-center justify-content-center my-2">
                    <span><i class="fa-solid fa-envelope"></i> example@gmail.com</span>
                    <span class="dot"></span>
                    <span><i class="fa-solid fa-phone small"></i> +639554638281</span>
                </div>
                <p class="text-muted m-0 mb-2" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#moreparkinfo">More about this park <span class="text-dark fw-bold">...more</span></p>
                <button class="variation-btn addrem m-2" data-bs-toggle="modal" data-bs-target="#editfoodpark">Edit Park</button>
                <button class="variation-btn addrem" data-bs-toggle="modal" data-bs-target="#deletepark">Delete Park</button>
            </div>
        </div>
        <div class="col">
            <div class="text-center p-3 bg-white border rounded-2">
                <div class="profile-picture" data-bs-toggle="modal" data-bs-target="#editfoodpark">
                    <img src="assets/images/stall1.jpg" alt="Profile Picture" class="profile-img rounded-5">
                    <div class="camera-overlay">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <h4 class="fw-bold m-0 mb-2 mt-3">Food Park Name</h4>
                <span class="text-muted">Amethyst St. Johnston Subd. San Jose Rd. 7000 Zamboanga City, Philippines</span>
                <div class="d-flex gap-2 text-muted align-items-center justify-content-center my-2">
                    <span><i class="fa-solid fa-envelope"></i> example@gmail.com</span>
                    <span class="dot"></span>
                    <span><i class="fa-solid fa-phone small"></i> +639554638281</span>
                </div>
                <p class="text-muted m-0 mb-2" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#moreparkinfo">More about this park <span class="text-dark fw-bold">...more</span></p>
                <button class="variation-btn addrem m-2" data-bs-toggle="modal" data-bs-target="#editfoodpark">Edit Park</button>
                <button class="variation-btn addrem">Delete Park</button>
            </div>
        </div>
        <div class="col">
            <div class="text-center p-3 bg-white border rounded-2">
                <div class="profile-picture" data-bs-toggle="modal" data-bs-target="#editfoodpark">
                    <img src="assets/images/stall1.jpg" alt="Profile Picture" class="profile-img rounded-5">
                    <div class="camera-overlay">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <h4 class="fw-bold m-0 mb-2 mt-3">Food Park Name</h4>
                <span class="text-muted">Amethyst St. Johnston Subd. San Jose Rd. 7000 Zamboanga City, Philippines</span>
                <div class="d-flex gap-2 text-muted align-items-center justify-content-center my-2">
                    <span><i class="fa-solid fa-envelope"></i> example@gmail.com</span>
                    <span class="dot"></span>
                    <span><i class="fa-solid fa-phone small"></i> +639554638281</span>
                </div>
                <p class="text-muted m-0 mb-2" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#moreparkinfo">More about this park <span class="text-dark fw-bold">...more</span></p>
                <button class="variation-btn addrem m-2" data-bs-toggle="modal" data-bs-target="#editfoodpark">Edit Park</button>
                <button class="variation-btn addrem">Delete Park</button>
            </div>
        </div>
    </div> 
    <br><br><br><br><br>
</main>

<?php 
    include_once 'footer.php'; 
?>