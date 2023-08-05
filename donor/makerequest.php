<?php
require 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $patient_age = $_POST['patient_age'];
    $reason = $_POST['reason'];
    $bloodgroup = $_POST['bloodgroup'];
    $unit = $_POST['unit'];

    if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $conn = new mysqli('localhost', 'root', '', 'blood_bank');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO patient_info (user_id, patient_name, patient_age, reason, bloodgroup, unit) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isissi", $user_id, $patient_name, $patient_age, $reason, $bloodgroup, $unit);

    if ($stmt->execute()) {
        header("Location: request_history.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    echo "User not logged in.";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <?php include 'donorbase.html'; ?>

    <br><br>

    <form action="" method="POST">
        <h2>MAKE BLOOD REQUEST</h2>

        <label>Patient Name</label>
        <input type="text" name="patient_name">

        <label>Patient Age</label>
        <input type="text" name="patient_age">

        <label>Reason</label>
        <input type="text" name="reason">

        <label>Blood Group</label>
        <select name="bloodgroup">
            <option disabled="disabled" selected="selected">Choose option</option>
            <option>O+</option>
            <option>O-</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select><br>

        <label>Unit (in ml)</label>
        <input type="text" name="unit">

        <button class="btn btn--radius-2 btn-danger" type="submit">REQUEST</button>
    </form>
</body>
</html>
