<?php
require_once '../config/database.php';
require_once 'auth_check.php';
require_once '../includes/header.php';

// Lọc và sắp xếp
$status_filter = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'due_date';

$sql = "SELECT * FROM tasks WHERE user_id = ?";

$params = [$_SESSION['user_id']];

if ($status_filter) {
    $sql .= " AND status = ?";
    $params[] = $status_filter;
}

$sql .= match($sort) {
    'title' => " ORDER BY title",
    'created' => " ORDER BY created_at DESC",
    default => " ORDER BY due_date ASC, created_at DESC"
};

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();
?>

<h2>Công việc của bạn👩‍💻</h2>
<a href="create.php" class="btn btn-primary mb-3">Thêm Task mới📝</a>

<!-- Bộ lọc -->
<div class="row mb-3">
    <div class="col-md-6">
        <form class="d-inline">
            <input type="hidden" name="sort" value="<?= $sort ?>">
            <select name="status" onchange="this.form.submit()" class="form-select d-inline w-auto">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" <?= $status_filter=='pending'?'selected':'' ?>>Đang chờ</option>
                <option value="in_progress" <?= $status_filter=='in_progress'?'selected':'' ?>>Đang làm</option>
                <option value="completed" <?= $status_filter=='completed'?'selected':'' ?>>Hoàn thành</option>
            </select>
        </form>
    </div>
    <div class="col-md-6 text-end">
		<span class="ms-3">Sắp xếp theo:</span>
        <a href="?sort=due_date<?= $status_filter ? "&status=$status_filter" : '' ?>" class="btn btn-sm btn-outline-secondary">Ngày hạn</a>
        <a href="?sort=created<?= $status_filter ? "&status=$status_filter" : '' ?>" class="btn btn-sm btn-outline-secondary">Mới nhất</a>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Ngày hạn</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= $task['due_date'] ?? 'Không có' ?></td>
            <td>
                <span class="badge bg-<?= $task['status']=='completed'?'success':($task['status']=='in_progress'?'warning':'secondary') ?>">
                    <?= ucfirst(str_replace('_', ' ', $task['status'])) ?>
                </span>
            </td>
            <td>
                <a href="update.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Sửa✍️</a>
                <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa task này?')">Xóa❌</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>
