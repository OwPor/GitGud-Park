<?php

require_once __DIR__ . '/db.class.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $retypePassword = $_POST['retypepassword'];
    $logoutOtherDevices = isset($_POST['logout_other_devices']) ? 1 : 0;

    // Validate the passwords
    if ($newPassword !== $retypePassword) {
        $_SESSION['error'] = "New passwords do not match.";
        header("Location: ../account.php");
        exit;
    }

    $user = new User();
    $user->id = $_SESSION['user']['id'];

    $result = $user->changePassword($user->id, $currentPassword, $newPassword, $logoutOtherDevices);

    if ($result['success']) {
        $_SESSION['success'] = "Password changed successfully.";
        $_SESSION['user_session'] = $result['user_session'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header("Location: ../account.php");
    exit;
}
?>