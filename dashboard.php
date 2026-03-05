<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "config.php";

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = $conn->query("SELECT * FROM patients WHERE name LIKE '%$search%' ORDER BY id DESC");
} else {
    $result = $conn->query("SELECT * FROM patients ORDER BY id DESC");
}

$total = $conn->query("SELECT COUNT(*) as t FROM patients")->fetch_assoc()['t'];
$high = $conn->query("SELECT COUNT(*) as t FROM patients WHERE risk_level='High' OR risk_level='Critical'")->fetch_assoc()['t'];
$low = $conn->query("SELECT COUNT(*) as t FROM patients WHERE risk_level='Low'")->fetch_assoc()['t'];
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="width:95%;">
<h2>Dashboard</h2>

<form method="GET">
<input type="text" name="search" placeholder="Search by name">
<button type="submit">Search</button>
</form>

<canvas id="riskChart"></canvas>

<script>
var ctx = document.getElementById('riskChart').getContext('2d');
new Chart(ctx, {
type: 'bar',
data: {
labels: ['High/Critical', 'Low'],
datasets: [{
label: 'Patients',
data: [<?php echo $high; ?>, <?php echo $low; ?>]
}]
}
});
</script>

<table border="1" width="100%">
<tr>
<th>Name</th><th>Age</th><th>Risk</th><th>Action</th>
</tr>
<?php while($row=$result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['risk_level']; ?></td>
<td>
<a href="report.php?id=<?php echo $row['id']; ?>">View</a> |
<a href="export_pdf.php?id=<?php echo $row['id']; ?>">PDF</a> |
<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<a href="logout.php" class="btn">Logout</a>
</div>
</body>
</html>