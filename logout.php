<?php
session_start(); // Khởi tạo session

// Xóa session user_ID
if (isset($_SESSION['user_ID'])) {
    unset($_SESSION['user_ID']);
}

// Hủy toàn bộ session (nếu cần)
session_destroy();

// Chuyển hướng về trang đăng nhập hoặc trang chủ
header("Location: login.php"); 
exit();
?>
