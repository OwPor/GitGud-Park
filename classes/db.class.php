<?php
require_once 'db.php';

class User {
    public $id = '';
    public $first_name = '';
    public $last_name = '';
    public $phone = '';
    public $email = '';
    public $birth_date = '';
    public $sex = '';
    public $password = '';
    public $profile_img = '';

    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    function generateUniqueUserSession() {
        do {
            $user_session = bin2hex(random_bytes(86));
    
            $stmt = $this->db->connect()->prepare("SELECT COUNT(*) FROM users WHERE user_session = ?");
            $stmt->execute([$user_session]);
            $exists = $stmt->fetchColumn() > 0;
    
        } while ($exists);
    
        $sql = "UPDATE users SET user_session = :user_session WHERE email = :email;";
        $query = $this->db->connect()->prepare($sql);

        return $query->execute(array(
            ':user_session' => $user_session,
            ':email' => $this->email
        ));
    }

    function addUser(){
        $age = $this->calculateAge($this->birth_date);
        if ($age < 18)
            return false;
        
        if ($this->validateEmail($this->email))
            return false;
        
        if ($this->checkEmail($this->email))
            return 'email';

        if ($this->validatePassword($this->password))
            return false;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        if ($this->validatePhone($this->phone))
            return false;
        if ($this->checkPhone($this->phone))
            return 'phone';

        if (!($this->sex == "male" || $this->sex == "female"))
            return false;

        $sql = "INSERT INTO users (first_name, last_name, birth_date, email, sex, phone, password) VALUES (:first_name, :last_name, :birth_date, :email, :sex, :phone, :password);";
        $query = $this->db->connect()->prepare($sql);
        
        if ($query->execute(array(
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':birth_date' => $this->birth_date,
            ':email' => $this->email,
            ':sex' => $this->sex,
            ':phone' => $this->phone,
            ':password' => $this->password
        ))) {
            return $this->generateUniqueUserSession($this->db->connect());
        }
        return false;
    }

    function editUser($user_id, $current_password, $current_phone) {
        // $age = $this->calculateAge($this->birth_date);
        // if ($age < 18)
        //     return false;
        
        // if ($this->validateEmail($this->email))
        //     return false;
        
        // if ($this->changeEmail($this->email, $this->email))
        //     return 'email';

        if ($this->validatePhone($this->phone))
            return false;

        if ($this->changePhone($this->phone, $current_phone))
            return 'phone';

        if (!($this->sex == "male" || $this->sex == "female"))
            return false;

        $sql = "SELECT password FROM users WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':id' => $user_id));
        $result = $query->fetch();

        if (password_verify($current_password, $result['password'])) {

            $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, sex = :sex, phone = :phone, profile_img = :profile_img WHERE id = :id;";
            $query = $this->db->connect()->prepare($sql);

            return $query->execute(array(
                ':id' => $user_id,
                ':first_name' => $this->first_name,
                ':last_name' => $this->last_name,
                // ':birth_date' => $this->birth_date,
                // ':email' => $this->email,
                ':sex' => $this->sex,
                ':phone' => $this->phone,
                ':profile_img' => $this->profile_img
            ));
        }
    }

    function deleteUser($user_id){
        $sql = "DELETE FROM users WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':id' => $user_id
        ));
        
        return $query;
    }

    function getUser($user_id){
        $sql = "SELECT * FROM users WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':id' => $user_id
        ));

        $user = $query->fetch();
        
        if (!$user) {
            return false;
        }

        $name = $user['first_name'] . ' ' . $user['last_name'];

        $info = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'full_name' => $name,
            'phone' => $user['phone'],
            'birth_date' => $user['birth_date'],
            'sex' => $user['sex'],
            'profile_img' => $user['profile_img'],
            'user_session' => $user['user_session']
        ];

        return $info;
    }

    public function checkUser() {
        $this->validateEmail($this->email);
        
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $query = $this->db->connect()->prepare($sql);
        $query->execute([':email' => $this->email]);
        
        $user = $query->fetch();
        
        if (!$user) {
            return false; 
        }
        
        if (password_verify($this->password, $user['password'])) {

            $info = [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'phone' => $user['phone'],
                'birth_date' => $user['birth_date'],
                'sex' => $user['sex']
            ];

            return $info;
        }
        
        return false;
    }


    private function calculateAge($birthDate){
        if (!$birthDate) {
            return false;
        }
        
        $today = new DateTime();
        $dob = new DateTime($birthDate);
        
        $age = $today->diff($dob);
        
        return $age->y >= 18 ? $age->y : false;
    }

    private function checkEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':email' => $email
        ));
        
        return $query->fetch();
    }

    private function changeEmail($email, $currentEmail) {
        $sql = "SELECT * FROM users WHERE email = :email AND email != :current_email;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':email' => $email,
            ':current_email' => $currentEmail
        ));
        
        return $query->fetch();
    }

    private function validateEmail($email){
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password){
        return strlen($password) < 8;
    }

    private function validatePhone($phone){
        return !preg_match('/^[0-9]{10}+$/', $phone);
    }

    private function checkPhone($phone){
        $sql = "SELECT * FROM users WHERE phone = :phone;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':phone' => $phone
        ));
        
        return $query->fetch();
    }

    private function changePhone($phone, $currentPhone) {
        $sql = "SELECT * FROM users WHERE phone = :phone AND phone != :current_phone;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':phone' => $phone,
            ':current_phone' => $currentPhone
        ));
        
        return $query->fetch();
    }


    function isVerified($user_id) {
        $sql = "SELECT is_verified FROM verification WHERE user_id = :user_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        
        $result = $query->fetch();
        
        if ($result === false) {
            return false;
        }

        return $result['is_verified'];
    }

    function registerBusiness($user_id, $business_name, $business_type, $region_province_city, $barangay, $street_building_house, $business_phone, $business_email, $business_permit) {
        $sql = "SELECT * FROM users WHERE id = :user_id AND role != 'Park Owner';";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        if (!$query->fetch()) {
            return "Park Owner";
        }

        $sql = "SELECT * FROM business WHERE business_name = :business_name;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':business_name' => $business_name));

        $business = $query->fetch();
        
        

        if ($business) {
            if ($business['business_name'] == $business_name) {
                return "Existing Business";
            } else if ($business['business_email'] == $business_email) {
                return "Existing Email";
            } else if ($business['business_phone'] == $business_phone) {
                return "Existing Phone";
            }
        }

        $sql = "INSERT INTO business (user_id, business_name, business_type, region_province_city, barangay, street_building_house, business_phone, business_email, business_permit, business_status) VALUES (:user_id, :business_name, :business_type, :region_province_city, :barangay, :street_building_house, :business_phone, :business_email, :business_permit, :business_status);";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute(array(
            ':user_id' => $user_id,
            ':business_name' => $business_name,
            ':business_type' => $business_type,
            ':region_province_city' => $region_province_city,
            ':barangay' => $barangay,
            ':street_building_house' => $street_building_house,
            ':business_phone' => $business_phone,
            ':business_email' => $business_email,
            ':business_permit' => $business_permit,
            ':business_status' => 'Pending Approval'
        ))) {
            $sql = "UPDATE users SET role = 'Park Owner' WHERE id = :user_id;";
            $query = $this->db->connect()->prepare($sql);
            
            return $query->execute(array(':user_id' => $user_id));
        }
    }

    function getBusinessStatus($user_id) {
        $sql = "SELECT business_status FROM business WHERE user_id = :user_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        return $query->fetch()['business_status'];
    }
}