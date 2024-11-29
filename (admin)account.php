<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'modals.php'; 
    /*include_once 'nav.php'; */
?>
<style>
    main{
        padding: 20px 120px;
    }

/*
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
</style>

<main>
    <div class="w-100 border rounded-2 p-3 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="small py-1 px-2 rounded-5 salesdr" style="color: #CD5C08;" data-bs-toggle="modal" data-bs-target="#adduser">+ Add New User</span>
            <div class="d-flex align-items-center text-muted small gap-4">
                <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2">
                    <option value="all">All</option>
                </select>
                <i class="fa-regular fa-circle-down rename"></i>
                <div class="d-flex gap-2 align-items-center small rename py-1 px-2">
                    <span style="cursor: context-menu;">47s</span>
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </div>
                <form action="#" method="get" class="searchmenu">
                    <button type="submit"><i class="fas fa-search fa-lg small"></i></button>
                    <input type="text" name="search" placeholder="Search account">
                </form>
            </div>
        </div>
        <style>
            .salestable th{
                padding-top: 10px;
                width: 10%;
            }
            .dropdown-menu-center {
                left: 50% !important;
                transform: translateX(-50%) !important;
            }
        </style>
        <table class="salestable w-100 text-center rounded-2 border">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Birthday</th>
                <th>Sex</th>
                <th>Status</th>
                <th>Role</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            <tr>
                <td class="fw-normal small py-3 px-4">Naila</td>
                <td class="fw-normal small py-3 px-4">Haliluddin</td>
                <td class="fw-normal small py-3 px-4">example@gmail.com</td>
                <td class="fw-normal small py-3 px-4">+639123456789</td>
                <td class="fw-normal small py-3 px-4">12/04/2003</td>
                <td class="fw-normal small py-3 px-4">Female</td>
                <td class="fw-normal small py-3 px-4">Active</td>
                <td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-success border border-success p-1 border-2 fw-bold">Customer</span></td>
                <td class="fw-normal small py-3 px-4">07/29/2024</td>
                <td class="fw-normal small py-3 px-4">
                    <div class="dropdown position-relative">
                        <i class="fa-solid fa-ellipsis small rename py-1 px-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                        <ul class="dropdown-menu dropdown-menu-center p-0" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edituser">Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteuser">Delete</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deactivateuser">Deactivate</a></li>
                            <li><a class="dropdown-item" href="#">Activity</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="fw-normal small py-3 px-4">Naila</td>
                <td class="fw-normal small py-3 px-4">Haliluddin</td>
                <td class="fw-normal small py-3 px-4">example@gmail.com</td>
                <td class="fw-normal small py-3 px-4">+639123456789</td>
                <td class="fw-normal small py-3 px-4">12/04/2003</td>
                <td class="fw-normal small py-3 px-4">Female</td>
                <td class="fw-normal small py-3 px-4">Active</td>
                <td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-warning border border-warning py-1 px-2 border-2 fw-bold">Park</span></td>
                <td class="fw-normal small py-3 px-4">07/29/2024</td>
                <td class="fw-normal small py-3 px-4">
                    <div class="dropdown position-relative">
                        <i class="fa-solid fa-ellipsis small rename py-1 px-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                        <ul class="dropdown-menu dropdown-menu-center p-0" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edituser">Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteuser">Delete</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deactivateuser">Deactivate</a></li>
                            <li><a class="dropdown-item" href="#">Activity</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="fw-normal small py-3 px-4">Naila</td>
                <td class="fw-normal small py-3 px-4">Haliluddin</td>
                <td class="fw-normal small py-3 px-4">example@gmail.com</td>
                <td class="fw-normal small py-3 px-4">+639123456789</td>
                <td class="fw-normal small py-3 px-4">12/04/2003</td>
                <td class="fw-normal small py-3 px-4">Female</td>
                <td class="fw-normal small py-3 px-4">Active</td>
                <td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-danger border border-danger py-1 px-2 border-2 fw-bold">Stall</span></td>
                <td class="fw-normal small py-3 px-4">07/29/2024</td>
                <td class="fw-normal small py-3 px-4">
                    <div class="dropdown position-relative">
                        <i class="fa-solid fa-ellipsis small rename py-1 px-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                        <ul class="dropdown-menu dropdown-menu-center p-0" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edituser">Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteuser">Delete</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deactivateuser">Deactivate</a></li>
                            <li><a class="dropdown-item" href="#">Activity</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            
        </table>
        <div class="d-flex gap-3 saletabpag align-items-center justify-content-center mt-3">
            <!-- Pagination will be dynamically generated -->
        </div>
        <script src="assets/js/pagination.js?v=<?php echo time(); ?>"></script>
    </div>
    <script src="assets/js/activate.js?v=<?php echo time(); ?>"></script>
</main>
<?php
    include_once 'footer.php'; 
?>

