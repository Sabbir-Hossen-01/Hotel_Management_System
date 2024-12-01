 <?php
// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=hotel_management", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Collect form data
$email = $_POST['email'] ?? null;

if (!$email) {
    die("Please enter an email.");
}

// Fetch the user data from the database based on the email
$query = "SELECT * FROM bookings WHERE email = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$email]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if ($booking) {
    // Display booking details
    echo "<h2>Your Booking Information:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Email</th><th>Number of Persons</th><th>Room Number</th><th>Check-in Date</th><th>Check-out Date</th><th>Booked At</th><th>Payment Method</th></tr>";
    echo "<tr>
            <td>" . htmlspecialchars($booking['email']) . "</td>
            <td>" . htmlspecialchars($booking['number_of_person']) . "</td>
            <td>" . htmlspecialchars($booking['room_number']) . "</td>
            <td>" . htmlspecialchars($booking['check_in_date']) . "</td>
            <td>" . htmlspecialchars($booking['check_out_date']) . "</td>
            <td>" . htmlspecialchars($booking['created_at']) . "</td>
            <td>" . htmlspecialchars($booking['payment_method']) . "</td>
          </tr>";
    echo "</table>";
} else {
    echo "<p>No booking found for the provided email.</p>";
}
?>
