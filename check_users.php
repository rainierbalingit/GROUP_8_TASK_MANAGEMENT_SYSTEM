<?php
require 'includes/db.php';
$stmt = $pdo->query('SELECT COUNT(*) FROM users');
echo 'Users in DB: ' . $stmt->fetchColumn();
?>
