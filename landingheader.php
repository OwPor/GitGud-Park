<?php
    require_once __DIR__ . '/classes/db.class.php';
    $userObj = new User();

    if (isset($_SESSION['user'])) 
        $user = $userObj->getUser($_SESSION['user']['id']);
    
?>
<div class="bottom d-flex justify-content-between align-items-center">
    <a href="index.php"><img src="assets/images/logo.png" alt="GitGud"></a>
    <div class="dropdown position-relative">
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="text-decoration-none text-dark">
            <img src="assets/images/profile.jpg" alt="Profile Image"> 
            <span class="ms-1"><?php $user['full_name'] ?? '' ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-center p-0 mt-2" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            <li><a class="dropdown-item" href="(admin)manageaccount.php"><i class="fa-regular fa-user me-2"></i> Manage Accounts</a></li>
            <li><a class="dropdown-item" href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout</a></li>
        </ul>
    </div>
</div> 