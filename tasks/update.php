<?php
require_once '../config/database.php';
require_once 'auth_check.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$task = $stmt->fetch();

if (!$task) {
    die("Không tìm thấy công việc.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tasks SET title=?, description=?, due_date=?, status=? WHERE id=? AND user_id=?");
    $stmt->execute([$title, $description, $due_date, $status, $id, $_SESSION['user_id']]);
    header("Location: index.php");
    exit;
}
?>

<h2>Chỉnh sửa Task✍️</h2>
<form method="POST">
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label>Ngày hết hạn</label>
        <input type="date" name="due_date" class="form-control" value="<?= $task['due_date'] ?>">
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>Đang chờ</option>
            <option value="in_progress" <?= $task['status']=='in_progress'?'selected':'' ?>>Đang làm</option>
            <option value="completed" <?= $task['status']=='completed'?'selected':'' ?>>Hoàn thành</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="index.php" class="btn btn-secondary">Hủy</a>
</form>

<?php require_once '../includes/footer.php'; ?>