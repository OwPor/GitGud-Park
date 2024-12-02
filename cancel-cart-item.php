<?php
require_once __DIR__ . '/classes/db.php';
require_once __DIR__ . '/classes/cart.class.php';

header('Content-Type: application/json');

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Validate the data
if (!isset($data['product_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$product_id = intval($data['product_id']);
session_start();
$user_id = $_SESSION['user']['id']; // Get the logged-in user's ID

try {
    // Use the Cart class to remove the product from the cart
    $cart = new Cart();
    $cart->removeFromCart($user_id, $product_id);

    echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>