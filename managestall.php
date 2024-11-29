<?php 
    include_once 'links.php'; 
    /*include_once 'header.php'; 
    include_once 'nav.php'; */
    include_once 'bootstrap.php'; 
    include_once 'modals.php'; 
?>
<style>
    main{
        padding: 10px 120px;
    }
    .select2-selection__choice__remove{
    font-size: 20px;
    margin-left: 10px;
    }
    .select2-selection {
    padding: 10px;
    }
    .select2-selection__choice {
    display: flex;
    align-items: center;
    flex-direction: row-reverse;
    background-color: #f8f8f8 !important; 
    border: 1px solid #ccc; 
    padding: 0 10px !important;
    border-radius: 30px !important; 
    margin: 4px !important;
    }

    .select2-selection__choice img,
    .select2-results__option img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin: 0;
    border: 1px solid #ccc; 
    margin-right: 7px;
    }
    .select2-selection__choice img{
    width: 25px;
    height: 25px;
    margin-right: 5px;
    }

    .select2-results__option{
    padding: 7px 15px;
    background-color: white !important;
    color: black !important;
    }
    .select2-results__option--highlighted{
    background-color: #e0e0e0 !important;
    }
</style>
<main>
    <div class="dropdown d-flex justify-content-end">
        <button class="addpro mb-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">+ Add Stall</button>
        <ul class="dropdown-menu dropdown-menu-end p-0">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#invitestall"><i class="fa-solid fa-user-plus me-2"></i>Invite</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addowner"><i class="fa-solid fa-plus me-2"></i>Manual</a></li>
        </ul>
    </div>

    <!-- Invite Stall Modal -->
    <div class="modal fade" id="invitestall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Invite Stall Owners</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="emailInput" name="emails[]" class="form-control select2" multiple="multiple" aria-label="Email input with profile circle">
                        </select>
                    </div>
                    <script src="assets/js/sendemail.js?v=<?php echo time(); ?>"></script>

                    <h6 class=" mb-3 mt-3 mt-1">People in your food park</h6>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin (you)</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Park Owner</i>
                    </div>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/profile.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Stall Owner</i>
                    </div>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/profile.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Stall Owner</i>
                    </div>
                </div>
                <div class="modal-footer pt-0 border-0 d-flex justify-content-between align-items-center">
                    <i class="fa-regular fa-circle-question ml-2" data-bs-toggle="tooltip" data-bs-placement="right" title="An email will be sent to them with an invitaion link to register their stall under your food park. Once they complete the registration, their stall will be added to your food park."></i>
                    <script>
                        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                    </script>
                    <button type="button" class="btn btn-primary send">SEND</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Owner Modal -->
    <div class="modal fade" id="addowner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Stall Owner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="addemailInput" name="emails[]" class="form-control select2" multiple="multiple" aria-label="Email input with profile circle">
                            <!-- Placeholder for dynamic email entry -->
                        </select>
                    </div>
                    <script src="assets/js/addowner.js?v=<?php echo time(); ?>"></script>

                    <h6 class=" mb-3 mt-3 mt-1">People in your food park</h6>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin (you)</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Park Owner</i>
                    </div>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/profile.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Stall Owner</i>
                    </div>
                    <div class="owner mt-1 py-1 px-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/profile.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted small mr-1">Stall Owner</i>
                    </div>
                </div>
                <div class="modal-footer pt-0 border-0 d-flex justify-content-between align-items-center">
                    <i class="fa-regular fa-circle-question ml-2" data-bs-toggle="tooltip" data-bs-placement="right" title="An email will be sent to them with an invitaion link to register their stall under your food park. Once they complete the registration, their stall will be added to your food park."></i>
                    <script>
                        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                    </script>
                    <button type="button" class="btn btn-primary send">SEND</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3">
        <div class="col">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="assets/images/stall1.jpg" class="card-img-top" alt="...">
                    <div class="position-absolute rentstatus paid"><i class="fa-solid fa-circle-check"></i> Paid: Rent for this period has been fully settled</div>
                    <div class="position-absolute d-flex gap-2 smaction">
                        <i class="fa-solid fa-sack-dollar" onclick="window.location.href='rent.php';"></i>
                        <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editpage.php';"></i>
                        <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deletestall"></i>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="d-flex gap-2 align-items-center">
                                <p class="card-text text-muted m-0">Category</p>
                                <span class="dot text-muted"></span>
                                <p class="card-text text-muted m-0">Category</p>
                            </div>
                            <h5 class="card-title my-2 fw-bold">Food Stall Name</h5>
                            <p class="card-text text-muted m-0">Description</p>
                        </div>
                        <div class="smopen">
                            <i class="fa-solid fa-clock"></i>
                            <span>OPEN</span>
                        </div>
                    </div>
                    <div class="stats py-2 mt-3 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-heart fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">Likes</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-lemon fs-5"></i>
                                <span class="fw-bold fs-4">668</span>
                            </div>
                            <p class="m-0 small">Orders</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-user fs-5"></i>
                                <span class="fw-bold fs-4">565</span>
                            </div>
                            <p class="m-0 small">Visits</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-solid fa-peseta-sign fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">AOV</p>
                        </div>
                    </div>

                    <div class="accordion accordion-flush" id="accCol1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col1flu1" aria-expanded="false" aria-controls="col1flu1">Contact information</button>
                            </h2>
                            <div id="col1flu1" class="accordion-collapse collapse" data-bs-parent="#accCol1">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Email</span>
                                        <span>example@gmail.com</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Business Phone Number</span>
                                        <span class="text-muted">+639123456789</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col1flu2" aria-expanded="false" aria-controls="col1flu2">Opening Hours</button>
                            </h2>
                            <div id="col1flu2" class="accordion-collapse collapse" data-bs-parent="#accCol1">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="mb-2">
                                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                                        <span>7AM - 7PM</span>
                                    </div>
                                    <div class="">
                                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                                        <span>8AM - 9PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col1flu3" aria-expanded="false" aria-controls="col1flu3">Payment Method</button>
                            </h2>
                            <div id="col1flu3" class="accordion-collapse collapse" data-bs-parent="#accCol1">
                                <div class="accordion-body p-0 mb-3 small">
                                    <ul>
                                        <li class="mb-2">Cash</li>
                                        <li>GCash</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner mt-1 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted">Owner</i>
                    </div>

                </div> 
            </div> 
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="assets/images/stall2.jpg" class="card-img-top" alt="...">
                    <div class="position-absolute rentstatus pending"><i class="fa-solid fa-hourglass-half"></i> Pending: Rent payment is due in 3 days</div>
                    <div class="position-absolute d-flex gap-2 smaction">
                        <i class="fa-solid fa-sack-dollar" onclick="window.location.href='rent.php';"></i>
                        <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editpage.php';"></i>
                        <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deletestall"></i>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="d-flex gap-2 align-items-center">
                                <p class="card-text text-muted m-0">Category</p>
                                <span class="dot text-muted"></span>
                                <p class="card-text text-muted m-0">Category</p>
                            </div>
                            <h5 class="card-title my-2 fw-bold">Food Stall Name</h5>
                            <p class="card-text text-muted m-0">Description</p>
                        </div>
                        <div class="smclose">
                            <i class="fa-solid fa-door-closed"></i>
                            <span>CLOSE</span>
                        </div>
                    </div>
                    <div class="stats py-2 mt-3 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-heart fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">Likes</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-lemon fs-5"></i>
                                <span class="fw-bold fs-4">668</span>
                            </div>
                            <p class="m-0 small">Orders</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-user fs-5"></i>
                                <span class="fw-bold fs-4">565</span>
                            </div>
                            <p class="m-0 small">Visits</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-solid fa-peseta-sign fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">AOV</p>
                        </div>
                    </div>

                    <div class="accordion accordion-flush" id="accCol2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col2flu1" aria-expanded="false" aria-controls="col2flu1">Contact information</button>
                            </h2>
                            <div id="col2flu1" class="accordion-collapse collapse" data-bs-parent="#accCol2">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Email</span>
                                        <span>example@gmail.com</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Business Phone Number</span>
                                        <span class="text-muted">+639123456789</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col2flu2" aria-expanded="false" aria-controls="col2flu2">Opening Hours</button>
                            </h2>
                            <div id="col2flu2" class="accordion-collapse collapse" data-bs-parent="#accCol2">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="mb-2">
                                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                                        <span>7AM - 7PM</span>
                                    </div>
                                    <div class="">
                                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                                        <span>8AM - 9PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col2flu3" aria-expanded="false" aria-controls="col2flu3">Payment Method</button>
                            </h2>
                            <div id="col2flu3" class="accordion-collapse collapse" data-bs-parent="#accCol2">
                                <div class="accordion-body p-0 mb-3 small">
                                    <ul>
                                        <li class="mb-2">Cash</li>
                                        <li>GCash</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner mt-1 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted">Owner</i>
                    </div>

                </div> 
            </div> 
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="assets/images/stall3.jpg" class="card-img-top" alt="...">
                    <div class="position-absolute rentstatus overdue"><i class="fa-solid fa-circle-exclamation"></i> Overdue: Rent payment is overdue by 4 days</div>
                    <div class="position-absolute d-flex gap-2 smaction">
                        <i class="fa-solid fa-sack-dollar" onclick="window.location.href='rent.php';"></i>
                        <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editpage.php';"></i>
                        <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deletestall"></i>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="d-flex gap-2 align-items-center">
                                <p class="card-text text-muted m-0">Category</p>
                                <span class="dot text-muted"></span>
                                <p class="card-text text-muted m-0">Category</p>
                            </div>
                            <h5 class="card-title my-2 fw-bold">Food Stall Name</h5>
                            <p class="card-text text-muted m-0">Description</p>
                        </div>
                        <div class="smopen">
                            <i class="fa-solid fa-clock"></i>
                            <span>OPEN</span>
                        </div>
                    </div>
                    <div class="stats py-2 mt-3 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-heart fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">Likes</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-lemon fs-5"></i>
                                <span class="fw-bold fs-4">668</span>
                            </div>
                            <p class="m-0 small">Orders</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-user fs-5"></i>
                                <span class="fw-bold fs-4">565</span>
                            </div>
                            <p class="m-0 small">Visits</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-solid fa-peseta-sign fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">AOV</p>
                        </div>
                    </div>

                    <div class="accordion accordion-flush" id="accCol3">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col3flu1" aria-expanded="false" aria-controls="col3flu1">Contact information</button>
                            </h2>
                            <div id="col3flu1" class="accordion-collapse collapse" data-bs-parent="#accCol3">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Email</span>
                                        <span>example@gmail.com</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Phone Number</span>
                                        <span class="text-muted">+639123456789</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Website</span>
                                        <span class="text-muted">asdfghjkl.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col3flu2" aria-expanded="false" aria-controls="col3flu2">Opening Hours</button>
                            </h2>
                            <div id="col3flu2" class="accordion-collapse collapse" data-bs-parent="#accCol3">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="mb-2">
                                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                                        <span>7AM - 7PM</span>
                                    </div>
                                    <div class="">
                                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                                        <span>8AM - 9PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col3flu3" aria-expanded="false" aria-controls="col3flu3">Payment Method</button>
                            </h2>
                            <div id="col3flu3" class="accordion-collapse collapse" data-bs-parent="#accCol3">
                                <div class="accordion-body p-0 mb-3 small">
                                    <ul>
                                        <li class="mb-2">Cash</li>
                                        <li>GCash</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner mt-1 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted">Owner</i>
                    </div>

                </div> 
            </div> 
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="assets/images/stall4.jpg" class="card-img-top" alt="...">
                    <div class="position-absolute rentstatus overdue"><i class="fa-solid fa-circle-exclamation"></i> Overdue: Rent payment is overdue by 4 days</div>
                    <div class="position-absolute d-flex gap-2 smaction">
                        <i class="fa-solid fa-sack-dollar" onclick="window.location.href='rent.php';"></i>
                        <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editpage.php';"></i>
                        <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deletestall"></i>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="d-flex gap-2 align-items-center">
                                <p class="card-text text-muted m-0">Category</p>
                                <span class="dot text-muted"></span>
                                <p class="card-text text-muted m-0">Category</p>
                            </div>
                            <h5 class="card-title my-2 fw-bold">Food Stall Name</h5>
                            <p class="card-text text-muted m-0">Description</p>
                        </div>
                        <div class="smopen">
                            <i class="fa-solid fa-clock"></i>
                            <span>OPEN</span>
                        </div>
                    </div>
                    <div class="stats py-2 mt-3 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-heart fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">Likes</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-lemon fs-5"></i>
                                <span class="fw-bold fs-4">668</span>
                            </div>
                            <p class="m-0 small">Orders</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-user fs-5"></i>
                                <span class="fw-bold fs-4">565</span>
                            </div>
                            <p class="m-0 small">Visits</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-solid fa-peseta-sign fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">AOV</p>
                        </div>
                    </div>

                    <div class="accordion accordion-flush" id="accCol4">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col4flu1" aria-expanded="false" aria-controls="col4flu1">Contact information</button>
                            </h2>
                            <div id="col4flu1" class="accordion-collapse collapse" data-bs-parent="#accCol4">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Email</span>
                                        <span>example@gmail.com</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Phone Number</span>
                                        <span class="text-muted">+639123456789</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Website</span>
                                        <span class="text-muted">asdfghjkl.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col4flu2" aria-expanded="false" aria-controls="col4flu2">Opening Hours</button>
                            </h2>
                            <div id="col4flu2" class="accordion-collapse collapse" data-bs-parent="#accCol4">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="mb-2">
                                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                                        <span>7AM - 7PM</span>
                                    </div>
                                    <div class="">
                                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                                        <span>8AM - 9PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col4flu3" aria-expanded="false" aria-controls="col4flu3">Payment Method</button>
                            </h2>
                            <div id="col4flu3" class="accordion-collapse collapse" data-bs-parent="#accCol4">
                                <div class="accordion-body p-0 mb-3 small">
                                    <ul>
                                        <li class="mb-2">Cash</li>
                                        <li>GCash</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner mt-1 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted">Owner</i>
                    </div>

                </div> 
            </div> 
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="position-relative">
                    <img src="assets/images/stall5.jpg" class="card-img-top" alt="...">
                    <div class="position-absolute rentstatus overdue"><i class="fa-solid fa-circle-exclamation"></i> Overdue: Rent payment is overdue by 4 days</div>
                    <div class="position-absolute d-flex gap-2 smaction">
                        <i class="fa-solid fa-sack-dollar" onclick="window.location.href='rent.php';"></i>
                        <i class="fa-solid fa-pen-to-square" onclick="window.location.href='editpage.php';"></i>
                        <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deletestall"></i>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="d-flex gap-2 align-items-center">
                                <p class="card-text text-muted m-0">Category</p>
                                <span class="dot text-muted"></span>
                                <p class="card-text text-muted m-0">Category</p>
                            </div>
                            <h5 class="card-title my-2 fw-bold">Food Stall Name</h5>
                            <p class="card-text text-muted m-0">Description</p>
                        </div>
                        <div class="smopen">
                            <i class="fa-solid fa-clock"></i>
                            <span>OPEN</span>
                        </div>
                    </div>
                    <div class="stats py-2 mt-3 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-heart fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">Likes</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-lemon fs-5"></i>
                                <span class="fw-bold fs-4">668</span>
                            </div>
                            <p class="m-0 small">Orders</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-regular fa-user fs-5"></i>
                                <span class="fw-bold fs-4">565</span>
                            </div>
                            <p class="m-0 small">Visits</p>
                        </div>
                        <div class="text-center">
                            <div class="d-flex gap-1 align-items-center m-0">
                                <i class="fa-solid fa-peseta-sign fs-5"></i>
                                <span class="fw-bold fs-4">56</span>
                            </div>
                            <p class="m-0 small">AOV</p>
                        </div>
                    </div>

                    <div class="accordion accordion-flush" id="accCol5">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col5flu1" aria-expanded="false" aria-controls="col5flu1">Contact information</button>
                            </h2>
                            <div id="col5flu1" class="accordion-collapse collapse" data-bs-parent="#accCol5">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Email</span>
                                        <span>example@gmail.com</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Business Phone Number</span>
                                        <span class="text-muted">+639123456789</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Website</span>
                                        <span class="text-muted">asdfghjkl.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col5flu2" aria-expanded="false" aria-controls="col5flu2">Opening Hours</button>
                            </h2>
                            <div id="col5flu2" class="accordion-collapse collapse" data-bs-parent="#accCol5">
                                <div class="accordion-body p-0 mb-3 small">
                                    <div class="mb-2">
                                        <p class="mb-1">Monday, Tuesday, Thursday</p>
                                        <span>7AM - 7PM</span>
                                    </div>
                                    <div class="">
                                        <p class="mb-1">Wednesday, Friday, Saturday</p>
                                        <span>8AM - 9PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0" type="button" data-bs-toggle="collapse" data-bs-target="#col5flu3" aria-expanded="false" aria-controls="col5flu3">Payment Method</button>
                            </h2>
                            <div id="col5flu3" class="accordion-collapse collapse" data-bs-parent="#accCol5">
                                <div class="accordion-body p-0 mb-3 small">
                                    <ul>
                                        <li class="mb-2">Cash</li>
                                        <li>GCash</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner mt-1 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="assets/images/user.jpg" alt="">
                            <div>
                                <span class="fw-bold">Naila Haliluddin</span>
                                <p class="m-0">example@gmail.com</p>
                            </div>
                        </div>
                        <i class="text-muted">Owner</i>
                    </div>

                </div> 
            </div> 
        </div>
    </div> 
    <br><br><br><br><br>
</main>

<?php 
    include_once 'footer.php'; 
?>