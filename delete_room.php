<?php
// Database configuration
$servername = "localhost"; // Replace with your database server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "hotel_management"; // Replace with your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = trim($_POST['room_name']); // Get room name from form input and sanitize it

    if (!empty($room_name)) {
        // Prepare and execute the DELETE query
        $stmt = $conn->prepare("DELETE FROM rooms WHERE room_name = ?");
        $stmt->bind_param("s", $room_name);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Room '$room_name' has been successfully deleted";
            } else {
                echo "Room '$room_name' not found";
            }
        } else {
            echo "<p Error deleting the room: " . $conn->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "Please enter a valid room name.</p>";
    }
}

// Close the database connection
$conn->close();
?>

