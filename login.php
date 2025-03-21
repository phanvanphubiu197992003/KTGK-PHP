<?php
session_start();
include 'db.php';
include 'header.php';
$error = "";

// Xử lý khi người dùng nhấn "Đăng Nhập"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = trim($_POST['MaSV']);

    // Kiểm tra Mã Sinh Viên trong cơ sở dữ liệu
    $result = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$MaSV'");

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: index.php"); // Chuyển hướng về trang chính
        exit();
    } else {
        $error = "Mã Sinh Viên không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary text-center">🔑 ĐĂNG NHẬP</h2>

        <div class="card p-4 shadow">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Mã SV</label>
                    <input type="text" name="MaSV" class="form-control" required>
                </div>
                <?php if ($error): ?>
                    <p class="text-danger"><?= $error ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">🔙 Quay lại</a>
        </div>
    </div>
</body>
</html>
