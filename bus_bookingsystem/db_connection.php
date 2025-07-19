<?php
$host = "localhost";        // Your database host
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$database = "bus"; // Replace with your actual database name

// Create a connection
$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Optional: Set charset
$con->set_charset("utf8");
?>
