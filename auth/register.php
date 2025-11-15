<?php
require_once '../config/database.php';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kiểm tra dữ liệu
    if (empty($username) || empty($password)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Kiểm tra username/email đã tồn tại
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Tên đăng nhập hoặc email đã tồn tại.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $hashed, $email])) {
                $success = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
            }
        }
    }
}
?>

<h2>Đăng ký tài khoản</h2>
<?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

<form method="POST">
    <div class="mb-3">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email (tùy chọn)</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>

<?php require_once '../includes/footer.php'; ?>