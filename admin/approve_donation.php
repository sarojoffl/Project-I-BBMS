<?php
require 'session.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $conn = new mysqli('localhost', 'root', '', 'blood_bank');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $update_query = "UPDATE blood_donation SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $status = 'Approved';
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows == 1) {
            $bloodgroup = urlencode($_GET["bloodgroup"]);
            $unit = $_GET["unit"];

            $update_blood_units_query = "UPDATE blood_units SET units = units + ? WHERE bloodgroup = ?";
            $stmt_blood_units = $conn->prepare($update_blood_units_query);
            $stmt_blood_units->bind_param("is", $unit, $bloodgroup);

            if ($stmt_blood_units->execute()) {
                if ($stmt_blood_units->affected_rows == 1) {
                    header("Location: admin_donation.php");
                    exit;
                } else {
                    echo "Error updating blood_units. No rows affected.";
                }
            } else {
                echo "Error executing blood_units update query: " . $conn->error;
            }

            $stmt_blood_units->close();
        } else {
            echo "Error updating request. No rows affected.";
        }
    } else {
        echo "Error executing patient_info update query: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid id parameter.";
}
?>