<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? 0;

$stmt = $pdo->prepare("DELETE FROM bookings WHERE id=?");
$stmt->execute([$id]);

header("Location: admin_bookings.php");
exit;
?>
