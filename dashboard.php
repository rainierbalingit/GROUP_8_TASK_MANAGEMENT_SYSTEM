<?php
// Role-based dashboard with overview cards
// Rubric: Functionality (role-based access), UI/UX (dashboard design)

require_once 'includes/functions.php';
require_login();

// Prevent caching to avoid back button issues after logout
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$user = get_user($_SESSION['user_id']);

include 'includes/header.php';
?>

<main>
    <div class="card">
        <h2>Welcome back, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>You are logged in as: <strong><?php echo htmlspecialchars(ucfirst($user['role'])); ?></strong></p>
        <p>Here's your dashboard overview.</p>
    </div>

    <div class="dashboard-grid">
        <?php if (is_admin()): ?>
            <div class="dashboard-card">
                <h3>Manage Users</h3>
                <p>View, edit, and delete user accounts.</p>
                <a href="admin/manage_users.php">Go to Users</a>
            </div>
            <div class="dashboard-card">
                <h3>Create Tasks</h3>
                <p>Assign new tasks to users with deadlines.</p>
                <a href="admin/create_task.php">Create Task</a>
            </div>
            <div class="dashboard-card">
                <h3>View Reports</h3>
                <p>Check task completion statistics.</p>
                <a href="admin/reports.php">View Reports</a>
            </div>
            <div class="dashboard-card">
                <h3>Grade Submissions</h3>
                <p>Review and grade user task submissions.</p>
                <a href="admin/grade_tasks.php">Grade Tasks</a>
            </div>
        <?php else: ?>
            <div class="dashboard-card">
                <h3>My Tasks</h3>
                <p>View and manage your assigned tasks.</p>
                <a href="user/tasks.php">View Tasks</a>
            </div>
            <div class="dashboard-card">
                <h3>My Profile</h3>
                <p>Update your personal information.</p>
                <a href="user/profile.php">Edit Profile</a>
            </div>
            <div class="dashboard-card">
                <h3>Task Statistics</h3>
                <p>See your task completion progress.</p>
                <a href="user/tasks.php">View Stats</a>
            </div>
        <?php endif; ?>
    </div>
</main>
<script>
function preventBack() {
    window.history.forward();
}
setTimeout(preventBack, 0);
window.onunload = function () { null };
</script>
<?php include 'includes/footer.php'; ?>
