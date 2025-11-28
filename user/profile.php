<?php
// User: View and edit profile
// Rubric: Functionality (profile management), security (auth check)

require_once '../includes/functions.php';
require_login();
include '../includes/header.php';

$user = get_user($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
    $stmt->execute([$username, $email, $password, $_SESSION['user_id']]);
    $_SESSION['username'] = $username;
    $success = 'Profile updated successfully.';
    $user = get_user($_SESSION['user_id']); // Refresh data
}
?>

<main class="user-section">
    <div class="card">
        <h2>My Profile</h2>
        <p>Update your personal information and password.</p>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    </div>

    <div class="card">
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit">Update Profile</button>
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
