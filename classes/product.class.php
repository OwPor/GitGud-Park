<?php
require_once 'db.php';

class Product {
    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function addProduct($stall_id, $productName, $productCode, $category, $description, $basePrice, $discount, $startDate, $endDate, $imagePath) {
        $db = $this->db->connect();  
        $sql = "INSERT INTO products (stall_id, name, code, category_id, description, base_price, discount, start_date, end_date, image) 
                VALUES (:stall_id, :name, :code, :category_id, :description, :base_price, :discount, :start_date, :end_date, :image)";
        
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':stall_id', $stall_id);
        $stmt->bindValue(':name', $productName);
        $stmt->bindValue(':code', $productCode);
        $stmt->bindValue(':category_id', $category);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':base_price', $basePrice);
        $stmt->bindValue(':discount', $discount);
        $stmt->bindValue(':start_date', $startDate);
        $stmt->bindValue(':end_date', $endDate);
        $stmt->bindValue(':image', $imagePath);
        
        if ($stmt->execute()) {
            return $db->lastInsertId();  // Get last inserted ID using the same connection
        }
        
        return false;
    }
    
    
    function addVariations($productId, $variationName) {
        $db = $this->db->connect();  
        $sql = "INSERT INTO product_variations (product_id, name) VALUES (:product_id, :name)";
        
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':product_id', $productId);
        $stmt->bindValue(':name', $variationName);
        
        if ($stmt->execute()) {
            return $db->lastInsertId();
        }
        
        return false;
    }

    function addVariationOptions($variationId, $optionName, $addPrice, $subtractPrice, $variationImagePath) {
        $db = $this->db->connect();  
        $sql = "INSERT INTO variation_options (variation_id, name, add_price, subtract_price, image) 
                VALUES (:variation_id, :name, :add_price, :subtract_price, :image)";
    
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':variation_id', $variationId);
        $stmt->bindValue(':name', $optionName);
        $stmt->bindValue(':add_price', $addPrice);
        $stmt->bindValue(':subtract_price', $subtractPrice);
        $stmt->bindValue(':image', $variationImagePath);
    
        if ($stmt->execute()) {
            return $db->lastInsertId();
        }
        
        return false;
    }

    function addStock($productId, $variationOptionId, $quantity = 0) {
        $db = $this->db->connect();  
        $sql = "INSERT INTO stocks (product_id, variation_option_id, quantity) 
                VALUES (:product_id, :variation_option_id, :quantity)";
    
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':product_id', $productId);
        $stmt->bindValue(':variation_option_id', $variationOptionId);
        $stmt->bindValue(':quantity', $quantity);
    
        return $stmt->execute(); // Returns true if successful, false otherwise
    }
    
    /*function addProduct($name, $code, $description, $price, $category_id, $stall_id, $stocks, $stock_warn, $image, $discountType, $discountValue, $variants) {
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
    
            $sql = "INSERT INTO products (name, code, description, price, category_id, stall_id, stock, stock_warn, file_path, discount_type, discount) 
                    VALUES (:name, :code, :description, :price, :category_id, :stall_id, :stock, :stock_warn, :file_path, :discount_type, :discount)";
            $query = $db->prepare($sql);
            $query->bindParam(':name', $name);
            $query->bindParam(':code', $code);
            $query->bindParam(':description', $description);
            $query->bindParam(':price', $price);
            $query->bindParam(':category_id', $category_id);
            $query->bindParam(':stall_id', $stall_id);
            $query->bindParam(':stock', $stocks);
            $query->bindParam(':stock_warn', $stock_warn);
            $query->bindParam(':file_path', $image);
            $query->bindParam(':discount_type', $discountType);
            $query->bindParam(':discount', $discountValue);
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
    }*/

    public function addCategory($stall_id, $name) {
        $sql = "INSERT INTO categories (stall_id, name) VALUES (:stall_id, :name)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':stall_id', $stall_id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function getCategories($stall_id) {
        $sql = "SELECT * FROM categories WHERE stall_id = :stall_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':stall_id', $stall_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    function isProductCodeExists($code) {
        $sql = "SELECT COUNT(*) FROM products WHERE code = :code;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':code' => $code));
    
        return $query->fetchColumn() > 0;
    }
    
    /*function getProducts($stallId) {
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

    function getProductById($productId) {
        $sql = "SELECT * FROM products WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':id' => $productId));
        $result = $query->fetch();
    
        if ($result === false) {
            return false;
        }
    
        $category = $this->getCategory($result['category_id']);
        if ($category) {
            $result['category'] = $category['name'];
        }
    
        return $result;
    }

    function getProduct($productId) {
        $sql = "SELECT p.*, c.name AS category_name, 
                    COALESCE(SUM(s.quantity), 0) AS stock 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                LEFT JOIN stocks s ON p.id = s.product_id 
                WHERE p.id = :product_id 
                GROUP BY p.id;";

        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':product_id' => $productId));
        $result = $query->fetch(); 

        return $result ?: null;
    }*/

}