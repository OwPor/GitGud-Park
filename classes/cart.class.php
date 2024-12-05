<?php
require_once 'db.php';

class Cart {

    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function getCart($userId){
        $sql = "SELECT * FROM cart WHERE user_id = :user_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $userId));
        return $query->fetchAll();
    }

    function addToCart($userId, $productId, $quantity, $stall_id) {
        $sql = "INSERT INTO cart (user_id, product_id, quantity, stall_id) 
                VALUES (:user_id, :product_id, :quantity, :stall_id)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $userId);
        $query->bindParam(':product_id', $productId);
        $query->bindParam(':quantity', $quantity);
        $query->bindParam(':stall_id', $stall_id);
        $query->execute();
    }

    function removeFromCart($userId, $productId) {
        $sql = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $query = $this->db->connect()->prepare($sql);
        $query->execute([':user_id' => $userId, ':product_id' => $productId]);
    }
}