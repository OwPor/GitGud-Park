<?php
require_once 'db.php';

class Customer {
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

    function addCustomer(){
        $age = $this->calculateAge($this->birth_date);
        if ($age < 18)
            return false;
        
        if ($this->validateEmail($this->email))
            return false;
        
        if ($this->checkEmail($this->email))
            return false;

        if ($this->validatePassword($this->password))
            return false;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        if ($this->validatePhone($this->phone))
            return false;
        if ($this->checkPhone($this->phone))
            return false;

        if (!($this->sex == "male" || $this->sex == "female"))
            return false;

        $sql = "INSERT INTO customers (first_name, last_name, birth_date, email, sex, phone, password) VALUES (:first_name, :last_name, :birth_date, :email, :sex, :phone, :password);";
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

    function editCustomer($customerID){
        $sql = "UPDATE customers SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, email = :email, sex = :sex, phone = :phone, password = :password WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);

        return $query->execute(array(
            ':id' => $customerID,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':birth_date' => $this->birth_date,
            ':email' => $this->email,
            ':sex' => $this->sex,
            ':phone' => $this->phone,
            ':password' => $this->password
        ));
    }

    function deleteCustomer($customerID){
        $sql = "DELETE FROM customers WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':id' => $customerID
        ));
        
        if($query)
            return true;
        else
            return false;
    }

    function getCustomer($customerID){
        $sql = "SELECT * FROM customers WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':id' => $customerID
        ));
        
        return $query->fetch();
    }

    public function checkCustomer() {
        $this->validateEmail($this->email);
        
        $sql = "SELECT * FROM customers WHERE email = :email LIMIT 1";
        $query = $this->db->connect()->prepare($sql);
        $query->execute([':email' => $this->email]);
        
        $customer = $query->fetch();
        
        if (!$customer) {
            return false; 
        }
        
        if (password_verify($this->password, isset($customer['password_hashed']) ? $customer['password_hashed'] : $customer['password'])) {
            return $customer;
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
        $sql = "SELECT * FROM customers WHERE email = :email;";
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
        $sql = "SELECT * FROM customers WHERE phone = :phone;";
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array(
            ':phone' => $phone
        ));
        
        return $query->fetch();
    }
}
