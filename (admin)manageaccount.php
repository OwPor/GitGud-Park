<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'modals.php'; 
    /*include_once 'nav.php'; */
    require_once __DIR__ . '/classes/admin.class.php';
    $adminObj = new Admin();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    main{
        padding: 20px 120px;
    }
    .salestable th{
        padding-top: 10px;
        width: 10%;
    }
    .dropdown-menu-center {
        left: 50% !important;
        transform: translateX(-50%) !important;
    }
    .acchead a{
        text-decoration: none;
        color: black;
        margin-bottom: 8px;
    }

/*
#CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
</style>

<main>
    <div class="nav-container d-flex gap-3 my-2">
        <a href="#all" class="nav-link" data-target="all">Accounts</a>
        <a href="#applications" class="nav-link" data-target="applications">Applications</a>
        <a href="#reports" class="nav-link" data-target="reports">Reports</a>
    </div>

    <div id="all" class="w-100 border rounded-2 p-3 bg-white section-content">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="fw-bold mb-2">Manage Accounts</h5>
                <span class="small">November 03, 2024 8:40 AM</span>
            </div>
            <button class="disatc m-0 small" data-bs-toggle="modal" data-bs-target="#adduser">+ Add User</button>
        </div>
        <div class="d-flex align-items-center text-muted small gap-4 mt-2 mb-3">
            <form action="#" method="get" class="searchmenu rounded-2">
                <input type="text" name="search" placeholder="Search account" style="width: 230px;">
                <button type="submit" class="m-0 ms-2"><i class="fas fa-search fa-lg small"></i></button>
            </form>
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2">
                <option value="all">All</option>
            </select>
            <i class="fa-regular fa-circle-down rename"></i>
            <div class="d-flex gap-2 align-items-center small rename py-1 px-2">
                <span style="cursor: context-menu;">47s</span>
                <i class="fa-solid fa-arrow-rotate-left"></i>
            </div>
        </div>
        <table class="salestable w-100 text-center border-top">
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
            <?php
                $users = $adminObj->getUsers();

                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['first_name']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['last_name']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['email']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['phone']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['birth_date']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['sex']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['status']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-success border border-success p-1 border-2 fw-bold">' . htmlspecialchars($user['role']) . '</span></td>';
                    echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($user['created_at']) . '</td>';
                    echo '<td class="fw-normal small py-3 px-4">';
                    echo '<div class="dropdown position-relative">';
                    echo '<i class="fa-solid fa-ellipsis small rename py-1 px-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>';
                    echo '<ul class="dropdown-menu dropdown-menu-center p-0" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">';
                    echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edituser">Edit</a></li>';
                    echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteuser">Delete</a></li>';
                    echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deactivateuser">Deactivate</a></li>';
                    echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#activitylog">Activity</a></li>';
                    echo '<li><a class="dropdown-item" href="parkregistration.php">Create Park</a></li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
            <!-- <tr>
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
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#activitylog">Activity</a></li>
                            <li><a class="dropdown-item" href="parkregistration.php">Create Park</a></li>
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
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#activitylog">Activity</a></li>
                            <li><a class="dropdown-item" href="parkregistration.php">Create Park</a></li>
                        </ul>
                    </div>
                </td>
            </tr> -->
            
        </table>
        <div class="d-flex gap-3 saletabpag align-items-center justify-content-center mt-3">
            <!-- Pagination will be dynamically generated -->
        </div>
    </div>

    <div id="applications" class="w-100 border rounded-2 p-3 bg-white section-content">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="fw-bold mb-2">Applications</h5>
                <span class="small">November 03, 2024 8:40 AM</span>
            </div>
        </div>
        <div class="d-flex align-items-center text-muted small gap-4 mt-2 mb-3">
            <form action="#" method="get" class="searchmenu rounded-2">
                <input type="text" name="search" placeholder="Search account" style="width: 230px;">
                <button type="submit" class="m-0 ms-2"><i class="fas fa-search fa-lg small"></i></button>
            </form>
            <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2">
                <option value="all">All</option>
            </select>
            <i class="fa-regular fa-circle-down rename"></i>
            <div class="d-flex gap-2 align-items-center small rename py-1 px-2">
                <span style="cursor: context-menu;">47s</span>
                <i class="fa-solid fa-arrow-rotate-left"></i>
            </div>
        </div>
        <table class="salestable w-100 text-center border-top">
            <tr>
                <th style="width: 17%;">Owner</th>
                <th style="width: 18%;">Business Name</th>
                <th style="width: 25%;">Location</th>
                <th style="width: 10%;">Other Info</th>
                <th style="width: 10%;">Date Applied</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Action</th>
            </tr>

            <?php
                $getBusinesses = $adminObj->getBusinesses();

                foreach ($getBusinesses as $business) {
                    $status = '';
                    if (htmlspecialchars($business['business_status']) == 'Pending Approval') {
                        $status = 'Pending';
                    
                        echo '<tr>';
                        echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($business['business_name']) . '</td>';
                        echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($business['business_type']) . '</td>';
                        echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($business['region_province_city']) . htmlspecialchars($business['barangay']) . htmlspecialchars($business['street_building_house']) . '</td>';
                        echo '<td class="fw-normal small py-3 px-4"><i class="fa-solid fa-chevron-down rename small" data-bs-toggle="modal" data-bs-target="#moreparkinfo"></i></td>';
                        echo '<td class="fw-normal small py-3 px-4">' . htmlspecialchars($business['created_at']) . '</td>';
                        echo '<td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-warning border border-warning p-1 border-2 fw-bold">' . $status . '</span></td>';
                        echo '<td class="fw-normal small py-3 px-4">';
                        echo '<div class="d-flex gap-2 justify-content-center">';
                        echo '<button class="approve-btn bg-success text-white border-0 small py-1 rounded-1" data-id="' . htmlspecialchars($business['id']) . '" style="width:60px">Approve</button>';
                        echo '<button class="deny-btn bg-danger text-white border-0 small py-1 rounded-1" data-id="' . htmlspecialchars($business['id']) . '" style="width:60px">Deny</button>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
            ?>

            <!-- <tr>
                <td class="fw-normal small py-3 px-4">Athena Maia Casino</td>
                <td class="fw-normal small py-3 px-4">Amethyst Food Park</td>
                <td class="fw-normal small py-3 px-4">Unit, Building, Street, Barangay, Zamboanga</td>
                <td class="fw-normal small py-3 px-4"><i class="fa-solid fa-chevron-down rename small" data-bs-toggle="modal" data-bs-target="#moreparkinfo"></i></td>
                <td class="fw-normal small py-3 px-4">07/29/2024</td>
                <td class="fw-normal small py-3 px-4"><span class="small rounded-5 text-warning border border-warning p-1 border-2 fw-bold">Pending</span></td>
                <td class="fw-normal small py-3 px-4">
                    <div class="d-flex gap-2 justify-content-center">
                        <button class="bg-success text-white border-0 small py-1 rounded-1" style="width:60px">Approve</button>
                        <button class="bg-danger text-white border-0 small py-1 rounded-1" style="width:60px">Deny</button>
                    </div>
                </td>
            </tr> -->
           
        </table>
        <div class="d-flex gap-3 saletabpag align-items-center justify-content-center mt-3">
            <!-- Pagination will be dynamically generated -->
        </div>
    </div>

    <script src="assets/js/navigation.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/pagination.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/activate.js?v=<?php echo time(); ?>"></script>
    <script src="assets/js/adminresponse.js"></script>

    <br><br><br><br>
</main>
<?php
    include_once 'footer.php'; 
?>

