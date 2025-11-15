<?php require_once '../config/database.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../tasks/index.php">TO-DO LIST📜</a>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="navbar-text me-3">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a class="nav-link" href="../auth/logout.php">Đăng xuất</a>
                <?php else: ?>
                    <a class="nav-link" href="../auth/login.php">Đăng nhập</a>
                    <a class="nav-link" href="../auth/register.php">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4">