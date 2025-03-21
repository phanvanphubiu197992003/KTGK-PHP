<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Xử lý upload ảnh
    $target_dir = "content/images/";
    $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);

    // Lưu vào database
    $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$target_file', '$MaNganh')";
    $conn->query($sql);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-success">📝 Thêm Sinh Viên</h2>
        
        <div class="card mx-auto shadow p-4" style="max-width: 500px;">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" class="form-control" placeholder="Nhập mã sinh viên" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" class="form-control" placeholder="Nhập họ tên" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình Ảnh</label>
                    <input type="file" name="Hinh" class="form-control" required accept="image/*" onchange="previewImage(event)">
                    <div class="text-center mt-3">
                        <img id="preview" src="content/images/default.jpg" class="img-thumbnail" width="150">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành</label>
                    <input type="text" name="MaNganh" class="form-control" placeholder="Nhập mã ngành" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">✅ Thêm</button>
                    <a href="index.php" class="btn btn-secondary">🔙 Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
