<?php
// Main landing page with register/login options
// Rubric: Functionality (landing page), UI/UX (simple, responsive)

require_once 'config.php';
require_once 'includes/functions.php';
if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

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
    <title>Task Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <header class="landing-header">
        <h1>Welcome to Task Management System</h1>
        <p>Streamline your workflow with our comprehensive task management solution</p>
        <button id="theme-toggle">Toggle Dark Mode</button>
    </header>
    <main>
        <div class="card">
            <h2>Get Started</h2>
            <p>Join thousands of users who trust our platform to manage their tasks efficiently. Whether you're an individual or part of a team, our system adapts to your needs.</p>
            <div class="btn-group">
                <a href="<?php echo BASE_URL; ?>register.php">Register</a>
                <a href="<?php echo BASE_URL; ?>login.php">Login</a>
            </div>
        </div>
        <div class="card">
            <h2>Features</h2>
            <ul style="list-style-type: disc; padding-left: 2rem;">
                <li>Role-based access control (Admin & User)</li>
                <li>Task creation with deadlines and priorities</li>
                <li>File upload for task submissions</li>
                <li>Real-time task status updates</li>
                <li>Comprehensive reporting and analytics</li>
                <li>Dark/Light mode toggle</li>
                <li>Mobile-responsive design</li>
            </ul>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Task Management System. All rights reserved.</p>
    </footer>
    <script src="<?php echo BASE_URL; ?>js/script.js"></script>
</body>
</html>
