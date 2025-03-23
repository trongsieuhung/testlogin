<?php
$filename = "logins.txt";

if (file_exists($filename)) {
    echo "<pre>" . htmlspecialchars(file_get_contents($filename)) . "</pre>";
} else {
    echo "File không tồn tại!";
}
?>
