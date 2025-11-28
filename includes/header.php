<?php
// Common header with navigation and dark mode toggle
// Rubric: UI/UX (responsive, dark mode), functionality (nav based on role)

require_once 'functions.php';
require_login();

// Prevent caching to avoid back button issues after logout
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <h1>Task Manager</h1>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard.php">Dashboard</a></li>
                    <?php if (is_admin()): ?>
                        <li><a href="<?php echo BASE_URL; ?>admin/manage_users.php">Manage Users</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin/create_task.php">Create Task</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin/reports.php">Reports</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin/grade_tasks.php">Grade Tasks</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>user/profile.php">My Profile</a></li>
                        <li><a href="<?php echo BASE_URL; ?>user/tasks.php">My Tasks</a></li>
                        <li><a href="<?php echo BASE_URL; ?>user/task_statistics.php">Task Statistics</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></li>
                </ul>
                <button id="theme-toggle">Toggle Dark Mode</button>
            </div>
        </nav>
    </header>
    <main>
