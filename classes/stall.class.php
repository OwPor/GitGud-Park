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

    public function getOrdersByStallId($stallId) {
        $sql = "SELECT 
                    o.*,
                    u.first_name,
                    u.last_name,
                    u.email AS user_email
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                JOIN stalls s ON o.food_stall_name = s.name
                WHERE s.id = :stall_id
                ORDER BY o.order_date DESC;";
        
        $query = $this->db->connect()->prepare($sql);
        $query->bindValue(':stall_id', $stallId, PDO::PARAM_INT);
        
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }
}