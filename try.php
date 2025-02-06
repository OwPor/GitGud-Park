<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
   
    if (isset($_GET['id'])) {
        $stall_id = intval($_GET['id']); 
        
        $stall = $parkObj->getStall($park_id); 
    }
?>
    <div class="pageinfo pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4 align-items-center pagelogo">
                <img src="<?= $stall['logo'] ?>">
                <div>
                    <div class="d-flex gap-2 align-items-center">
                        <?php 
                            $stall_categories = explode(',', $stall['stall_categories']); 
                            foreach ($stall_categories as $index => $category) { 
                        ?>
                            <p class="card-text text-muted m-0"><?= trim($category) ?></p>
                            <?php if ($index !== array_key_last($stall_categories)) { ?>
                                <span class="dot text-muted"></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <h5 class="my-2 fw-bold fs-2"><?= $stall['name'] ?></h5>
                    <p class="text-muted m-0"><?= $stall['description'] ?></p>

                    <div class="d-flex gap-2 align-items-center my-2">
                        <span class="pageon">Open now</span>
                        <span class="dot text-muted"></span>
                        <button class="conopepay" data-bs-toggle="modal" data-bs-target="#morestallinfo"
                            data-email="<?= htmlspecialchars($stall['email']) ?>"
                            data-phone="<?= htmlspecialchars($stall['phone']) ?>"
                            data-hours="<?= htmlspecialchars($stall['stall_operating_hours']) ?>"
                            data-payment-methods="<?= htmlspecialchars($stall['stall_payment_methods']) ?>">
                            <i class="fa-solid fa-circle-info"></i> More info
                        </button>
                    </div>

                    <div class="d-flex gap-5 m-0">
                        <div class="d-flex gap-2">
                            <span>Likes</span>
                            <span class="likpro">999</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>Products</span>
                            <span class="likpro"><?php echo $totalProducts; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="pagelike">Like</button>
        </div>
    </div>


<!-- More stall info -->
<div class="modal fade" id="morestallinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0">More Info</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="fw-bold mb-3">Business Contact</h5>
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Business Email</span>
                        <span data-email></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Business Phone Number</span>
                        <span data-phone>+639123456789</span>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Operating Hours</h5>
                <div class="mb-4" data-hours>
                    <!-- Dynamically added operating hours -->
                </div>

                <h5 class="fw-bold mb-3">Payment Accepted</h5>
                <div class="mb-4" data-payment-methods>
                   
                </div>

                <button class="border-0 py-2 px-3 rounded-5 me-2"><i class="fa-regular fa-copy me-2 fs-5"></i>Share Link</button>
                <button class="border-0 py-2 px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#report"><i class="fa-regular fa-flag me-2 fs-5"></i>Report</button>
            </div>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById('morestallinfo');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        // Get data attributes
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const hours = button.getAttribute('data-hours');
        const paymentMethods = button.getAttribute('data-payment-methods');

        // Populate modal fields
        modal.querySelector('.modal-body span[data-email]').textContent = email || 'N/A';
        modal.querySelector('.modal-body span[data-phone]').textContent = phone || 'N/A';

        // Populate operating hours
        const hoursContainer = modal.querySelector('.modal-body div[data-hours]');
        hoursContainer.innerHTML = hours
            ? hours.split('; ').map(hour => `<p>${hour}</p>`).join('')
            : '<p>No operating hours available</p>';

        // Populate payment methods
        const paymentContainer = modal.querySelector('.modal-body div[data-payment-methods]');
        paymentContainer.innerHTML = paymentMethods
            ? paymentMethods.split(', ').map(method => `<div><i class="fa-solid fa-check me-2"></i><span>${method}</span></div>`).join('')
            : '<p>No payment methods available</p>';
    });

</script>

