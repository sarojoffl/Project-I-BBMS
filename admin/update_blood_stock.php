<?php
require 'session.php';
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bloodgroup = $_POST['bloodgroup'];
    $unit = $_POST['unit'];

    if ($bloodgroup && $unit) {
        $sql = "UPDATE blood_units SET units = units + ? WHERE bloodgroup = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("is", $unit, $bloodgroup);

        if ($stmt->execute()) {
            header("Location: blood_stock.php");
        } else {
            echo "Error updating blood stock: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Please select a blood group and enter the number of units.";
    }
}
$conn->close();
?>
