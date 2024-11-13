<?php
    include_once 'links.php'; 
?>
<style>
    .indicator ul{
        display: flex;
        justify-content: center;
        gap: 50px;
        padding: 0 120px;
    }
    .indicator ul li{
        color: #bbbbbb;
        padding: 18px 5px;
        font-size: 15px;
    }
    .indicator ul li:hover{
        color: black;
    }
    .indicator ul .active{
        color: black;
        border-bottom: 2px black solid;
    }
</style>
<nav class="indicator">
    <ul>
        <li class="active">ORDERS</li>
        <li>STALL PAGE</li>
        <li>INVENTORY</li>
        <li>SALES</li>
        <li>PURCHASE</li>
        <li>FAVORITES</li>
        <li>ACCOUNT</li>
    </ul>
</nav>