<?php
require 'includes/db.php';
$stmt = $pdo->query('SELECT username, email, role FROM users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Existing users:\n";
foreach ($users as $user) {
    echo "- {$user['username']} ({$user['email']}) - {$user['role']}\n";
}
?>
