<?php
// Logout script to destroy session and redirect
// Rubric: Security (session destruction), functionality (logout)

require_once 'config.php';
session_destroy();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
</head>
<body>
    <script>
        // Clear browser history to prevent back navigation
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        // Redirect to index.php without allowing back navigation
        window.location.replace('index.php');
    </script>
</body>
</html>
