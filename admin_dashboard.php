<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all bookings
$stmt = $pdo->query("SELECT * FROM bookings ORDER BY id DESC");
$bookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Bookings — Admin</title>

<style>
body{margin:0;background:#000;color:#fff;font-family:system-ui}
.sidebar{width:230px;height:100vh;background:#111;padding:20px;position:fixed}
.sidebar h2{color:#ffd66b;margin-bottom:30px}
.sidebar a{display:block;padding:12px;margin-bottom:8px;background:#222;color:#bbb;border-radius:6px;text-decoration:none}
.sidebar a:hover{background:#333}
.main{margin-left:250px;padding:30px}
.table-box{background:#111;padding:20px;border-radius:12px;margin-top:10px}
table{width:100%;border-collapse:collapse}
table th,table td{padding:10px;border-bottom:1px solid #333;text-align:left}
.btn{padding:6px 12px;border-radius:5px;font-size:14px;text-decoration:none}
.view{background:#3498db;color:#fff}
.edit{background:#f1c40f;color:#000}
.delete{background:#e74c3c;color:#fff}
.btn:hover{opacity:.8}



/* Top navigation */
    .topbar{background:var(--purple);padding:14px 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;position: absolute;top:10px;left: 870px;}
    .brand{display:flex;align-items:center;gap:12px}
    .brand img{height:200px;width:200px;object-fit:cover;border-radius:0px;position: absolute;top: -220px;left: -380px;}
    .brand h1{font-family:'Merriweather';font-weight:700;margin:0;font-size:18px;color:#fff}
    nav ul{list-style:none;margin:0;padding:0;display:flex;gap:22px;align-items:center}
    nav a{color:#fff;text-decoration:none;opacity:0.95;}
    .btn-book{padding:12px 22px;border-radius:4px;border:2px solid rgba(255,255,255,.25);background:transparent;color:#ffffff;font-weight:600;text-decoration:none}
    .hamburger{display:none;background:transparent;border:0;color:#fff;font-size:22px}

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
    <a href="admin_bookings.php" style="background:#333;">Bookings</a>
        <a href="admin_messages.php" style="background:#333;">Contact Messages</a>

    <a href="logout.php">Logout</a>

    <p style="margin-top:30px;color:#888;">
        Logged in as<br><?= htmlspecialchars($_SESSION['user_name']) ?>
    </p>
</div>

<div class="main">
    <h1>All Bookings</h1>

    <div class="table-box">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Event</th>
                <th>Date</th>
                <th>Guests</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($bookings as $b): ?>
            <tr>
                <td><?= $b['id'] ?></td>
                <td><?= htmlspecialchars($b['name']) ?></td>
                <td><?= htmlspecialchars($b['event_type']) ?></td>
                <td><?= $b['event_date'] ?></td>
                <td><?= $b['guests'] ?></td>
                <td>
                    <a class="btn view" href="admin_booking_view.php?id=<?= $b['id'] ?>">View</a>
                    <a class="btn edit" href="admin_booking_edit.php?id=<?= $b['id'] ?>">Edit</a>
                    <a class="btn delete" href="admin_booking_delete.php?id=<?= $b['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this booking?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

</body>
</html>
