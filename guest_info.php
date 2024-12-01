<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'hotel_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$guest_name = $_POST['guest_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$nationality = $_POST['nationality'];

// Insert data into the database
$sql = "INSERT INTO guests (guest_name, email, phone, address, nationality) VALUES ('$guest_name', '$email', '$phone', '$address', '$nationality')";

if ($conn->query($sql) === TRUE) {
    echo "Guest information successfully submitted.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
