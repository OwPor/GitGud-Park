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
</style>
<main>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-3 align-items-center">
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2 bg-white">
                <option value="all">All</option>
            </select>
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2 bg-white">
                <option value="all">All</option>
            </select>
            <i class="fa-regular fa-circle-down rename bg-white"></i>
            <div class="d-flex gap-2 align-items-center small rename py-1 px-2 bg-white">
                <span style="cursor: context-menu;">47s</span>
                <i class="fa-solid fa-arrow-rotate-left"></i>
            </div>
            <form action="#" method="get" class="searchmenu bg-white">
                <button type="submit"><i class="fas fa-search fa-lg small"></i></button>
                <input type="text" name="search" placeholder="Search">
            </form>
        </div>
        <button class="addpro" type="button" data-bs-toggle="modal" data-bs-target="#invitestall">+ Add Stall</button>
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