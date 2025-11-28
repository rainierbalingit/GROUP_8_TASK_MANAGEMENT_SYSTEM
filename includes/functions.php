<?php
// Helper functions for sanitization, authentication, error handling
// Rubric: Security (sanitization, auth checks), error handling

require_once 'db.php';

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function is_admin() {
    return is_logged_in() && $_SESSION['role'] === 'admin';
}

// Check if user is the owner or admin
function can_access($user_id) {
    return is_logged_in() && ($_SESSION['user_id'] == $user_id || is_admin());
}

// Redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . 'login.php');
        exit;
    }
}

// Redirect if not admin
function require_admin() {
    if (!is_admin()) {
        header('Location: ' . BASE_URL . 'dashboard.php');
        exit;
    }
}

// Handle errors
function handle_error($message) {
    error_log($message);
    die("An error occurred. Please try again.");
}

// Validate file upload
function validate_file($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain'];
    $max_size = 5 * 1024 * 1024; // 5MB
    if (!in_array($file['type'], $allowed_types) || $file['size'] > $max_size) {
        return false;
    }
    return true;
}

// Get user by ID
function get_user($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Get tasks for user with submission and grade info
function get_user_tasks($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT t.*, s.grade, s.comment, s.submitted_at
        FROM tasks t
        LEFT JOIN submissions s ON t.id = s.task_id AND s.user_id = ?
        WHERE t.assigned_to = ?
        ORDER BY t.deadline ASC
    ");
    $stmt->execute([$user_id, $user_id]);
    return $stmt->fetchAll();
}

// Get all users (admin only)
function get_all_users() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

// Get task reports (admin only)
function get_task_reports() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT u.username, COUNT(t.id) as total_tasks,
               SUM(CASE WHEN t.status = 'completed' THEN 1 ELSE 0 END) as completed_tasks
        FROM users u
        LEFT JOIN tasks t ON u.id = t.assigned_to
        GROUP BY u.id
    ");
    return $stmt->fetchAll();
}
?>
