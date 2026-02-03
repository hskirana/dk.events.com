<?php
// login.php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please enter both email and password.';
    } else {
$stmt = $pdo->prepare('SELECT id, name, email, password_hash FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    // Login success
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    
    header('Location: admin_dashboard.php');
    exit;
}

 else {
    $error = 'Invalid email or password.';
}

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login — Event Management System</title>

  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    :root{
      --purple:#b78ad6;
      --purple-dark:#8c5bb7;
      --text:#fdfdfd;
      --bg:#111;
      --max-width:1100px;
    }

    *{box-sizing:border-box;margin:0;padding:0}

    body{
      font-family:'Open Sans',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
      color:var(--text);
      background:#000;
      min-height:100vh;
    }

    a{text-decoration:none;color:inherit}

    /* background video / image */
    .hero-bg{
      position:fixed;
      inset:0;
      z-index:-1;
      overflow:hidden;
    }

    .hero-bg video,
    .hero-bg img{
      width:100%;
      height:100%;
      object-fit:cover;
      filter:brightness(.45);
      transform:scale(1.03);
    }

    /* TOP BAR */
    .topbar{
      position:absolute;
      top:0;
      left:0;
      width:100%;
      padding:16px 40px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      z-index:10;
    }

    .brand-mini{
      display:flex;
      align-items:center;
      gap:10px;
      color:#fff;
    }

    .brand-mini-logo{
      width:40px;
      height:40px;
      background:#ffd66b url("img/logo-small.png") center/cover no-repeat;
      border-radius:100px;
    }

    .brand-mini span{
      font-family:'Merriweather',serif;
      font-size:20px;
      font-weight:700;
      letter-spacing:.04em;
      white-space:nowrap;
    }

    .top-nav ul{
      list-style:none;
      display:flex;
      gap:20px;
      align-items:center;
    }

    .top-nav a{
      font-size:16px;
      color:#fff;
      opacity:.95;
      letter-spacing:.5px;
      transition:.2s ease;
    }

    .top-nav a:hover{opacity:1}

    .btn-book{
      padding:10px 22px;
      border-radius:4px;
      border:1px solid rgba(255,255,255,.7);
      font-size:16px;
      font-weight:600;
      background:transparent;
    }

    /* CENTER LOGIN CARD */
    .page-wrap{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:80px 16px 40px;
    }

    .login-card{
      width:100%;
      max-width:420px;
      background:rgba(17, 17, 17, 0);
      border-radius:10px;
      padding:32px 26px 28px;
      box-shadow:0 18px 40px rgba(0,0,0,.65);
      color:#f5f5f5;
    }

    .login-title{
      font-family:'Merriweather',serif;
      font-size:24px;
      margin-bottom:4px;
      text-align:center;
    }

    .login-sub{
      font-size:13px;
      text-align:center;
      opacity:.85;
      margin-bottom:22px;
    }

    label{
      font-size:13px;
      margin-bottom:6px;
      display:block;
    }

    input[type="email"],
    input[type="password"]{
      width:100%;
      padding:10px 12px;
      border-radius:6px;
      border:1px solid #444;
      background:#161616;
      color:#f1f1f1;
      font-size:14px;
      margin-bottom:14px;
      outline:none;
    }

    input[type="email"]:focus,
    input[type="password"]:focus{
      border-color:var(--purple-dark);
      box-shadow:0 0 0 1px rgba(184,138,214,.6);
    }

    .btn-login{
      width:100%;
      padding:10px 16px;
      border-radius:6px;
      border:none;
      font-size:15px;
      font-weight:600;
      background:var(--purple-dark);
      color:#fff;
      cursor:pointer;
      margin-top:4px;
    }

    .btn-login:hover{
      filter:brightness(1.08);
    }

    .error{
      background:rgba(255,80,80,.12);
      border:1px solid rgba(255,80,80,.6);
      color:#ffb3b3;
      font-size:13px;
      padding:8px 10px;
      border-radius:6px;
      margin-bottom:12px;
    }

    .small-text{
      font-size:12px;
      opacity:.8;
      margin-top:12px;
      text-align:center;
    }

    @media (max-width:700px){
      .topbar{
        padding:12px 16px;
        flex-direction:column;
        align-items:flex-start;
        gap:6px;
      }
      .brand-mini span{
        font-size:16px;
      }
      .top-nav ul{
        gap:12px;
        flex-wrap:wrap;
        font-size:14px;
      }
      .page-wrap{
        padding-top:120px;
      }
    }
  </style>
</head>
<body>

  <!-- Background: use a video OR replace with an image -->
  <div class="hero-bg">
    <!-- Example if you have a video: -->
    <!-- <video autoplay muted loop playsinline>
      <source src="vk.mp4" type="video/mp4">
    </video> -->

    <!-- If you prefer an image instead of video: -->
    <img src="login.jpg" alt="Event background">
  </div>

  <!-- TOP NAV -->
  <header class="topbar">
    <div class="brand-mini">
      <div class="brand-mini-logo"></div>
      <span>Event Management System</span>
    </div>

    <nav class="top-nav">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a class="btn-book" href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <div class="page-wrap">
    <form class="login-card" method="post" action="login.php">
      <h1 class="login-title">Sign In</h1>
      <p class="login-sub">Log in to manage your events, bookings, and clients.</p>

      <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <label for="email">Email address</label>
      <input type="email" id="email" name="email" required
             placeholder="you@example.com" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="Enter your password">

      <button type="submit" class="btn-login">Log In</button>

      <p class="small-text">
        Forgot your password? Ask the site administrator to reset your account.
      </p>
    </form>
  </div>

</body>
</html>
