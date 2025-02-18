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

    public function getOrdersByStallId($stallId, $search = null) {
        try {
            $sql = "SELECT 
                        o.*,
                        u.first_name,
                        u.last_name,
                        u.email AS user_email,
                        u.phone AS user_phone,
                        p.file_path AS product_image,
                        p.description AS product_description,
                        CASE 
                            WHEN o.variation_id > 0 THEN 
                                pv.name
                            ELSE 'No variations'
                        END as variation_details
                    FROM orders o 
                    JOIN users u ON o.user_id = u.id 
                    JOIN stalls s ON o.food_stall_name = s.name
                    LEFT JOIN products p ON o.product_id = p.id 
                    LEFT JOIN product_variations pv ON o.variation_id = pv.id
                    LEFT JOIN variation_types vt ON pv.variation_type_id = vt.id
                    WHERE s.id = :stall_id";
    
            $params = [":stall_id" => $stallId];
    
            // Add search functionality
            if ($search) {
                $sql .= " AND (
                    o.order_id LIKE :search 
                    OR o.food_name LIKE :search
                    OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search
                    OR u.email LIKE :search
                    OR u.phone LIKE :search
                )";
                $params[":search"] = "%{$search}%";
            }
    
            // Add ordering
            $sql .= " ORDER BY 
                        CASE o.status
                            WHEN 'ToPay' THEN 1
                            WHEN 'Preparing' THEN 2
                            WHEN 'ToReceive' THEN 3
                            WHEN 'Completed' THEN 4
                            WHEN 'Cancelled' THEN 5
                            ELSE 6
                        END,
                        o.order_date DESC";
    
            $query = $this->db->connect()->prepare($sql);
            
            // Bind parameters
            foreach ($params as $key => $value) {
                $query->bindValue($key, $value, 
                    is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
                );
            }
    
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // Format the results
            foreach ($result as &$order) {
                // Format prices
                $order['price'] = number_format($order['price'], 2);
                
                // Format dates
                $order['order_date'] = date('Y-m-d H:i:s', strtotime($order['order_date']));
                if ($order['scheduled_date']) {
                    $order['scheduled_date'] = date('Y-m-d H:i:s', 
                        strtotime($order['scheduled_date']));
                }
    
                // Format customer name
                $order['customer_name'] = trim($order['first_name'] . ' ' . $order['last_name']);
                
                // Clean up variation display
                $order['formatted_variations'] = $order['variation_details'];
                unset($order['variation_details']);
    
                // Calculate total amount
                $order['total_amount'] = $order['price'] * $order['quantity'];
            }
    
            return $result;
    
        } catch (PDOException $e) {
            error_log("Error fetching stall orders: " . $e->getMessage());
            return false;
        }
    }
}
