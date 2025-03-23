<?php
$dir_path = "data";
$file_path = "$dir_path/logins.txt";

// Kiểm tra thư mục
if (!is_dir($dir_path)) {
    die("⚠️ Thư mục '$dir_path' chưa tồn tại!");
}

// Kiểm tra file
if (!file_exists($file_path)) {
    die("⚠️ File '$file_path' chưa được tạo!");
}

// Đọc file
echo "<pre>" . htmlspecialchars(file_get_contents($file_path)) . "</pre>";
?>
