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

    protected $db;

    function __construct(){
        $this->db = new Database();
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
        
        return $query->execute(array(
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':birth_date' => $this->birth_date,
            ':email' => $this->email,
            ':sex' => $this->sex,
            ':phone' => $this->phone,
            ':password' => $this->password
        ));
    }

    function editUser($user_id){
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, email = :email, sex = :sex, phone = :phone, password = :password WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);

        return $query->execute(array(
            ':id' => $user_id,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':birth_date' => $this->birth_date,
            ':email' => $this->email,
            ':sex' => $this->sex,
            ':phone' => $this->phone,
            ':password' => $this->password
        ));
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
        $sql = "INSERT INTO businesses (user_id, business_name, business_type, region_province_city, barangay, street_building_house, business_phone, business_email, business_permit) VALUES (:user_id, :business_name, :business_type, :region_province_city, :barangay, :street_building_house, :business_phone, :business_email, :business_permit);";
        $query = $this->db->connect()->prepare($sql);
        # $user_id, $business_name, $business_type, $region_province_city, $barangay, $street_building_house, $business_phone, $business_email, $business_permit
        if ($query->execute(array(
            ':user_id' => $user_id,
            ':business_name' => $business_name,
            ':business_type' => $business_type,
            ':region_province_city' => $region_province_city,
            ':barangay' => $barangay,
            ':street_building_house' => $street_building_house,
            ':business_phone' => $business_phone,
            ':business_email' => $business_email,
            ':business_permit' => $business_permit
        ))) {
            $sql = "UPDATE users SET role = 'park' WHERE id = :user_id;";
            $query = $this->db->connect()->prepare($sql);
            
            return $query->execute(array(':user_id' => $user_id));;
        }
    }
}
