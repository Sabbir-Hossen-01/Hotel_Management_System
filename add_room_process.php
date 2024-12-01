<?php
// Include the database connection
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user inputs from the form
    $room_name = $_POST['room_name'] ?? '';
    $room_capacity = $_POST['room_capacity'] ?? 0;
    $price = $_POST['price'] ?? 0.00;
    $room_type = $_POST['room_type'] ?? '';
    $amenities = isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : ''; // Join amenities as a comma-separated string

    // Validate inputs
    if (!empty($room_name) && !empty($room_type) && $room_capacity > 0 && $price > 0) {
        // Prepare the SQL query to insert the room into the database
        $sql = "INSERT INTO rooms (room_name, room_capacity, price, room_type, amenities) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Correct the type string to match the five parameters
            $stmt->bind_param("sidss", $room_name, $room_capacity, $price, $room_type, $amenities);

            // Execute the query
            if ($stmt->execute()) {
                echo "Room added successfully  $amenities";
            } else {
                echo "Error executing query: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing query: " . $conn->error;
        }
    } else {
        echo "Invalid input. Please fill out all fields correctly.";
    }
} else {
    echo "No form data received.";
}

// Close the database connection
$conn->close();
?>

