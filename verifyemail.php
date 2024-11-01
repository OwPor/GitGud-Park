<?php
    include_once 'links.php'; 
    include_once 'secondheader.php';
?>
<style>
    main{
        height: calc(100vh - 65.61px); 
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<main>
    <div class="verify">
        <h1>Verify your email</h1>
        <p>You will need to verify your email to complete registration</p>
        <img src="assets/images/email.jpg" alt="">
        <p>An email has been sent to <span class="fw-bold">email@gmail.com</span> with a link to verify your account. If you have not received the email after a few minutes, please check your spam folder</p><br>
        <p>Didn't receive it yet? <a href="" data-bs-toggle="modal" data-bs-target="#resend">Resend</a> or <a href="" data-bs-toggle="modal" data-bs-target="#change">Change</a> the e-mail</p>
    </div>
    <!-- Resend Modal -->
    <div class="modal fade" id="resend" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 800px;">
            <div class="modal-content p-5">
                <div class="modal-header p-0 border-0">
                    <h5 class="modal-title fw-bold fs-3">Resend Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 my-4 text-center">
                    <i class="fa-regular fa-envelope mb-3"></i>
                    <p>The email address we have for you is <span class="fw-bold">example@gmail.com</span>. If you haven't received our message, please click the button below.</p>
                </div>
                <button type="button" class="btn btn-primary">Resend</button> 
            </div>
        </div>
    </div>
    <!-- Change Modal -->
    <div class="modal fade" id="change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 800px;">
            <div class="modal-content p-5">
                <div class="modal-header p-0 border-0">
                    <h5 class="modal-title fw-bold fs-3">Change Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 my-4 text-center">
                    <i class="fa-regular fa-envelope mb-3"></i>
                    <p>The email address we have for you is <span class="fw-bold">example@gmail.com</span>. If you want to change it, please provide us with your new email and we'll send a new verification link.</p>
                    <div class="input-group m-0">
                        <input type="email" name="email" id="email" placeholder="Type your new email address here" value="" required/>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Send</button> 
            </div>
        </div>
    </div>
</main>