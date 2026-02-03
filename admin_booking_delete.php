<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

if (!$id) {
    die("Invalid ID.");
}

// DELETE the record
$stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
$stmt->execute([$id]);

// Go back with success message
header("Location: admin_bookings.php?deleted=1");
exit;
?>
