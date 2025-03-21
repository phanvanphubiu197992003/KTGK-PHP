<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM sinhvien WHERE MaSV='$id'");

header("Location: index.php");
?>
