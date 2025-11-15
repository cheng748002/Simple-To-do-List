<?php
require_once '../config/database.php';
require_once 'auth_check.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header("Location: index.php");
exit;
?>