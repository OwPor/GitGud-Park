<?php
session_start();
require_once __DIR__ . '/classes/stall.class.php';
require_once __DIR__ . '/classes/db.class.php';

$stallObj  = new Stall();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $product_id = $_POST['product_id'] ?? null;
    $variation_options = $_POST['variation_options'] ?? [];
    $quantity = $_POST['quantity'] ?? 1;
    $price = $_POST['price'] ?? 0;
    $request = $_POST['request'] ?? '';

    if (!$user_id) {
        echo "User not logged in.";
        exit;
    }

    $conn = $stallObj->getConnection();

    if (!empty($variation_options)) {
        foreach ($variation_options as $variation_option_id) {
            $stmt = $conn->prepare("INSERT INTO cart 
                (user_id, product_id, variation_option_id, request, quantity, price) 
                VALUES (?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $user_id, 
                $product_id, 
                $variation_option_id, 
                $request, 
                $quantity, 
                $price
            ]);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO cart 
            (user_id, product_id, variation_option_id, request, quantity, price) 
            VALUES (?, ?, NULL, ?, ?, ?)");

        $stmt->execute([
            $user_id, 
            $product_id, 
            $request, 
            $quantity, 
            $price
        ]);
    }

    echo "Added to cart successfully!";
}

?>
