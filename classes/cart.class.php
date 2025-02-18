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

    /*function addToCart($userId, $productId, $quantity, $stall_id) {
        $sql = "INSERT INTO cart (user_id, product_id, quantity, stall_id) 
                VALUES (:user_id, :product_id, :quantity, :stall_id)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $userId);
        $query->bindParam(':product_id', $productId);
        $query->bindParam(':quantity', $quantity);
        $query->bindParam(':stall_id', $stall_id);
        $query->execute();
    }*/

    function removeFromCart($userId, $productId) {
        $sql = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $query = $this->db->connect()->prepare($sql);
        $query->execute([':user_id' => $userId, ':product_id' => $productId]);
    }

    public function getCartGroupedItems($user_id, $park_id) {
        $sql = "SELECT 
                    c.*,
                    p.name AS product_name,
                    p.image AS product_image,
                    p.stall_id,
                    s.name AS stall_name,
                    s.park_id,
                    (SELECT GROUP_CONCAT(method) 
                     FROM stall_payment_methods 
                     WHERE stall_id = s.id) AS supported_methods,
                    vo.name AS variation_name
                FROM cart c
                JOIN products p ON c.product_id = p.id
                JOIN stalls s ON p.stall_id = s.id
                LEFT JOIN variation_options vo ON c.variation_option_id = vo.id
                WHERE c.user_id = ? 
                  AND s.park_id = ?
                ORDER BY s.name, p.name, c.id";
        
        $stmt =  $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id, $park_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $cartGrouped = [];
    
        foreach ($rows as $row) {
            $stallName = $row['stall_name'];
            if (!isset($cartGrouped[$stallName])) {
                $cartGrouped[$stallName] = [];
            }
            $groupKey = $row['product_id'] . '_' . $row['request'];
            if (!isset($cartGrouped[$stallName][$groupKey])) {
                $cartGrouped[$stallName][$groupKey] = [
                    'product_id'      => $row['product_id'],
                    'product_name'    => $row['product_name'],
                    'product_image'   => $row['product_image'],
                    'quantity'        => $row['quantity'], 
                    'unit_price'      => 0,             
                    'request'         => $row['request'],
                    'variation_names' => [],
                    'stall_id'        => $row['stall_id'],
                    'supported_methods' => $row['supported_methods']
                ];
            }
            $cartGrouped[$stallName][$groupKey]['unit_price'] += floatval($row['price']);
    
            if (!empty($row['variation_name']) &&
                !in_array($row['variation_name'], $cartGrouped[$stallName][$groupKey]['variation_names'])) {
                $cartGrouped[$stallName][$groupKey]['variation_names'][] = $row['variation_name'];
            }
        }
        foreach ($cartGrouped as $stallName => $groupedItems) {
            $cartGrouped[$stallName] = array_values($groupedItems);
        }
    
        return $cartGrouped;
    }
    
}


