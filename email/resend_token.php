<?php
    session_start();
    require_once 'verification_token.class.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $user_id = filter_var(trim($_POST['user_id']), FILTER_SANITIZE_NUMBER_INT);
        $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);

        $verificationObj = new Verification();
        $result = $verificationObj->sendVerificationEmail($email, $user_id, $first_name);

        if ($result === true) {
            echo "Verification email has been resent successfully!";
        } else if ($result == "verified") {
            echo "Email is already verified.";
        } else {
            echo "Failed to resend verification email. Please try again.";
        }
    } else {
        echo "Invalid request.";
    }