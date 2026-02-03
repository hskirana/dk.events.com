<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new = $_POST["new_password"];

    if (strlen($new) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $hash = password_hash($new, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("UPDATE users SET password_hash=? WHERE id=?");
        $stmt->execute([$hash, $_SESSION['user_id']]);

        $success = "Password updated successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>
<style>
body{background:#000;color:#fff;font-family:'Open Sans',sans-serif;padding:30px}
form{max-width:400px;background:#111;padding:20px;margin:auto;border-radius:10px}
input{width:100%;padding:10px;margin-bottom:10px;background:#222;border:1px solid #555;color:#fff}
button{padding:10px 20px;background:#8c5bb7;border:none;color:#fff;border-radius:6px}
.success{background:#2e7d32;padding:10px;margin-bottom:10px}
.error{background:#b71c1c;padding:10px;margin-bottom:10px}
</style>
</head>
<body>

<h2>Admin Profile</h2>

<?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
<?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

<form method="post">
    <label>New Password</label>
    <input type="password" name="new_password" required>

    <button type="submit">Change Password</button>
</form>

</body>
</html>
