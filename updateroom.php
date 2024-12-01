<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $room_name = $_POST['room_name'];
    $room_capacity = $_POST['room_capacity'];
    $price = $_POST['price'];
    $room_type = $_POST['room_type'];

    $sql = "UPDATE rooms SET room_name = ?, room_capacity = ?, price = ?, room_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssdis", $room_name, $room_capacity, $price, $room_type, $id);
        if ($stmt->execute()) {
            echo "Room updated successfully.";
        } else {
            echo "Error updating room: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
    $conn->close();
}
?>
