<?php
    session_start();

    require_once 'verification_token.class.php';

    $verificationObj = new Verification();

    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        $isVerified = $verificationObj->verifyEmail($token);

        if ($isVerified) {
            $_SESSION['user']['isVerified'] = true;
            echo "Email verified successfully!";
            header('Location: ../index.php');
            exit();
        } else {
            echo "Verification link has expired or is invalid.";
        }
    } else {
        echo "No token provided.";
    }