<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us — Event Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* BLURRED BACKGROUND IMAGE */
body {
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    color: #fff;
    position: relative;
    overflow-x: hidden;
}

/* Blur overlay behind all content */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: url('ct.jpg') no-repeat center center fixed;
    background-size: cover;
    filter: blur(4px);
    z-index: -1;
}

/* TOP BAR */
.topbar {
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0, 0, 0, 0.89);
}

.brand {
    font-family: 'Merriweather', serif;
    font-size: 24px;
    font-weight: 700;
}

nav a {
    color: #fff;
    margin-left: 20px;
    text-decoration: none;
    font-size: 15px;
}

nav a:hover {
    opacity: .7;
}

/* GLASS EFFECT FORM CONTAINER */
.container {
    max-width: 900px;
    margin: 60px auto;
    padding: 40px;
    border-radius: 12px;

    /* Glass look */
    background: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
}

/* TEXT STYLES */
h1 {
    font-family: 'Merriweather', serif;
    font-size: 32px;
    margin-bottom: 10px;
}

p {
    opacity: .8;
    margin-bottom: 30px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
}

/* INPUTS */
input, textarea {
    width: 100%;
    padding: 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1px solid #444;
    background: rgba(0,0,0,0.6);
    color: #fff;
    font-size: 14px;
    outline: none;
}

input:focus, textarea:focus {
    border-color: #8c5bb7;
    box-shadow: 0 0 0 1px #b78ad6;
}

/* SUBMIT BUTTON */
button {
    width: 100%;
    padding: 14px;
    background: #8c5bb7;
    border: none;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    filter: brightness(1.1);
}

/* MAP */
.map {
    margin-top: 50px;
    border-radius: 12px;
    overflow: hidden;
}
    .btn-book{padding:12px 22px;border-radius:4px;border:2px solid rgba(255,255,255,.25);background:transparent;color:#ffffff;font-weight:600;text-decoration:none}


</style>

</head>
<body>

<header class="topbar">
    <div class="brand">Event Management System</div>
    <nav>
        <a href="index.html">Home</a>
        <a href="services.html">Services</a>
        <a href="about.html">About</a>
        <a href="portfolio.html">Portfolio</a>
        <a href="contact.php">Contact</a>
        <a class="btn-book" href="booking.php">Book Now</a>
    </nav>
</header>

<div class="container">
    <h1>Contact Us</h1>
    <p>Have questions or need help with planning your event? Send us a message!</p>

    <form method="post" action="contact_submit.php">

        <label>Your Name</label>
        <input type="text" name="name" required placeholder="Enter your name">

        <label>Email Address</label>
        <input type="email" name="email" required placeholder="you@example.com">

        <label>Phone Number</label>
        <input type="text" name="phone" required placeholder="+91 98765 43210">

        <label>Your Message</label>
        <textarea name="message" rows="5" required placeholder="How can we help you?"></textarea>

        <button type="submit">Send Message</button>
    </form>

    <div class="map">
<iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3889.7838249939077!2d77.4540391!3d12.857234499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae6ad428685d77%3A0x7cc353e755c103a6!2sVivekananda%20Institute%20of%20Technology!5e0!3m2!1sen!2sin!4v1764855499478!5m2!1sen!2sin"
    width="100%" 
    height="350" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>

    </div>

</div>

</body>
</html>
