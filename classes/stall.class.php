<?php
require_once 'db.php';

class Stall {
    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function getStallId($userId){
        $sql = "SELECT id FROM stalls WHERE user_id = :user_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $userId));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        }
        return $result['id'];
    }
}