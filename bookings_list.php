<?php
require_once "db.php";

// Fetch all bookings
$stmt = $pdo->query("SELECT * FROM bookings ORDER BY id DESC");
$bookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookings — Event Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    background:#000;
    color:#fff;
    font-family:'Open Sans', sans-serif;
    margin:0;
    padding:0;
}

/* Page Header */
.header{
    padding:20px 40px;
    background:#151414aa;
    backdrop-filter: blur(6px);
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #333;
}

.header h1{
    font-family:'Merriweather', serif;
    font-size:26px;
}

.header a{
    text-decoration:none;
    padding:10px 20px;
    background:#8c5bb7;
    color:#fff;
    border-radius:6px;
    font-weight:600;
    letter-spacing:.4px;
}

.header a:hover{
    background:#a970d6;
}

/* Table container */
.table-container{
    margin:40px auto;
    max-width:1200px;
    background:#121212;
    padding:20px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,.6);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

table th, table td{
    padding:14px;
    font-size:14px;
    border-bottom:1px solid #333;
}

table th{
    background:#1d1d1d;
    font-size:15px;
    text-align:left;
    letter-spacing:.5px;
}

table tr:hover{
    background:#1c1c1c;
    transition:0.2s;
}

.no-data{
    text-align:center;
    padding:40px;
    color:#bbb;
    font-size:16px;
}
</style>

</head>
<body>

<div class="header">
    <h1>All Bookings</h1>
    <a href="index.html">Back to Home</a>
</div>

<div class="table-container">

<?php if (count($bookings) === 0): ?>
    <div class="no-data">No bookings found yet.</div>
<?php else: ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Event Type</th>
            <th>Event Date</th>
            <th>Guests</th>
            <th>Message</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= htmlspecialchars($b['email']) ?></td>
            <td><?= htmlspecialchars($b['phone']) ?></td>
            <td><?= htmlspecialchars($b['event_type']) ?></td>
            <td><?= htmlspecialchars($b['event_date']) ?></td>
            <td><?= htmlspecialchars($b['guests']) ?></td>
            <td><?= htmlspecialchars($b['message']) ?></td>
            <td><?= htmlspecialchars($b['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?php endif; ?>

</div>

</body>
</html>
