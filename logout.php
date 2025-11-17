<?php
// Logout script to destroy session and redirect
// Rubric: Security (session destruction), functionality (logout)

require_once 'config.php';
session_destroy();
header('Location: index.php');
exit;
?>
