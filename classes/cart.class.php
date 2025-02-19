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
                    vo.name AS variation_name,
                    c.variation_option_id  
                FROM cart c
                JOIN products p ON c.product_id = p.id
                JOIN stalls s ON p.stall_id = s.id
                LEFT JOIN variation_options vo ON c.variation_option_id = vo.id
                WHERE c.user_id = ? 
                  AND s.park_id = ?
                ORDER BY s.name, p.name, c.id";
    
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$user_id, $park_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $cartGrouped = [];
    
        foreach ($rows as $row) {
            $stallName = $row['stall_name'];
            if (!isset($cartGrouped[$stallName])) {
                $cartGrouped[$stallName] = [];
            }
    
            $groupKey = $row['product_id'];
            if (!empty($row['variation_option_id'])) {
                $groupKey .= '_' . $row['variation_option_id'];
            }
            if (!empty($row['request'])) {
                $groupKey .= '_' . md5($row['request']); 
            }
    
            if (!isset($cartGrouped[$stallName][$groupKey])) {
                $cartGrouped[$stallName][$groupKey] = [
                    'product_id'         => $row['product_id'],
                    'product_name'       => $row['product_name'],
                    'product_image'      => $row['product_image'],
                    'quantity'           => $row['quantity'], 
                    'unit_price'         => floatval($row['price']),
                    'total_price'        => floatval($row['price']) * $row['quantity'],
                    'request'            => $row['request'],
                    'variation_names'    => [],
                    'stall_id'           => $row['stall_id'],
                    'supported_methods'  => $row['supported_methods'],
                    'variation_option_id'=> !empty($row['variation_option_id']) ? $row['variation_option_id'] : null
                ];
            } else {
                $cartGrouped[$stallName][$groupKey]['quantity'] += $row['quantity'];
                $cartGrouped[$stallName][$groupKey]['total_price'] += floatval($row['price']) * $row['quantity'];
            }
    
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
    
    
    
    
    
    public function createOrder($user_id, $total, $payment_method, $order_type, $order_class, $scheduled_time) {
        $conn = $this->db->connect();
        $sql = "INSERT INTO orders (user_id, total_price, payment_method, order_type, order_class, scheduled_time)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $total, $payment_method, $order_type, $order_class, $scheduled_time]);
        return $conn->lastInsertId();
    }

    public function createOrderStall($order_id, $stall_id, $subtotal) {
        $conn = $this->db->connect();
        $sql = "INSERT INTO order_stalls (order_id, stall_id, subtotal)
                VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$order_id, $stall_id, $subtotal]);
        return $conn->lastInsertId();
    }

    public function createOrderItem($order_stall_id, $product_id, $variation_option_id, $quantity, $price, $subtotal) {
        $conn = $this->db->connect();
        $sql = "INSERT INTO order_items (order_stall_id, product_id, variation_option_id, quantity, price, subtotal)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$order_stall_id, $product_id, $variation_option_id, $quantity, $price, $subtotal]);
    }

    public function placeOrder($user_id, $payment_method, $order_type, $order_class, $scheduled_time, $cartGrouped) {
        $conn = $this->db->connect();
        $total_order = 0;
        $stallSubtotals = [];  

        foreach ($cartGrouped as $stallName => $items) {
            $stall_total = 0;
            foreach ($items as $item) {
                $stall_total += $item['quantity'] * $item['unit_price'];
            }
            $stall_id = $items[0]['stall_id'];
            $stallSubtotals[$stall_id] = $stall_total;
            $total_order += $stall_total;
        }
        if ($total_order <= 0) {
            throw new Exception("No items in your cart to order.");
        }

        $conn->beginTransaction();
        try {
            $order_id = $this->createOrder($user_id, $total_order, $payment_method, $order_type, $order_class, $scheduled_time);

            foreach ($cartGrouped as $stallName => $items) {
                $stall_id = $items[0]['stall_id'];
                $subtotal = $stallSubtotals[$stall_id];
                $order_stall_id = $this->createOrderStall($order_id, $stall_id, $subtotal);

                foreach ($items as $item) {
                    $item_subtotal = $item['quantity'] * $item['unit_price'];
                    $variation_option_id = isset($item['variation_option_id']) ? $item['variation_option_id'] : null;
                    $this->createOrderItem($order_stall_id, $item['product_id'], $variation_option_id, $item['quantity'], $item['unit_price'], $item_subtotal);
                }
            }
            $conn->commit();
            return $order_id;
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

}


