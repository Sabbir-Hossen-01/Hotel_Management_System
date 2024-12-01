<?php
include 'db_connect.php'; // Reuse the connection logic

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $status = $_POST['status'];

    if (!empty($room_id) && !empty($status)) {
        $sql = "UPDATE rooms SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $room_id);

        if ($stmt->execute()) {
            echo "Room status updated successfully.";
        } else {
            echo "Error updating room status: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please provide all required inputs.";
    }
}

$conn->close();
?>

