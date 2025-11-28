<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Default XAMPP user
define('DB_PASS', '');      // Default XAMPP password (empty)
define('DB_NAME', 'task_manager_db');

// CSRF token generation for security
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Base URL for absolute paths
define('BASE_URL', '/task_management_system/');
