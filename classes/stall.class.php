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
                        o.id AS order_id,
                        o.total_price,
                        o.payment_method,
                        o.order_type,
                        o.order_class,
                        o.scheduled_time,
                        o.created_at AS order_date,
                        os.status,
                        u.first_name,
                        u.last_name,
                        u.email AS user_email,
                        u.phone AS user_phone,
                        p.image AS product_image,
                        p.description AS product_description,
                        p.name AS food_name,
                        s.name AS food_stall_name,
                        oi.price AS price,
                        oi.quantity AS quantity,
                        CASE 
                            WHEN oi.variation_option_id IS NOT NULL THEN pv.name
                            ELSE 'No variations'
                        END AS variation_details
                    FROM orders o
                    JOIN order_stalls os ON os.order_id = o.id
                    JOIN stalls s ON s.id = os.stall_id
                    JOIN users u ON o.user_id = u.id
                    JOIN order_items oi ON oi.order_stall_id = os.id
                    JOIN products p ON p.id = oi.product_id
                    LEFT JOIN variation_options vo ON vo.id = oi.variation_option_id
                    LEFT JOIN product_variations pv ON vo.variation_id = pv.id
                    WHERE s.id = :stall_id";
            
            $params = [":stall_id" => $stallId];
            
            // Add search functionality if the $search parameter is provided.
            if ($search) {
                $sql .= " AND (
                            o.id LIKE :search OR
                            p.name LIKE :search OR
                            CONCAT(u.first_name, ' ', u.last_name) LIKE :search OR
                            u.email LIKE :search OR
                            u.phone LIKE :search
                         )";
                $params[':search'] = "%{$search}%";
            }
            
            // Order results by the stall order status and then by order creation date (descending)
            $sql .= " ORDER BY 
                        CASE os.status
                            WHEN 'Pending' THEN 1
                            WHEN 'Preparing' THEN 2
                            WHEN 'Ready' THEN 3
                            WHEN 'Completed' THEN 4
                            WHEN 'Cancelled' THEN 5
                            ELSE 6
                        END,
                        o.created_at DESC";
            
            $query = $this->db->connect()->prepare($sql);
            
            // Bind parameters
            foreach ($params as $key => $value) {
                $query->bindValue(
                    $key,
                    $value,
                    is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
                );
            }
            
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Format the results for output.
            foreach ($result as &$order) {
                // Store the original numeric price for accurate calculation
                $originalPrice = $order['price'];
                $order['price'] = number_format($originalPrice, 2);
                $order['order_date'] = date('Y-m-d H:i:s', strtotime($order['order_date']));
                if ($order['scheduled_time']) {
                    $order['scheduled_time'] = date('Y-m-d H:i:s', strtotime($order['scheduled_time']));
                }
                // Create a full customer name field.
                $order['customer_name'] = trim($order['first_name'] . ' ' . $order['last_name']);
                // Copy variation details for display and remove the redundant key.
                $order['formatted_variations'] = $order['variation_details'];
                unset($order['variation_details']);
                // Calculate the total amount for this order item (unit price multiplied by quantity).
                $order['total_amount'] = number_format($originalPrice * $order['quantity'], 2);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error fetching stall orders: " . $e->getMessage());
            return false;
        }
    }
















    public function getUserOrders($user_id, $park_id) {
        $sql = "SELECT 
                    o.id AS order_id,
                    o.created_at AS order_date,
                    os.id AS order_stall_id,
                    os.stall_id,
                    os.status AS order_status,
                    os.subtotal AS stall_subtotal,
                    os.queue_number,
                    s.name AS stall_name,
                    s.park_id,
                    p.name AS product_name,
                    p.image AS product_image,
                    oi.product_id,
                    oi.variations,
                    oi.request,
                    oi.quantity,
                    oi.price,
                    oi.subtotal AS item_subtotal
                FROM orders o
                JOIN order_stalls os ON o.id = os.order_id
                JOIN stalls s ON os.stall_id = s.id
                JOIN order_items oi ON os.id = oi.order_stall_id
                JOIN products p ON oi.product_id = p.id
                WHERE o.user_id = ? 
                  AND s.park_id = ?
                ORDER BY o.created_at DESC, os.status";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id, $park_id]);
        return $stmt->fetchAll();
    }
    
    public function getStallOrders($stall_id) {
        $sql = "SELECT 
                    o.id AS order_id,
                    o.created_at AS order_date,
                    os.id AS order_stall_id,
                    os.status AS order_status,
                    os.subtotal AS stall_subtotal,
                    os.queue_number,
                    p.name AS product_name,
                    p.image AS product_image,
                    oi.product_id,
                    oi.variations,
                    oi.request,
                    oi.quantity,
                    oi.price,
                    oi.subtotal AS item_subtotal
                FROM orders o
                JOIN order_stalls os ON o.id = os.order_id
                JOIN order_items oi ON os.id = oi.order_stall_id
                JOIN products p ON oi.product_id = p.id
                WHERE os.stall_id = ?
                ORDER BY o.created_at DESC, os.status";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$stall_id]);
        return $stmt->fetchAll();
    }
    
}
