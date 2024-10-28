<?php

class Database{
    private $host = "localhost";
    private $db_name = "gitgud";
    private $username = "root";
    private $password = "";

    protected $conn;

    function connect(){
        return $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
    }
}