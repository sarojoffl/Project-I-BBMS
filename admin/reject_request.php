<?php
require 'session.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $conn = new mysqli('localhost', 'root', '', 'blood_bank');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $update_query = "UPDATE patient_info SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $status = 'Rejected';
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        header("Location: admin_request.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid id parameter.";
}

$conn->close();
?>