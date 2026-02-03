<?php
session_start();
require_once "db.php";

// Only logged-in admins
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Must have ID
if (!isset($_GET['id'])) {
    die("Invalid request!");
}

$id = intval($_GET['id']);

// DELETE the message using PDO
try {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$id]);

    // redirect back
    header("Location: admin_messages.php?deleted=1");
    exit;

} catch (Exception $e) {
    echo "ERROR deleting message: " . $e->getMessage();
}
?>
