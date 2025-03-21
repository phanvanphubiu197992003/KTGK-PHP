<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM sinhvien WHERE MaSV='$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    if ($_FILES["Hinh"]["name"]) {
        $target_file = "content/images/" . basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
    } else {
        $target_file = $row['Hinh'];
    }

    $conn->query("UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$target_file', MaNganh='$MaNganh' WHERE MaSV='$id'");

    header("Location: index.php");
}
?>

<form method="post" enctype="multipart/form-data">
    Họ Tên: <input type="text" name="HoTen" value="<?= $row['HoTen'] ?>"><br>
    Giới Tính: 
    <select name="GioiTinh">
        <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
    </select><br>
    Ngày Sinh: <input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>"><br>
    Hình Ảnh: <input type="file" name="Hinh"><br>
    Mã Ngành: <input type="text" name="MaNganh" value="<?= $row['MaNganh'] ?>"><br>
    <button type="submit">Cập Nhật</button>
</form>
