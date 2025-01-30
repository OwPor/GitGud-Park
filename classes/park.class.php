<?php
require_once 'db.php';

class Park {

    protected $db;

    function __construct(){
        $this->db = new Database();
    }
 
    function getParks(){
        $sql = "SELECT * FROM business;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /*function getPark($url){
        $sql = "SELECT * FROM parks WHERE url = :url;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':url' => $url));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        }
        return $result['id'];
    }

    function getStalls($parkId){
        $sql = "SELECT * FROM stalls WHERE park_id = :park_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':park_id' => $parkId));
        return $query->fetchAll();
    }

    function addPark($name, $description, $location, $image, $ownerName, $contactNumber, $email, $openingTime, $closingTime, $priceRange, $status) {
        $uniqueUrl = uniqid();

        $sql = "INSERT INTO parks (name, description, location, image, owner_name, contact_number, email, opening_time, closing_time, price_range, status, url)
                VALUES (:name, :description, :location, :image, :owner_name, :contact_number, :email, :opening_time, :closing_time, :price_range, :status, :url)";

        $stmt = $this->db->connect()->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':owner_name', $ownerName);
        $stmt->bindParam(':contact_number', $contactNumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':opening_time', $openingTime);
        $stmt->bindParam(':closing_time', $closingTime);
        $stmt->bindParam(':price_range', $priceRange);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':url', $uniqueUrl);

        $stmt->execute();

        // echo "Park inserted successfully with unique URL: " . $uniqueUrl;
    }

    function addStall($parkId, $name, $description, $image, $ownerName, $contactNumber, $email, $openingTime, $closingTime, $priceRange, $status) {

        $sql = "INSERT INTO stalls (park_id, name, description, img, owner_name, contact_number, email, opening_time, closing_time, price_range, status)
                VALUES (:park_id, :name, :description, :img, :owner_name, :contact_number, :email, :opening_time, :closing_time, :price_range, :status)";

        $stmt = $this->db->connect()->prepare($sql);

        $stmt->bindParam(':park_id', $parkId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':img', $image);
        $stmt->bindParam(':owner_name', $ownerName);
        $stmt->bindParam(':contact_number', $contactNumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':opening_time', $openingTime);
        $stmt->bindParam(':closing_time', $closingTime);
        $stmt->bindParam(':price_range', $priceRange);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        // echo "Stall inserted successfully";
    }*/
}

// $parkObj = new Park();
// $parkObj->addPark();
// $parkObj->addStall();