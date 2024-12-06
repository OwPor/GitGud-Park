<?php
require_once __DIR__ . '/classes/product.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category'])) {
        $category = trim($_POST['category']);
        
        $product = new Product();
        
        if ($product->addCategory($category)) {
            echo "Category added successfully!";
        } else {
            echo "Failed to add category.";
        }
    } else {
        echo "No category provided.";
    }
} else {
    echo "Invalid request method.";
}
?>