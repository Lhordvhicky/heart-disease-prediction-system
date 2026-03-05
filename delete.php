<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config.php";

$id = intval($_GET['id']);
$conn->query("DELETE FROM patients WHERE id=$id");

header("Location: dashboard.php");
exit();