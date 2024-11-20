<?php
    include_once 'links.php'; 
    include_once 'secondheader.php'; 
?>
<style>
   /* #CD5C08
#FFF5E4
#C1D8C3
#6A9C89
*/
</style>
<main>
    <div class="d-flex">
        <div class="p-4" style="background-color: #f4f4f4; width: 25%">
            <div class="d-flex align-items-center bg-white rounded-2 border">
                <div class="border-end p-3">
                    <span class="small text-muted">Order ID</span>
                    <h2 class="fw-bold m-0" style="color: #CD5C08;">0000</h2>
                </div>
                <div class="p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="small text-muted">Total Price:</span>
                        <h6 class="fw-bold m-0">₱103</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted">Time Ordered:</span>
                        <h6 class="fw-bold m-0" style="color: #6A9C89;">01:00 PM</h6>
                    </div>
                </div>
            </div>
        </div>
        <style>
              /* #CD5C08
                #FFF5E4
                #C1D8C3
                #6A9C89
                */
            .centable th{
                border: 2px white solid;
                background-color: #C1D8C3;
                color: #6A9C89;
            }
            .centable td{
                border-bottom: 1px solid #ddd;
            }

        </style>
        <div class="w-75 bg-white p-4 mx-auto rounded">
            <h4 class="mb-3">Stall 1</h4>
            <table class="table table-borderless align-middle centable">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="assets/images/example.jpg" alt="Product Image" class="img-fluid rounded" style="width: 50px; height: 50px;">
                        </td>
                        <td>turon ni bai</td>
                        <td>3</td>
                        <td>₱112.00</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Total</td>
                        <td>₱66.55</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</main>

