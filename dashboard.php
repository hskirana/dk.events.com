<?php
// dashboard.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard — Event Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body{
      font-family:'Open Sans',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
      background:#f7f7f7;
      margin:0;
      padding:40px 20px;
      color:#333;
    }
    .wrapper{
      max-width:900px;
      margin:0 auto;
      background:#fff;
      border-radius:8px;
      padding:24px 24px 30px;
      box-shadow:0 10px 26px rgba(0,0,0,.08);
    }
    h1{
      font-family:'Merriweather',serif;
      margin-top:0;
    }
    .top{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:10px;
    }
    a.btn{
      padding:8px 16px;
      border-radius:4px;
      border:none;
      font-size:14px;
      font-weight:600;
      background:#8c5bb7;
      color:#fff;
      text-decoration:none;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="top">
      <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
      <a class="btn" href="index.html" >Logout</a>
    </div>
    <p>
      You’re logged in to the Event Management System. Here you could show upcoming events,
      bookings, client messages, and other admin tools.
    </p>
  </div>
</body>
</html>
