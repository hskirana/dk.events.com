<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $event_type = trim($_POST['event_type']);
    $event_date = trim($_POST['event_date']);
    $guests     = intval($_POST['guests']);
    $message    = trim($_POST['message']);

    $stmt = $pdo->prepare("
        INSERT INTO bookings (name, email, phone, event_type, event_date, guests, message)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([$name, $email, $phone, $event_type, $event_date, $guests, $message]);

    // Redirect to separate success page
    header("Location: booking_success.php");
    exit;
}
?>
