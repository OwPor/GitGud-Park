<?php
require_once __DIR__ . '/classes/db.php';
require_once __DIR__ . '/classes/cart.class.php';

header('Content-Type: application/json');

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Validate the data
if (!isset($data['user_id'], $data['product_id'], $data['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$user_id = intval($data['user_id']);
$product_id = intval($data['product_id']);
$quantity = intval($data['quantity']);

// Use the Cart class to add the product to the cart
$cart = new Cart();

try {
    $cart->addToCart($user_id, $product_id, $quantity);
    echo json_encode(['success' => true, 'message' => 'Product added to cart']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to add product to cart: ' . $e->getMessage()]);
}
?>