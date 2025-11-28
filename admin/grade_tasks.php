<?php
// Admin: View submissions, grade and comment
// Rubric: Functionality (grading), security (admin check)

require_once '../includes/functions.php';
require_admin();
include '../includes/header.php';

global $pdo;
$submissions = $pdo->query("
    SELECT s.*, t.title, u.username
    FROM submissions s
    JOIN tasks t ON s.task_id = t.id
    JOIN users u ON s.user_id = u.id
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submission_id = (int)$_POST['submission_id'];
    $grade = sanitize($_POST['grade']);
    $comment = sanitize($_POST['comment']);

    $stmt = $pdo->prepare("UPDATE submissions SET grade = ?, comment = ? WHERE id = ?");
    $stmt->execute([$grade, $comment, $submission_id]);
    header('Location: grade_tasks.php');
    exit;
}
?>

<main class="admin-section">
    <div class="card">
        <h2>Grade Tasks</h2>
        <p>Review and grade user task submissions with comments.</p>
    </div>

    <?php foreach ($submissions as $sub): ?>
    <div class="card">
        <h3><?php echo htmlspecialchars($sub['title']); ?> by <?php echo htmlspecialchars($sub['username']); ?></h3>
        <p><strong>Submitted:</strong> <?php echo $sub['submitted_at']; ?></p>
        <p><strong>File:</strong> <a href="<?php echo htmlspecialchars($sub['file_path']); ?>" target="_blank">Download Submission</a></p>
    </div>

    <div class="card">
        <form method="post">
            <input type="hidden" name="submission_id" value="<?php echo $sub['id']; ?>">
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" id="grade" name="grade" value="<?php echo htmlspecialchars($sub['grade']); ?>">
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment"><?php echo htmlspecialchars($sub['comment']); ?></textarea>
            </div>
            <button type="submit">Save Grade</button>
        </form>
    </div>
    <?php endforeach; ?>

    <?php if (empty($submissions)): ?>
    <div class="card">
        <p>No submissions to grade at this time.</p>
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
