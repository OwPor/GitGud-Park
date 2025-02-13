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
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.stall_id = :stall_id;";
        
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':stall_id' => $stallId));
        $result = $query->fetchAll();
    
        if ($result === false) {
            return false;
        }
    
        return $result;
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
                                CONCAT(vt.name, ': ', pv.name)
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