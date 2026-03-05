<!DOCTYPE html>
<html>
<head>
    <title>Patient Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Patient Details</h2>

    <form action="result.php" method="POST">

        <label for="name">Patient Name</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age</label>
        <input type="number" id="age" name="age" required>

        <label for="bp">Blood Pressure</label>
        <input type="number" id="bp" name="bp" required>

        <label for="chol">Cholesterol</label>
        <input type="number" id="chol" name="chol" required>

        <label for="diabetes">Diabetes</label>
        <select id="diabetes" name="diabetes" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <label for="smoker">Smoker</label>
        <select id="smoker" name="smoker" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <button type="submit">Predict</button>
    </form>
</div>
</body>
</html>