<?php
require_once '../config/database.php';
require_once 'auth_check.php';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, due_date, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $description, $due_date, $status]);
    header("Location: index.php");
    exit;
}
?>

<h2>Thêm Task mới📝</h2>
<form method="POST">
    <div class="mb-3">
        <label>Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label>Ngày hết hạn</label>
        <input type="date" name="due_date" class="form-control">
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="pending">Đang chờ</option>
            <option value="in_progress">Đang làm</option>
            <option value="completed">Hoàn thành</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="index.php" class="btn btn-secondary">Hủy</a>
</form>

<?php require_once '../includes/footer.php'; ?>