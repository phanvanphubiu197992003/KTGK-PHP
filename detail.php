<?php
include 'db.php';

// Lấy ID sinh viên từ URL
$id = $_GET['id'];

// Truy vấn lấy thông tin sinh viên
$result = $conn->query("SELECT * FROM sinhvien WHERE MaSV='$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Chi Tiết Sinh Viên</h2>

        <div class="card mx-auto" style="width: 30rem;">
            <img src="<?= ltrim($row['Hinh'], '/') ?>" class="card-img-top" alt="Hình Sinh Viên"
                 onerror="this.onerror=null; this.src='content/images/default.jpg';">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['HoTen']) ?></h5>
                <p class="card-text"><strong>Giới Tính:</strong> <?= htmlspecialchars($row['GioiTinh']) ?></p>
                <p class="card-text"><strong>Ngày Sinh:</strong> <?= htmlspecialchars($row['NgaySinh']) ?></p>
                <p class="card-text"><strong>Mã Ngành:</strong> <?= htmlspecialchars($row['MaNganh']) ?></p>
                <a href="index.php" class="btn btn-primary">🔙 Quay lại</a>
            </div>
        </div>
    </div>
</body>
</html>
