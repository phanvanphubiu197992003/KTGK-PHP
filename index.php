
<?php
include 'db.php';
include 'header.php';


// Truy vấn danh sách sinh viên
$sql = "SELECT * FROM sinhvien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Quản Lý Sinh Viên</h2>
        <a href="add.php" class="btn btn-success mb-3">+ Thêm Sinh Viên</a>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình Ảnh</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaSV'] ?></td>
                    <td><?= $row['HoTen'] ?></td>
                    <td><?= $row['GioiTinh'] ?></td>
                    <td><?= $row['NgaySinh'] ?></td>
                    
                    <td>
            <img src="<?= ltrim($row['Hinh'], '/') ?>" width="200" height="200" alt="Hình SV" 
                 onerror="this.onerror=null; this.src='content/images/default.jpg';">
        </td>
                    <td><?= $row['MaNganh'] ?></td>
                    <td>
                        <a href="detail.php?id=<?= $row['MaSV'] ?>" class="btn btn-info">👁 Xem</a>
                        <a href="edit.php?id=<?= $row['MaSV'] ?>" class="btn btn-warning">✏ Sửa</a>
                        <a href="delete.php?id=<?= $row['MaSV'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
