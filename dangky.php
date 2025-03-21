<?php
include 'db.php';
include 'header.php';

$MaSV = '0123456789'; // Giả lập mã sinh viên (thay bằng session khi có hệ thống đăng nhập)

// Xử lý xóa từng học phần
if (isset($_GET['delete_hp'])) {
    $MaHP = $_GET['delete_hp'];
    $conn->query("DELETE FROM ChiTietDangKy WHERE MaHP = '$MaHP' AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')");
    header("Location: dangky.php");
    exit();
}

// Xử lý xóa toàn bộ đăng ký
if (isset($_GET['delete_all'])) {
    $conn->query("DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')");
    $conn->query("DELETE FROM DangKy WHERE MaSV = '$MaSV'");
    header("Location: dangky.php");
    exit();
}

// Lấy danh sách học phần sinh viên đã đăng ký
$dangky = $conn->query("SELECT HocPhan.* FROM HocPhan 
    JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
    JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
    WHERE DangKy.MaSV = '$MaSV'");

$tongHocPhan = $dangky->num_rows;
$tongTinChi = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary text-center">📚 Đăng Ký Học Phần</h2>

        <!-- Học phần đã đăng ký -->
        <div class="card p-3 shadow">
            <h4 class="text-center text-warning">Học Phần Đã Đăng Ký</h4>
            <table class="table table-bordered text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $dangky->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaHP'] ?></td>
                        <td><?= $row['TenHP'] ?></td>
                        <td><?= $row['SoTinChi'] ?></td>
                        <td>
                            <a href="dangky.php?delete_hp=<?= $row['MaHP'] ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php $tongTinChi += $row['SoTinChi']; endwhile; ?>
                </tbody>
            </table>
            <p class="text-danger fw-bold">Số học phần: <?= $tongHocPhan ?></p>
            <p class="text-danger fw-bold">Tổng số tín chỉ: <?= $tongTinChi ?></p>
        </div>

        <div class="text-center mt-3">
            <a href="dangky.php?delete_all=1" class="btn btn-danger">Xóa Đăng Ký</a>
            <a href="index.php" class="btn btn-secondary">🔙 Quay lại</a>
        </div>
    </div>
</body>
</html>
