<?php
    include_once 'links.php'; 
    include_once 'modals.php'; 
    include_once 'header.php'; 
    include_once 'nav.php'; 
?>
<style>
        /*    
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

<!-- IF ACTIVATED
    <button class="addpro " onclick="window.location.href='centralizedcash.php';"><i class="fa-regular fa-hand-pointer me-2"></i>Centralized Cash Payment</button>
    <div class="mt-5">
        <span class="fw-bold">What is Centralized Cash Payment?</span>
        <p class="m-0 mt-3 mb-5">Centralized cash payment allows customers to make a single cash transaction for orders from mlitiple stalls at the food park. Instead of visiting each stall to pay, they can settle everything at one central cashier.</p>
        <span class="fw-bold">Why Activate?</span>
        <ul class="mt-3 mb-5">
            <li>Reduce long queues at individual stalls, as customers pay once.</li>
            <li>Simplify the checkout experience for customers, making their visit more enjoyable.</li>
            <li>Focus more on preparing orders and less on handling payments.</li>
        </ul>
    </div>
    <div class="bg-white rounded-2 border p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 fw-bold ms-3">Cashier Management</h5>
            <span class="me-3 py-1 px-2 rounded-5 salesdr" style="color: #CD5C08;"><i class="fa-solid fa-circle-plus me-2"></i>Add Cashier</span>
        </div>
        <table class="salestable w-100 text-center">
            <tr>
                <th class="pt-2 px-3 text-start">Name</th>
                <th class="pt-2 px-3">Shift Start Time</th>
                <th class="pt-2 px-3">Shift End Time</th>
                <th class="pt-2 px-3">Status</th>
                <th class="pt-2 px-3">Total Transaction Processed</th>
                <th class="pt-2 px-3">Total Amount Collected</th>
                <th class="pt-2 px-3">Action</th>
            </tr>
            <tr>
                <td class="p-3 text-start">Naila Haliluddin</td>
                <td class="p-3">7:00 AM</td>
                <td class="p-3">1:00 PM</td>
                <td class="p-3">Online</td>
                <td class="p-3">30</td>
                <td class="p-3">₱12,500.00</td>
                <td class="p-3"><i class="fa-solid fa-ellipsis"></i></td>
            </tr>
            <tr>
                <td class="p-3 text-start">Naila Haliluddin</td>
                <td class="p-3">7:00 AM</td>
                <td class="p-3">1:00 PM</td>
                <td class="p-3">Online</td>
                <td class="p-3">30</td>
                <td class="p-3">₱12,500.00</td>
                <td class="p-3"><i class="fa-solid fa-ellipsis"></i></td>
            </tr>

        </table>
    </div> -->

    <br><br><br><br>
</main>
<?php
    include_once 'footer.php'; 
?>