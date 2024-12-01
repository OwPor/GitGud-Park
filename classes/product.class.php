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
    
            $checkStallSql = "SELECT COUNT(*) FROM stalls WHERE id = :stall_id";
            $checkStallQuery = $db->prepare($checkStallSql);
            $checkStallQuery->bindParam(':stall_id', $stall_id);
            $checkStallQuery->execute();
            $stallExists = $checkStallQuery->fetchColumn();
    
            if ($stallExists == 0) {
                echo "Failed to add product: Stall ID does not exist.";
                return false;
            }
    
            $checkCodeSql = "SELECT COUNT(*) FROM products WHERE code = :code";
            $checkCodeQuery = $db->prepare($checkCodeSql);
            $checkCodeQuery->bindParam(':code', $code);
            $checkCodeQuery->execute();
            $codeExists = $checkCodeQuery->fetchColumn();
    
            if ($codeExists > 0) {
                echo "Failed to add product: Product code already exists.";
                return false;
            }
    
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

    function getCategory($category_id) {
        $sql = "SELECT * FROM categories WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':id' => $category_id));
        $result = $query->fetch();
    
        if ($result === false) {
            return false;
        }
    
        return $result;
    }
    
    function getProducts($stallId) {
        $sql = "SELECT * FROM products WHERE stall_id = :stall_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':stall_id' => $stallId));
        $result = $query->fetchAll();
        
        if (empty($result)) {
            return [];
        }
    
        foreach ($result as $key => $product) {
            $category = $this->getCategory($product['category_id']);
            if ($category) {
                $result[$key]['category'] = $category['name'];
            }
        }
    
        return $result;
    }

    function isProductCodeExists($code) {
        $sql = "SELECT COUNT(*) FROM products WHERE code = :code;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':code' => $code));
    
        return $query->fetchColumn() > 0;
    }
}