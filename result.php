<?php
include "config.php";

// Get form data
$name = $_POST['name'];
$age = intval($_POST['age']);
$bp = intval($_POST['bp']);
$chol = intval($_POST['chol']);
$diabetes = $_POST['diabetes']; // Fixed: match table column
$smoker = $_POST['smoker'];

// Initialize risk score
$riskScore = 0;
$heart_result = "no";
$stroke_result = "no";

// Calculate risk score
if ($bp > 140) $riskScore += 20;
if ($chol > 240) $riskScore += 20;
if ($age > 60) $riskScore += 20;
if ($diabetes == "yes") $riskScore += 20;
if ($smoker == "yes") $riskScore += 20;

// Determine risk level
if ($riskScore >= 60) {
    $riskLevel = "Critical";
} elseif ($riskScore >= 40) {
    $riskLevel = "High";
} else {
    $riskLevel = "Low";
}

// Determine heart and stroke predictions
if ($bp > 140 && $chol > 240) $heart_result = "yes";
if ($age > 60 && $diabetes == "yes") $stroke_result = "yes";

// Insert into database using prepared statement
$stmt = $conn->prepare("INSERT INTO patients (name, age, bp, chol, diabetes, smoker, heart, stroke, risk_level)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siissssss", $name, $age, $bp, $chol, $diabetes, $smoker, $heart_result, $stroke_result, $riskLevel);

if ($stmt->execute()) {
    // Success
    $stmt->close();
    $conn->close();
} else {
    die("Database insert failed: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Prediction Result</title>
</head>
<body>
<div class="container">
    <h2>Prediction Result</h2>
    <h3><?php echo htmlspecialchars($name); ?></h3>
    <p>Risk Score: <?php echo $riskScore; ?>%</p>
    <p>Risk Level: <strong><?php echo $riskLevel; ?></strong></p>
    <p>Heart Disease Prediction: <strong><?php echo ucfirst($heart_result); ?></strong></p>
    <p>Stroke Prediction: <strong><?php echo ucfirst($stroke_result); ?></strong></p>
    <a href="predict.php" class="btn">New Prediction</a>
</div>
</body>
</html>