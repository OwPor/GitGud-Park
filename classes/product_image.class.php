<?php

require_once 'product.class.php';

class ProductImage extends Product{

    function addImage($file_path) {
        $sql = "INSERT INTO product_image (product_id, file_path) VALUES (:product_id, :file_path);";
        $query = $this->db->connect()->prepare($sql);

        $last_inserted_product = $this->db->connect()->lastInsertId();

        $query->bindParam(':product_id', $last_inserted_product);
        $query->bindParam(':file_path', $file_path);
        return $query->execute();
    }
}