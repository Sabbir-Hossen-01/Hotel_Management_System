<?php
// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=hotel_management", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Collect and validate form data
$email = $_POST['email'] ?? null;
$number_of_person = $_POST['number_of_person'] ?? null;
$check_in_date = $_POST['check_in_date'] ?? null;
$check_out_date = $_POST['check_out_date'] ?? null;
$room_number = $_POST['room_number'] ?? null;
$payment_method = $_POST['payment_method'] ?? null;

if (!$email || !$number_of_person || !$check_in_date || !$check_out_date || !$room_number || !$payment_method) {
    die("Please fill in all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

if (strtotime($check_out_date) <= strtotime($check_in_date)) {
    die("Check-out date must be after the check-in date.");
}

// Insert booking into the database
try {
    $stmt = $pdo->prepare("
        INSERT INTO bookings (email, number_of_person, check_in_date, check_out_date, room_number, payment_method) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$email, $number_of_person, $check_in_date, $check_out_date, $room_number, $payment_method]);

    echo "Booking successful! Your room number: " . htmlspecialchars($room_number) . " and payment method: " . htmlspecialchars($payment_method);
} catch (PDOException $e) {
    die("Error saving booking: " . $e->getMessage());
}
?>



