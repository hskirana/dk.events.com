<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

// Fetch booking
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$id]);
$booking = $stmt->fetch();

if (!$booking) {
    die("Booking not found.");
}

// If form submitted → update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $event_type = trim($_POST['event_type']);
    $event_date = trim($_POST['event_date']);
    $guests     = intval($_POST['guests']);
    $message    = trim($_POST['message']);

    $update = $pdo->prepare("
        UPDATE bookings SET 
            name = ?, email = ?, phone = ?, 
            event_type = ?, event_date = ?, 
            guests = ?, message = ?
        WHERE id = ?
    ");

    $update->execute([
        $name, $email, $phone,
        $event_type, $event_date,
        $guests, $message,
        $id
    ]);

    header("Location: admin_bookings.php?updated=1");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Booking</title>

<style>
body {
    margin:0;
    background:#000;
    color:#fff;
    font-family:system-ui;
}

.container {
    width:600px;
    margin:50px auto;
    padding:30px;
    background:#111;
    border-radius:12px;
}

h2 {
    margin-bottom:20px;
    color:#ffd66b;
    font-size:26px;
}

label {
    display:block;
    margin-top:12px;
    font-size:14px;
    opacity:.8;
}

input, textarea, select {
    width:100%;
    padding:10px;
    margin-top:6px;
    background:#222;
    border:1px solid #333;
    border-radius:6px;
    color:#fff;
    font-size:15px;
}

textarea {
    height:100px;
    resize:none;
}

button {
    margin-top:20px;
    width:100%;
    padding:12px;
    background:#ffd66b;
    color:#000;
    border:none;
    border-radius:6px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover {
    opacity:.9;
}

a {
    color:#ffd66b;
    text-decoration:none;
    display:inline-block;
    margin-top:15px;
}
</style>

</head>
<body>

<div class="container">

    <h2>Edit Booking #<?= $booking['id'] ?></h2>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>

        <label>Phone</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($booking['phone']) ?>" required>

        <label>Event Type</label>
        <input type="text" name="event_type" value="<?= htmlspecialchars($booking['event_type']) ?>" required>

        <label>Event Date</label>
        <input type="date" name="event_date" value="<?= $booking['event_date'] ?>" required>

        <label>Guests</label>
        <input type="number" name="guests" value="<?= $booking['guests'] ?>" required>

        <label>Message</label>
        <textarea name="message"><?= htmlspecialchars($booking['message']) ?></textarea>

        <button type="submit">Save Changes</button>
    </form>

    <a href="admin_bookings.php">← Back to Bookings</a>

</div>

</body>
</html>
