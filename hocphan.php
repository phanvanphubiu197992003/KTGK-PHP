<?php
include 'db.php';
include 'header.php';

$MaSV = '0123456789'; // Giả lập mã sinh viên (thay bằng session khi có hệ thống đăng nhập)

// Lấy danh sách học phần
$hocphans = $conn->query("SELECT * FROM HocPhan");

// Xử lý đăng ký học phần
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaHP = $_POST['MaHP'];

    // Kiểm tra xem sinh viên đã có đăng ký chưa
    $checkDangKy = $conn->query("SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV'");

    if ($checkDangKy->num_rows == 0) {
        // Nếu sinh viên chưa có đăng ký, tạo mới
        $conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURDATE(), '$MaSV')");
        $MaDK = $conn->insert_id;
    } else {
        // Nếu đã có đăng ký, lấy MaDK hiện tại
        $row = $checkDangKy->fetch_assoc();
        $MaDK = $row['MaDK'];
    }

    // Kiểm tra xem học phần đã được đăng ký chưa
    $checkHP = $conn->query("SELECT * FROM ChiTietDangKy WHERE MaDK = '$MaDK' AND MaHP = '$MaHP'");
    
    if ($checkHP->num_rows == 0) {
        // Nếu chưa đăng ký, thêm vào bảng ChiTietDangKy
        $conn->query("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')");
    }

    header("Location: hocphan.php");
}

// Lấy danh sách học phần sinh viên đã đăng ký
$dangky = $conn->query("
    SELECT HocPhan.* FROM HocPhan 
    JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
    JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
    WHERE DangKy.MaSV = '$MaSV'
");
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

        <!-- Danh sách học phần -->
        <div class="card p-3 shadow">
            <h4 class="text-center text-success">Danh Sách Học Phần</h4>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $hocphans->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaHP'] ?></td>
                        <td><?= $row['TenHP'] ?></td>
                        <td><?= $row['SoTinChi'] ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                                <button type="submit" class="btn btn-success">📌 Đăng Ký</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Học phần đã đăng ký -->
        <div class="card p-3 shadow mt-4">
            <h4 class="text-center text-warning">Học Phần Đã Đăng Ký</h4>
            <table class="table table-bordered text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $dangky->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaHP'] ?></td>
                        <td><?= $row['TenHP'] ?></td>
                        <td><?= $row['SoTinChi'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">🔙 Quay lại</a>
        </div>
    </div>
</body>
</html>
