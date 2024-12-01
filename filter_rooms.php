<?php
include 'db_connect.php';

$amenities = $_GET['amenities'] ?? [];

if (!empty($amenities)) {
    // Build SQL query for filtering
    $conditions = [];
    foreach ($amenities as $amenity) {
        $conditions[] = "amenities LIKE '%$amenity%'";
    }
    $where_clause = implode(' AND ', $conditions);
    $sql = "SELECT id, room_name, room_capacity, price, room_type, amenities FROM rooms WHERE $where_clause";
} else {
    $sql = "SELECT id, room_name, room_capacity, price, room_type, amenities FROM rooms";
}

$result = $conn->query($sql);

echo "<h1>Filtered Rooms</h1>";
echo "<table border='1' class='status-table'>";
echo "<tr><th>ID</th><th>Name</th><th>Capacity</th><th>Price</th><th>Type</th><th>Amenities</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['room_name']}</td>
                <td>{$row['room_capacity']}</td>
                <td>{$row['price']}</td>
                <td>{$row['room_type']}</td>
                <td>{$row['amenities']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No rooms match the selected amenities.</td></tr>";
}

echo "</table>";

$conn->close();
?>


