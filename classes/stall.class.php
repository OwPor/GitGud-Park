<?php
require_once 'db.php';

class Stall {
    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    public function getStallId($userId){
        $sql = "SELECT id FROM stalls WHERE user_id = :user_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $userId));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        }
        return $result['id'];
    }

    public function getStall($stallId){
        $sql = "SELECT * FROM stalls WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':id' => $stallId));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        }
        return $result;
    }

    public function getProducts($stallId) {
        $sql = "SELECT p.*, c.name AS category_name, 
                    COALESCE(SUM(s.quantity), 0) AS stock 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                LEFT JOIN stocks s ON p.id = s.product_id 
                WHERE p.stall_id = :stall_id 
                GROUP BY p.id;";
        
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':stall_id' => $stallId));
        $result = $query->fetchAll();
    
        return $result ?: [];
    }
    
    public function getProductVariations($productId) {
        $sql = "SELECT * FROM product_variations WHERE product_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getVariationOptions($variationId) {
        $sql = "SELECT * FROM variation_options WHERE variation_id = ?";
        $stmt =$this->db->connect()->prepare($sql);
        $stmt->execute([$variationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getStock($productId, $variationOptionId) {
        $sql = "SELECT quantity FROM stocks WHERE product_id = ? AND variation_option_id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$productId, $variationOptionId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['quantity'] : 0;
    }
    
    public function getProductById($productId) {
        $sql = "SELECT p.*, c.name AS category_name, 
            COALESCE(SUM(s.quantity), 0) AS stock 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            LEFT JOIN stocks s ON p.id = s.product_id 
            WHERE p.id = ?
            GROUP BY p.id;";
            
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addInventory($product_id, $variation_option_id, $type, $quantity, $reason) {
        $conn = $this->db->connect();
        
        $conn->beginTransaction();
        
        try {
            $sql = "INSERT INTO inventory (product_id, variation_option_id, type, quantity, reason) 
                    VALUES (:product_id, :variation_option_id, :type, :quantity, :reason)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindValue(':reason', $reason, PDO::PARAM_STR);
            if ($variation_option_id === null) {
                $stmt->bindValue(':variation_option_id', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':variation_option_id', $variation_option_id, PDO::PARAM_INT);
            }
            $stmt->execute();
    
            $sqlCheck = "SELECT quantity FROM stocks WHERE product_id = :product_id AND variation_option_id " . 
                        ($variation_option_id === null ? "IS NULL" : "= :variation_option_id");
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            if ($variation_option_id !== null) {
                $stmtCheck->bindValue(':variation_option_id', $variation_option_id, PDO::PARAM_INT);
            }
            $stmtCheck->execute();
            $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                if ($type === 'Stock In') {
                    $newQuantity = $row['quantity'] + $quantity;
                } else {
                    $newQuantity = $row['quantity'] - $quantity;
                    if ($newQuantity < 0) {
                        $newQuantity = 0;
                    }
                }
                $sqlUpdate = "UPDATE stocks SET quantity = :quantity WHERE product_id = :product_id AND variation_option_id " .
                             ($variation_option_id === null ? "IS NULL" : "= :variation_option_id");
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
                $stmtUpdate->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                if ($variation_option_id !== null) {
                    $stmtUpdate->bindValue(':variation_option_id', $variation_option_id, PDO::PARAM_INT);
                }
                $stmtUpdate->execute();
            } else {
                $newQuantity = ($type === 'Stock In') ? $quantity : 0;
                $sqlInsert = "INSERT INTO stocks (product_id, variation_option_id, quantity)
                              VALUES (:product_id, :variation_option_id, :quantity)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                if ($variation_option_id === null) {
                    $stmtInsert->bindValue(':variation_option_id', null, PDO::PARAM_NULL);
                } else {
                    $stmtInsert->bindValue(':variation_option_id', $variation_option_id, PDO::PARAM_INT);
                }
                $stmtInsert->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
                $stmtInsert->execute();
            }
            
            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollBack();
            return false;
        }
    }
    
    public function getInventory($product_id, $type, $variation_option_id = null) {
        if ($variation_option_id !== null) {
            $sql = "SELECT * FROM inventory 
                    WHERE product_id = :product_id 
                      AND type = :type 
                      AND variation_option_id = :variation_option_id 
                    ORDER BY created_at DESC";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':variation_option_id', $variation_option_id, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM inventory 
                    WHERE product_id = :product_id 
                      AND type = :type 
                    ORDER BY created_at DESC";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getConnection() {
        return $this->db->connect();
    }
    

    
    public function getTotalProducts($stallId) {
        $sql = "SELECT COUNT(*) AS total_products FROM products WHERE stall_id = :stall_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':stall_id' => $stallId));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        }
        return $result['total_products'];
    }
}
