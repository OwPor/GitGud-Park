<?php 
    include_once 'links.php'; 
?>
<style>
    .bottom{
        padding: 10px 120px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    a{
        color: #CD5C08;
        text-decoration: none;
    }
</style>
<div class="bottom d-flex justify-content-between align-items-center">
    <img src="assets/images/logo.png" alt="">
    <?php 
        if (isset($SESSION['user']['id']))
            echo '<a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>';
    ?>

    <?php 
        echo '<a href="index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Back</a>';
    ?>
</div> 