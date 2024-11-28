<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
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
    <div class="w-100 border rounded-2 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 fw-bold">Transaction History</h5>
            <div class="d-flex align-items-center text-muted small gap-4">
                <select name="sortOptions" id="sortOptions" class="border-0 text-muted small py-1 px-2">
                    <option value="all">All Transaction</option>
                </select>
                <i class="fa-regular fa-circle-down rename"></i>
                <div class="d-flex gap-2 align-items-center small rename py-1 px-2">
                    <span style="cursor: context-menu;">47s</span>
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </div>
                <i class="fa-solid fa-magnifying-glass rename"></i>
            </div>
        </div>
        <table class="salestable w-100 text-center rounded-2 border">
            <tr>
                <th class="pt-2">Food Stall</th>
                <th class="pt-2">Date</th>
                <th class="pt-2">Amount Paid</th>
                <th class="pt-2">Period Cover</th>
                <th class="pt-2">Payment Method</th>
                <th class="pt-2">Action</th>
            </tr>
            <tr>
                <td class="fw-normal py-3">Food Stall Name</td>
                <td class="fw-normal py-3">07/29/2024 22:59</td>
                <td class="fw-normal py-3">₱100</td>
                <td class="fw-normal py-3">30 Days</td>
                <td class="fw-normal py-3">Cash</td>
                <td class="fw-normal py-3 tabact">
                    <i class="fa-solid fa-pen-to-square me-2 p-1 small rounded-1" data-bs-toggle="modal" data-bs-target="#editpayment"></i>
                    <i class="fa-solid fa-trash p-1 small rounded-1" onclick="if (confirm('Are you sure you want to delete this payment?')) deletePayment();"></i>
                </td>
            </tr>
            <tr>
                <td class="fw-normal py-3">Food Stall Name</td>
                <td class="fw-normal py-3">07/29/2024 22:59</td>
                <td class="fw-normal py-3">₱100</td>
                <td class="fw-normal py-3">30 Days</td>
                <td class="fw-normal py-3">Cash</td>
                <td class="fw-normal py-3 tabact">
                    <i class="fa-solid fa-pen-to-square me-2 p-1 small rounded-1" data-bs-toggle="modal" data-bs-target="#editpayment"></i>
                    <i class="fa-solid fa-trash p-1 small rounded-1" onclick="if (confirm('Are you sure you want to delete this payment?')) deletePayment();"></i>
                </td>
            </tr>
            <tr>
                <td class="fw-normal py-3">Food Stall Name</td>
                <td class="fw-normal py-3">07/29/2024 22:59</td>
                <td class="fw-normal py-3">₱100</td>
                <td class="fw-normal py-3">30 Days</td>
                <td class="fw-normal py-3">Cash</td>
                <td class="fw-normal py-3 tabact">
                    <i class="fa-solid fa-pen-to-square me-2 p-1 small rounded-1" data-bs-toggle="modal" data-bs-target="#editpayment"></i>
                    <i class="fa-solid fa-trash p-1 small rounded-1" onclick="if (confirm('Are you sure you want to delete this payment?')) deletePayment();"></i>
                </td>
            </tr>
            
        </table>
    </div>

</main

