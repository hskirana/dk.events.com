<?php
session_start();
require_once 'db.php';

// Block access if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// COUNT TOTAL BOOKINGS
$totalBookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

// TODAY BOOKINGS
$today = date('Y-m-d');
$todayBookings = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE event_date = ?");
$todayBookings->execute([$today]);
$todayCount = $todayBookings->fetchColumn();

// UPCOMING BOOKINGS
$upcomingBookings = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE event_date > ?");
$upcomingBookings->execute([$today]);
$upcomingCount = $upcomingBookings->fetchColumn();

// CLIENTS REGISTERED
$clients = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Fetch latest 5 bookings
$latest = $pdo->query("SELECT * FROM bookings ORDER BY id DESC LIMIT 5")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body {
    margin: 0;
    background: #000;
    color: #fff;
    font-family: system-ui, sans-serif;
}

.sidebar {
    width: 230px;
    height: 100vh;
    background: #111;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    color: #ffd66b;
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    padding: 12px;
    margin-bottom: 8px;
    background: #222;
    color: #bbb;
    border-radius: 6px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #333;
}

.main {
    margin-left: 250px;
    padding: 30px;
}

.card-container {
    display: flex;
    gap: 20px;
}

.card {
    background: #111;
    padding: 25px;
    width: 230px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(255,255,255,0.1);
}

.table-box {
    background: #111;
    margin-top: 30px;
    padding: 20px;
    border-radius: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    border-bottom: 1px solid #333;
}
.hero-bg img{
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(.35);
    transform:scale(1.03);}

    .hero-bg{
    position:fixed;
    inset:0;
    z-index:-1;
    overflow:hidden;
}
.hero-bg img{
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(.35);
    transform:scale(1.03);}
</style>
</head>
<body>
    <div class="hero-bg">
  <img src="manager.png" alt="Event background">
</div>
<div class="sidebar">
    <h2>Event Manager</h2>



    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_bookings.php">Bookings</a>
        <a href="admin_messages.php" style="background:#333;">Contact Messages</a>
    <a href="logout.php">Logout</a>

    <p style="margin-top: 30px; color: #888;">
        Logged in as<br><?= htmlspecialchars($_SESSION['user_name']) ?>
    </p>
</div>

<div class="main">
    <h1>Dashboard Overview</h1>

    <div class="card-container">
        <div class="card">
            <h3>Total Bookings</h3>
            <span style="font-size: 32px;"><?= $totalBookings ?></span>
        </div>

        <div class="card">
            <h3>Today's Events</h3>
            <span style="font-size: 32px;"><?= $todayCount ?></span>
        </div>

        <div class="card">
            <h3>Upcoming Events</h3>
            <span style="font-size: 32px;"><?= $upcomingCount ?></span>
        </div>

        <div class="card">
            <h3>Clients Registered</h3>
            <span style="font-size: 32px;"><?= $clients ?></span>
        </div>
    </div>

    <div class="table-box">
        <h2>Latest Bookings</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Event Type</th>
                <th>Date</th>
                <th>Guests</th>
            </tr>

            <?php foreach ($latest as $b): ?>
            <tr>
                <td><?= $b['id'] ?></td>
                <td><?= htmlspecialchars($b['name']) ?></td>
                <td><?= htmlspecialchars($b['event_type']) ?></td>
                <td><?= $b['event_date'] ?></td>
                <td><?= $b['guests'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>

</body>
</html>
