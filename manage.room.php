<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $guests = $_POST['guests'];

    $sql = "INSERT INTO bookings (location, check_in, check_out, guests) 
            VALUES ('$location', '$check_in', '$check_out', '$guests')";
    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

