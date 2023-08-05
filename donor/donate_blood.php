<?php
require 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bloodgroup = $_POST['bloodgroup'];
    $unit = $_POST['unit'];
    $disease = $_POST['disease'];
    $age = $_POST['age'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $conn = new mysqli('localhost', 'root', '', 'blood_bank');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO blood_donation (user_id, bloodgroup, unit, disease, age) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isisi", $user_id, $bloodgroup, $unit, $disease, $age);

        if ($stmt->execute()) {
            header("Location: donation_history.php");
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php include 'donorbase.html'; ?>
<br><br>        
        <form action="" method="POST">
            <h2>DONATE BLOOD</h2>
            <label> Blood group: </label>
        <select name="bloodgroup" required>
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

        <label> Unit (in ml) </label>
        <input type="number" name="unit" value="0" required>

        <label> Disease (if any) </label>
        <input type="text" name="disease" value="Nothing" required>

        <label> Age </label>
        <input type="number" name="age" class="input--style-5" required>

       <button class="btn btn--radius-2 btn-danger" type="submit">DONATE</button>
        </form>
</body>
</html>
