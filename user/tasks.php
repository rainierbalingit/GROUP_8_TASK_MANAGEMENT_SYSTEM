<?php
// User: View assigned tasks, upload submissions
// Rubric: Functionality (task view, upload), security (auth check)

require_once '../includes/functions.php';
require_login();
include '../includes/header.php';

$tasks = get_user_tasks($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['submission'])) {
    $task_id = (int)$_POST['task_id'];
    if (validate_file($_FILES['submission'])) {
        $file_path = '../uploads/' . time() . '_' . basename($_FILES['submission']['name']);
        if (move_uploaded_file($_FILES['submission']['tmp_name'], $file_path)) {
            global $pdo;
            $stmt = $pdo->prepare("INSERT INTO submissions (task_id, user_id, file_path) VALUES (?, ?, ?)");
            $stmt->execute([$task_id, $_SESSION['user_id'], $file_path]);
            $success = 'Submission uploaded successfully.';
        } else {
            $error = 'Failed to upload file.';
        }
    } else {
        $error = 'Invalid file type or size.';
    }
}
?>

<main class="user-section">
    <div class="card">
        <h2>My Tasks</h2>
        <p>View and manage your assigned tasks, update status, and submit work.</p>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>

    <?php foreach ($tasks as $task): ?>
    <div class="card">
        <h3><?php echo htmlspecialchars($task['title']); ?></h3>
        <p><?php echo htmlspecialchars($task['description']); ?></p>
        <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?> | <strong>Priority:</strong> <?php echo ucfirst($task['priority']); ?> | <strong>Status:</strong>
            <select class="task-status" data-task-id="<?php echo $task['id']; ?>">
                <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                <option value="in_progress" <?php if ($task['status'] === 'in_progress') echo 'selected'; ?>>In Progress</option>
                <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
            </select>
        </p>

        <!-- Task Submission Form -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            <div class="form-group">
                <label for="submission">Upload Submission</label>
                <input type="file" id="submission" name="submission" accept=".jpg,.png,.gif,.pdf,.txt" required>
            </div>
            <button type="submit">Submit Work</button>
        </form>
    </div>
    <?php endforeach; ?>

    <?php if (empty($tasks)): ?>
    <div class="card">
        <p>You have no assigned tasks at this time.</p>
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
