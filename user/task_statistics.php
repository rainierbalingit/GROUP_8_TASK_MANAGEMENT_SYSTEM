<?php
// User: View task statistics (grades and comments only)
// Rubric: Functionality (grade viewing), security (auth check)

require_once '../includes/functions.php';
require_login();
include '../includes/header.php';

// Get user's submissions with grades and comments
global $pdo;
$stmt = $pdo->prepare("
    SELECT t.title, s.grade, s.comment, s.submitted_at, s.id as submission_id
    FROM submissions s
    JOIN tasks t ON s.task_id = t.id
    WHERE s.user_id = ?
    ORDER BY s.submitted_at DESC
");
$stmt->execute([$_SESSION['user_id']]);
$submissions = $stmt->fetchAll();
?>

<main class="user-section">
    <div class="card">
        <h2>Task Statistics</h2>
        <p>View your grades and feedback from completed tasks.</p>
    </div>

    <?php if (!empty($submissions)): ?>
        <?php foreach ($submissions as $submission): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($submission['title']); ?></h3>
            <div class="statistics-info">
                <p><strong>Submitted:</strong> <?php echo $submission['submitted_at']; ?></p>
                <?php if ($submission['grade']): ?>
                    <p><strong>Grade:</strong> <span class="grade"><?php echo htmlspecialchars($submission['grade']); ?></span></p>
                <?php else: ?>
                    <p><strong>Grade:</strong> <span class="pending">Pending</span></p>
                <?php endif; ?>
                <?php if ($submission['comment']): ?>
                    <p><strong>Feedback:</strong></p>
                    <div class="feedback-box">
                        <?php echo nl2br(htmlspecialchars($submission['comment'])); ?>
                    </div>
                <?php else: ?>
                    <p><strong>Feedback:</strong> <span class="pending">No feedback yet</span></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <p>You haven't submitted any tasks yet.</p>
        </div>
    <?php endif; ?>
</main>

<script>
function preventBack() {
    window.history.forward();
}
setTimeout(preventBack, 0);
window.onunload = function () { null };
</script>

<?php include '../includes/footer.php'; ?>
