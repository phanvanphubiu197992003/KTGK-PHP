<?php
$servername = "localhost";
$username = "root"; // Thay bằng username của bạn
$password = ""; // Thay bằng mật khẩu của bạn
$dbname = "Test1"; // Tên database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8"); // Thiết lập mã hóa UTF-8
?>
