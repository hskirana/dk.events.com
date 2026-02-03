<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$id]);
$b = $stmt->fetch();

if (!$b) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Booking</title>
<style>
body{background:#000;color:#fff;font-family:system-ui;padding:40px}
.box{background:#111;padding:30px;border-radius:12px;width:450px;margin:auto}
label{opacity:.8}
p{margin:6px 0 18px}
a{color:#ffd66b}
</style>
</head>
<body>

<div class="box">
    <h2>Booking Details</h2>

    <label>Name</label><p><?= htmlspecialchars($b['name']) ?></p>

    <label>Email</label><p><?= htmlspecialchars($b['email']) ?></p>

    <label>Phone</label><p><?= htmlspecialchars($b['phone']) ?></p>

    <label>Event Type</label><p><?= htmlspecialchars($b['event_type']) ?></p>

    <label>Date</label><p><?= $b['event_date'] ?></p>

    <label>Guests</label><p><?= $b['guests'] ?></p>

    <label>Message</label><p><?= nl2br(htmlspecialchars($b['message'])) ?></p>

    <br>
    <a href="admin_bookings.php">← Back to Bookings</a>
</div>

</body>
</html>
