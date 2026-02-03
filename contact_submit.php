<?php
require "db.php";

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$message = trim($_POST['message']);

$stmt = $pdo->prepare("
    INSERT INTO contact_messages (name, email, phone, message, created_at) 
    VALUES (?, ?, ?, ?, NOW())
");

$stmt->execute([$name, $email, $phone, $message]);

header("Location: contact_success.php");
exit;
?>
