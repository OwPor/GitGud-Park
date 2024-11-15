<?php
require_once 'db.php';

class Product {
    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function addProduct($name, $code, $description, $price, $category_id, $stall_id, $image) {
        $sql = "INSERT INTO products (name, code, description, price, category_id, stall_id, file_path) VALUES (:name, :code, :description, :price, :category_id, :stall_id, :file_path);";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':code', $code);
        $query->bindParam(':description', $description);
        $query->bindParam(':price', $price);
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':stall_id', $stall_id);
        $query->bindParam(':file_path', $image);
        return $query->execute();
    }

    function getCategories(){
        $sql = "SELECT * FROM categories;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}