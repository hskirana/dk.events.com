<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Your Event</title>

<style>

body {
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    background: url('bok.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
    
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: url('bok.jpg') no-repeat center center fixed;
    background-size: cover;
    filter: blur(4px);
    z-index: -1;
}

.container{
    max-width:500px;
    margin:80px auto;
    background: #111111e3;;
    padding:25px;
    border-radius:10px;
    box-shadow:0 10px 35px rgba(0,0,0,.5);
}

h2{
    text-align:center;
    margin-bottom:20px;
    font-family:'Merriweather', serif;
}

label{
    font-size:14px;
    margin-bottom:5px;
    display:block;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:none;
    border-radius:6px;
    background:#222;
    color:#fff;
    font-size:14px;
}

textarea{
    height:90px;
}

button{
    width:100%;
    padding:12px;
    background:#8c5bb7;
    border:none;
    border-radius:6px;
    color:#fff;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#a16ed1;
}

.success{
    background:rgba(0,255,0,0.15);
    border:1px solid green;
    padding:10px;
    text-align:center;
    margin-bottom:15px;
    color:#8fff8f;
}

 /* Top navigation */
    .topbar{background:var(--purple);padding:14px 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;position: absolute;top:10px;left: 870px;}
    .brand{display:flex;align-items:center;gap:12px}
    .brand img{height:200px;width:200px;object-fit:cover;border-radius:0px;position: absolute;top: -220px;left: -380px;}
    .brand h1{font-family:'Merriweather';font-weight:700;margin:0;font-size:18px;color:#fff}
    nav ul{list-style:none;margin:0;padding:0;display:flex;gap:22px;align-items:center}
    nav a{color:#fff;text-decoration:none;opacity:0.95;}
    .btn-book{padding:12px 22px;border-radius:4px;border:2px solid rgba(255,255,255,.25);background:transparent;color:#ffffff;font-weight:600;text-decoration:none}
    .hamburger{display:none;background:transparent;border:0;color:#fff;font-size:22px}

</style>

</head>
<body>

  <header class="topbar">

    <nav>
      <button class="hamburger" aria-label="menu" onclick="toggleNav()">☰</button>
      <ul id="mainNav">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a class="btn-book" href="booking.php">Book Now</a></li>
      </ul>
    </nav>
  </header>

<div class="container">
    <h2>Book Your Event</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="success">Your booking was submitted successfully!</div>
    <?php endif; ?>

    <form action="booking_insert.php" method="POST">

        <label>Your Name</label>
        <input type="text" name="name" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Phone Number</label>
        <input type="text" name="phone" required>

        <label>Event Type</label>
        <select name="event_type" required>
            <option value="">Select Event</option>
            <option>Wedding</option>
            <option>Birthday Party</option>
            <option>Corporate Event</option>
            <option>Baby Shower</option>
            <option>Other</option>
        </select>

        <label>Event Date</label>
        <input type="date" name="event_date" required>

        <label>No. of Guests</label>
        <input type="number" name="guests" required>

        <label>Message (optional)</label>
        <textarea name="message"></textarea>

        <button type="submit">Submit Booking</button>
    </form>
</div>

</body>
</html>
