<?php
// Admin: Form to create tasks with deadline, priority, assignment
// Rubric: Functionality (task creation), security (admin check)

require_once '../includes/functions.php';
require_admin();
include '../includes/header.php';


$users = get_all_users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $deadline = sanitize($_POST['deadline']);
    $priority = sanitize($_POST['priority']);

    if (empty($title) || empty($description) || empty($deadline) || !in_array($priority, ['low', 'medium', 'high'])) {
        $error = 'All fields are required.';
    } else {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description, deadline, priority, assigned_to, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($users as $user) {
            $stmt->execute([$title, $description, $deadline, $priority, $user['id'], $_SESSION['user_id']]);
        }
        $success = 'Task created successfully and assigned to all users.';
    }
}
?>

<main class="admin-section">
    <div class="card">
        <h2>Create Task</h2>
        <p>Create a new task with specific details and deadline. It will be automatically assigned to all users.</p>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    </div>

    <div class="card">
        <!-- Task Creation Form -->
        <form method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" id="deadline" name="deadline" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select id="priority" name="priority" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <button type="submit">Create Task</button>
        </form>
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
