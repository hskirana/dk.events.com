<?php
session_start();
require_once "db.php";

// Only logged-in admins can access
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all contact messages
$stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY id DESC");
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact Messages — Admin</title>

<style>
body { margin:0; background:#000; color:#fff; font-family:system-ui; }

.sidebar {
    width:230px;
    height:100vh;
    background:#111;
    padding:20px;
    position:fixed;
}
.sidebar h2 { color:#ffd66b; margin-bottom:30px; }
.sidebar a {
    display:block;
    padding:12px;
    margin-bottom:8px;
    background:#222;
    color:#bbb;
    border-radius:6px;
    text-decoration:none;
}
.sidebar a:hover { background:#333; }

.main { margin-left:250px; padding:30px; }
.table-box {
    background:#111;
    padding:20px;
    border-radius:12px;
    margin-top:10px;
}

table { width:100%; border-collapse:collapse; }
table th, table td {
    padding:10px;
    border-bottom:1px solid #333;
    text-align:left;
}

.btn { padding:6px 12px; border-radius:5px; font-size:14px; text-decoration:none; }

/* DELETE BUTTON */
.delete {
    background:#e74c3c;
    color:#fff;
    padding:6px 14px;
    border-radius:6px;
    text-decoration:none;
    font-weight:600;
}
.delete:hover { opacity:.8; }

.topbar {
    background:#2c1f35;
    padding:14px 28px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    position:absolute;
    top:10px;
    left:870px;
}
nav ul { list-style:none; margin:0; padding:0; display:flex; gap:22px; }
nav a { color:#fff; text-decoration:none; opacity:.95; }

.btn-book {
    padding:12px 22px;
    border-radius:4px;
    border:2px solid rgba(255,255,255,.25);
    background:transparent;
    color:#ffffff;
    font-weight:600;
    text-decoration:none;
}
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

    <p style="margin-top:30px;color:#888;">
        Logged in as<br><?= htmlspecialchars($_SESSION['user_name']) ?>
    </p>
</div>

<div class="main">
    <h1>Contact Messages</h1>
    <?php if (isset($_GET['deleted'])): ?>
    <div style="background:#1b4; padding:10px; border-radius:6px; margin-bottom:10px;">
        Message deleted successfully!
    </div>
<?php endif; ?>


    <div class="table-box">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['phone']) ?></td>
                <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
                <td><?= $m['created_at'] ?></td>

                <!-- DELETE BUTTON -->
<td>
<a href="message_delete_action.php?id=<?= $m['id'] ?>"

       class="delete"
       onclick="return confirm('Are you sure you want to delete this message?');">
       🗑 Delete
    </a>
</td>


            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

</body>
</html>
