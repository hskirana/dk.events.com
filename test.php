<?php
require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(['kiranhs@gmail.com']);
$user = $stmt->fetch();
var_dump($user);

echo password_verify("kiran@123", $user["password_hash"]) ? "PASSWORD OK" : "PASSWORD FAIL";
