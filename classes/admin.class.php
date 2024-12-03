<?php
require_once 'db.php';

class Admin {

    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function getUsers() {
        $sql = "SELECT * FROM users";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    function getBusinesses() {
        $sql = "SELECT * FROM business";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    function updateBusinessStatus($id, $status) {
        $sql = "UPDATE business SET business_status = :status WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':status', $status);
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}