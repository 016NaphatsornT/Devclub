<?php
$conn = new mysqli("localhost", "root", "", "devclub");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>