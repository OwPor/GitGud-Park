<?php
require_once(__DIR__ . '/../classes/db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../vendor/autoload.php');

class Verification {
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function sendEmail($user_id, $email, $first_name, $token) {
        $token = urlencode($token);
        
        // TEMPORARY LINK
        $verificationLink = "http://localhost/GitGudPark/email/verify.php?token={$token}&id={$user_id}";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            // IMPORTANT CREDENTIALS!!!!!!!!!!!!!!!!!!!!!!!! MUST USE .env, BUT NOT FOR NOW
            $mail->Username = 'vince280124@gmail.com';
            $mail->Password = 'frfqgqqgmkfxywtf';
            // IMPORTANT CREDENTIALS!!!!!!!!!!!!!!!!!!!!!!!!

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('pms-do-not-reply@gitgud.com', 'Verify Email');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = "<!DOCTYPE html>
                            <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>Email Verification</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f4f4f4;
                                        margin: 0;
                                        padding: 20px;
                                    }
                                    .container {
                                        background-color: #ffffff;
                                        padding: 20px;
                                        border-radius: 5px;
                                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                    }
                                    h1 {
                                        color: #333;
                                    }
                                    a {
                                        color: #007BFF;
                                        text-decoration: none;
                                    }
                                    a:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class='container'>
                                    <h1>Hello, {$first_name}!</h1>
                                    <p>Please click the following link to verify your email:</p>
                                    <p><a href='{$verificationLink}'>Verify your email</a></p>
                                    <p>Thank you!</p>
                                </div>
                            </body>
                            </html>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendVerificationEmail($user_id, $email, $first_name) {
        $sql = "SELECT * FROM verification WHERE user_id = :user_id";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $token = uniqid();
        $verification = $query->fetch();

        if ($verification) {
            $current_time = time();
            $last_sent = $verification['last_sent'];
            $difference = $current_time - $last_sent;
            $cd = 180;

            if ($difference < $cd) {
                return ['cd' => $cd - $difference, 'message' => 'cooldown'];
            } else if ($verification['is_verified'] == 0) {
                $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

                $sql = "INSERT INTO verification (user_id, verification_token, token_expiration, last_sent) 
                        VALUES (:user_id, :token, :token_expiration, :last_sent) 
                        ON DUPLICATE KEY UPDATE 
                        verification_token = :token, 
                        token_expiration = :token_expiration,
                        last_sent = :last_sent;";

                $query = $this->db->connect()->prepare($sql);
                $query->execute(array(
                    ':user_id' => $user_id,
                    ':token' => $token,
                    ':token_expiration' => $expiration,
                    ':last_sent' => time()
                ));

                return $this->sendEmail($user_id, $email, $first_name, $token);
            } else {
                return ['message' => 'verified'];
            }
        } else {
            $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

            $sql = "INSERT INTO verification (user_id, verification_token, token_expiration, last_sent) 
                    VALUES (:user_id, :token, :token_expiration, :last_sent)";

            $query = $this->db->connect()->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,
                ':token' => $token,
                ':token_expiration' => $expiration,
                ':last_sent' => time()
            ));

            return $this->sendEmail($user_id, $email, $first_name, $token);
        }
    }

    function verifyEmail($token, $user_id) {
        $sql = "SELECT * FROM verification WHERE user_id = :user_id";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $verification = $query->fetch();
        if ($verification['is_verified'] == 0) {
            $sql = "SELECT * FROM verification WHERE verification_token = :token";
            $query = $this->db->connect()->prepare($sql);
            $query->execute(array(':token' => $token));
            $verification = $query->fetch();

            if ($verification) {
                if (strtotime($verification['token_expiration']) > time()) {
                    $sql = "UPDATE verification SET is_verified = 1 WHERE user_id = :user_id";
                    $query = $this->db->connect()->prepare($sql);
                    $query->execute(array(':user_id' => $verification['user_id']));

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return 'verified';
        }
    }
}