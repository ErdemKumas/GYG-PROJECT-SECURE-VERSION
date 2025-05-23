<?php
$conn = mysqli_connect("localhost", "root", "", "secure_db");

if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}
?>