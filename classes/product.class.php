<?php
require_once 'db.php';

class Product {
    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function addProduct($name, $code, $description, $price, $category_id, $stall_id, $image, $variants) {
        try {
            $db = $this->db->connect();
    
            // Check if the stall_id exists
            $checkStallSql = "SELECT COUNT(*) FROM stalls WHERE id = :stall_id";
            $checkStallQuery = $db->prepare($checkStallSql);
            $checkStallQuery->bindParam(':stall_id', $stall_id);
            $checkStallQuery->execute();
            $stallExists = $checkStallQuery->fetchColumn();
    
            if ($stallExists == 0) {
                echo "Failed to add product: Stall ID does not exist.";
                return false;
            }
    
            // Check if the product code already exists
            $checkCodeSql = "SELECT COUNT(*) FROM products WHERE code = :code";
            $checkCodeQuery = $db->prepare($checkCodeSql);
            $checkCodeQuery->bindParam(':code', $code);
            $checkCodeQuery->execute();
            $codeExists = $checkCodeQuery->fetchColumn();
    
            if ($codeExists > 0) {
                echo "Failed to add product: Product code already exists.";
                return false;
            }
    
            // Proceed to insert the new product
            $sql = "INSERT INTO products (name, code, description, price, category_id, stall_id, file_path) 
                    VALUES (:name, :code, :description, :price, :category_id, :stall_id, :file_path)";
            $query = $db->prepare($sql);
            $query->bindParam(':name', $name);
            $query->bindParam(':code', $code);
            $query->bindParam(':description', $description);
            $query->bindParam(':price', $price);
            $query->bindParam(':category_id', $category_id);
            $query->bindParam(':stall_id', $stall_id);
            $query->bindParam(':file_path', $image);
            $query->execute();
    
            $productId = $db->lastInsertId();
    
            // Insert product variants
            $variantSql = "INSERT INTO product_variants (product_id, variation_type, name, additional_price, subtract_price, image_path) 
                           VALUES (:product_id, :type, :name, :additional_price, :subtract_price, :image_path)";
            $variantQuery = $db->prepare($variantSql);
    
            foreach ($variants as $variant) {
                $variantQuery->bindParam(':product_id', $productId);
                $variantQuery->bindParam(':type', $variant['type']);
                $variantQuery->bindParam(':name', $variant['name']);
                $variantQuery->bindParam(':additional_price', $variant['additional_price']);
                $variantQuery->bindParam(':subtract_price', $variant['subtract_price']);
                $variantQuery->bindParam(':image_path', $variant['image_path']);
                $variantQuery->execute();
            }
    
            return true;
        } catch (Exception $e) {
            echo "Failed to add product: " . $e->getMessage();
            return false;
        }
    }

    function getCategories(){
        $sql = "SELECT * FROM categories;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}