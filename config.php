<?php
$conn = new mysqli("localhost", "root", "", "heart_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>