<?php
require 'db.php';

$name  = 'Admin User';
$email = 'admin@example.com';
$pass  = 'admin123';

$hash = password_hash($pass, PASSWORD_DEFAULT);

$pdo->prepare('DELETE FROM users WHERE email = ?')->execute([$email]);

$stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
$stmt->execute([$name, $email, $hash]);

echo "Admin user created.<br>";
echo "Email: {$email}<br>";
echo "Password: {$pass}";
