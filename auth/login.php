<?php
require_once '../config/database.php';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../tasks/index.php");
        exit;
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu.";
    }
}
?>

<h2>Đăng nhập</h2>
<?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST">
    <div class="mb-3">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Đăng nhập</button>
</form>

<?php require_once '../includes/footer.php'; ?>