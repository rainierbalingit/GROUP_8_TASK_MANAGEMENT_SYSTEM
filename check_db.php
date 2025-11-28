<?php
require 'includes/db.php';
try {
    $pdo->query('SELECT 1 FROM users LIMIT 1');
    echo 'Tables exist.';
} catch (Exception $e) {
    echo 'Tables do not exist: ' . $e->getMessage();
}
?>
