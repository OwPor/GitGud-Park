<?php
    include_once 'links.php'; 

    $current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
    .indicator {
        display: flex;
        justify-content: center;
        gap: 50px;
        padding: 0 120px;
    }
    .indicator a {
        color: #bbbbbb;
        padding: 18px 5px;
        font-size: 15px;
        text-decoration: none;
    }
    .indicator a:hover {
        color: black;
    }
    .indicator a.active {
        color: black;
        border-bottom: 2px black solid;
    }
</style>
<nav class="indicator">
    <a href="managestall.php" class="<?= $current_page == 'managestall.php' ? 'active' : '' ?>">MANAGE STALL</a>
    <a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">DASHBOARD</a>
    <a href="centralized.php" class="<?= $current_page == 'centralized.php' ? 'active' : '' ?>">CENTRALIZED</a>
    <a href="orders.php" class="<?= $current_page == 'orders.php' ? 'active' : '' ?>">ORDERS</a>
    <a href="stallpage.php" class="<?= $current_page == 'stallpage.php' ? 'active' : '' ?>">STALL PAGE</a>
    <a href="managemenu.php" class="<?= $current_page == 'managemenu.php' ? 'active' : '' ?>">MANAGE MENU</a>
    <a href="choicegroup.php" class="<?= $current_page == 'choicegroup.php' ? 'active' : '' ?>">CHOICE GROUP</a>
    <a href="sales.php" class="<?= $current_page == 'sales.php' ? 'active' : '' ?>">SALES</a>
    <a href="purchase.php" class="<?= $current_page == 'purchase.php' ? 'active' : '' ?>">PURCHASE</a>
    <a href="favorites.php" class="<?= $current_page == 'favorites.php' ? 'active' : '' ?>">FAVORITES</a>
    <a href="account.php" class="<?= $current_page == 'account.php' ? 'active' : '' ?>">ACCOUNT</a>
</nav>
