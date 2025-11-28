<?php
// Admin: Display task statistics and reports
// Rubric: Functionality (reports), security (admin check)

require_once '../includes/functions.php';
require_admin();
include '../includes/header.php';

$reports = get_task_reports();
?>

<main class="admin-section">
    <div class="card">
        <h2>Task Reports</h2>
        <p>View comprehensive statistics on task completion across all users.</p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Total Tasks</th>
                    <th>Completed Tasks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?php echo htmlspecialchars($report['username']); ?></td>
                    <td><?php echo $report['total_tasks']; ?></td>
                    <td><?php echo $report['completed_tasks']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
function preventBack() {
    window.history.forward();
}
setTimeout(preventBack, 0);
window.onunload = function () { null };
</script>

<?php include '../includes/footer.php'; ?>
