<?php
include "config.php";
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=patient_report.txt");

echo "Patient Report\n";
echo "Name: ".$row['name']."\n";
echo "Age: ".$row['age']."\n";
echo "Risk Level: ".$row['risk_level']."\n";
exit();
?>
