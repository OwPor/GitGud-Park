<?php
// Database configuration
$host = "localhost"; // Change if using a different server
$dbname = "gitgud"; // Replace with your actual database name
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

?>
