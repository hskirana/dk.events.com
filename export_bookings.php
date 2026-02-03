<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=bookings.csv");

$output = fopen("php://output", "w");

fputcsv($output, ["ID","Name","Email","Phone","Event Type","Event Date","Guests","Message","Created At"]);

$stmt = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
