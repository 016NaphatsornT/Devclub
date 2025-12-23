<?php
$host = "sql.infinityfree.com";
$user = "epiz_12345678";
$pass = "รหัสผ่านฐานข้อมูล";
$db = "epiz_12345678_run";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}
$conn->set_charset("utf8mb4");
?>