<?php
// Database connection details
$servername = "localhost"; // Change if necessary
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "hotel_management"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>