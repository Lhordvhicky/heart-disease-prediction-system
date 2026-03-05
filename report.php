<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config.php";

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Report</title>
</head>
<body onload="window.print()">

<h2>Patient Medical Report</h2>
<hr>

<p><strong>Age:</strong> <?php echo $row['age']; ?></p>
<p><strong>Blood Pressure:</strong> <?php echo $row['bp']; ?></p>
<p><strong>Cholesterol:</strong> <?php echo $row['chol']; ?></p>
<p><strong>Diabetic:</strong> <?php echo $row['diabetic']; ?></p>
<p><strong>Smoker:</strong> <?php echo $row['smoker']; ?></p>
<p><strong>Heart Disease:</strong> <?php echo $row['heart']; ?></p>
<p><strong>Stroke:</strong> <?php echo $row['stroke']; ?></p>
<p><strong>Risk Level:</strong> <?php echo $row['risk_level']; ?></p>
<p><strong>Date:</strong> <?php echo $row['created_at']; ?></p>

</body>
</html>