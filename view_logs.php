<?php
$filename = "data/logins.txt"; // Đường dẫn đúng tới file

if (file_exists($filename)) {
    echo "<pre>" . htmlspecialchars(file_get_contents($filename)) . "</pre>";
} else {
    echo "File không tồn tại!";
}
?>
