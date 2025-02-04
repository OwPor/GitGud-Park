<?php
require_once 'db.php';

class Park {

    protected $db;

    function __construct(){
        $this->db = new Database();
    }
 
    function getParks() {
        $sql = "
            SELECT business.*, GROUP_CONCAT(DISTINCT CONCAT(operating_hours.days, '<br>', operating_hours.open_time, ' - ', operating_hours.close_time) SEPARATOR '; ') AS operating_hours
            FROM business
            JOIN operating_hours ON operating_hours.business_id = business.id
            GROUP BY business.id
        ";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPark($park_id) {
        $sql = "SELECT * FROM business WHERE id = ?";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute([$park_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    function getStalls($parkId){
        $sql = "SELECT * FROM stalls WHERE park_id = :park_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':park_id' => $parkId));
        return $query->fetchAll();
    }

    // Check if the user is the owner of the food park
    function isOwner($user_id, $park_id) {
        $query = "SELECT COUNT(*) FROM business WHERE user_id = ? AND id = ?";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute([$user_id, $park_id]);
        return $stmt->fetchColumn() > 0;
    }

    // Check if the user is a stall owner inside the current park
    function isStallOwner($user_id, $park_id) {
        $query = "SELECT COUNT(*) FROM stalls WHERE user_id = ? AND park_id = ?";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute([$user_id, $park_id]);
        return $stmt->fetchColumn() > 0;
    }

    function addStall($user_id, $park_id, $businessname, $description, $businessemail, $businessphonenumber, $website, $stalllogo, $operatingHours, $categories, $payment_methods) { 
        $conn = $this->db->connect(); 
    
        $sql = "INSERT INTO stalls (user_id, park_id, name, description, email, phone, website, logo) 
                VALUES (:user_id, :park_id, :businessname, :description, :businessemail, :businessphonenumber, :website, :stalllogo)";
        
        $query = $conn->prepare($sql);
    
        if ($query->execute([
            ':user_id' => $user_id,
            ':park_id' => $park_id,
            ':businessname' => $businessname,
            ':description' => $description,
            ':businessemail' => $businessemail,
            ':businessphonenumber' => $businessphonenumber,
            ':website' => $website,
            ':stalllogo' => $stalllogo
        ])) {
            $stall_id = $conn->lastInsertId();
    
            // Insert operating hours
            $stmt = $conn->prepare("INSERT INTO stall_operating_hours (stall_id, days, open_time, close_time) VALUES (:stall_id, :days, :open_time, :close_time)");
    
            foreach ($operatingHours as $schedule) {
                $days = implode(', ', $schedule['days']);
                $openTime = $schedule['openTime'];
                $closeTime = $schedule['closeTime'];
        
                $stmt->execute([
                    ':stall_id' => $stall_id,
                    ':days' => $days,
                    ':open_time' => $openTime,
                    ':close_time' => $closeTime
                ]);
            }
    
            // Insert stall categories
            if (!empty($categories)) {
                $stmt = $conn->prepare("INSERT INTO stall_categories (stall_id, name) VALUES (:stall_id, :name)");
                foreach ($categories as $category) {
                    $stmt->execute([
                        ':stall_id' => $stall_id,
                        ':name' => $category
                    ]);
                }
            }
    
            // Insert payment methods
            if (!empty($payment_methods)) {
                $stmt = $conn->prepare("INSERT INTO stall_payment_methods (stall_id, method) VALUES (:stall_id, :method)");
                foreach ($payment_methods as $method) {
                    $stmt->execute([
                        ':stall_id' => $stall_id,
                        ':method' => $method
                    ]);
                }
            }
        }
    }
    
    
    
    
    
    
/*
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