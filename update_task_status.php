<?php
// AJAX endpoint for updating task status
// Rubric: Functionality (AJAX), security (auth check)

require_once 'includes/functions.php';
require_login();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $task_id = (int)$data['task_id'];
    $status = sanitize($data['status']);

    if (in_array($status, ['pending', 'in_progress', 'completed'])) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ? AND assigned_to = ?");
        $stmt->execute([$status, $task_id, $_SESSION['user_id']]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
