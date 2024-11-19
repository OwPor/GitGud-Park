<?php
    include_once 'links.php'; 
    include_once 'modals.php'; 
    /*include_once 'header.php'; 
    include_once 'nav.php'; */
?>
<style>
    /*     .variationette:
        #CD5C08
        #FFF5E4
        #C1D8C3
        #6A9C89
        */
    main{
        padding: 20px 120px;
    }
    .cenact{
        color: #CD5C08;
        border: 1px #CD5C08 solid;
    }
</style>
<main>
    <div class="cenact d-flex justify-content-between align-items-center bg-white p-4 mb-5">
        <div style="width: 70%;">
            <h4 class="fw-bold">Centralized Cash Payment</h4>
            <p class="m-0">Enhance your customer's experience with a smoother, faster payment process. Give them the convenience of paying for all their orders in one go.</p>
        </div>
        <button class="addpro px-5" onclick="window.location.href='cenactivate.php';">Activate</button>
        </div>
    <div>
        <span class="fw-bold">What is Centralized Cash Payment?</span>
        <p class="m-0 mt-3 mb-5">Centralized cash payment allows customers to make a single cash transaction for orders from mlitiple stalls at the food park. Instead of visiting each stall to pay, they can settle everything at one central cashier.</p>
        <span class="fw-bold">Why Activate?</span>
        <ul class="mt-3 mb-5">
            <li>Reduce long queues at individual stalls, as customers pay once.</li>
            <li>Simplify the checkout experience for customers, making their visit more enjoyable.</li>
            <li>Focus more on preparing orders and less on handling payments.</li>
        </ul>
    </div>
    <br><br><br><br>
</main>
<?php
    include_once 'footer.php'; 
?>