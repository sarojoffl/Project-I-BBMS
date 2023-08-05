<?php
if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    $conn = new mysqli('localhost', 'root', '', 'blood_bank');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $delete_query = "DELETE FROM donor_info WHERE user_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $user_id);

    if ($delete_stmt->execute()) {
        header("Location: admin_donor.php");
        exit();
    } else {
        die("Deletion failed: " . $conn->error);
    }

    $delete_stmt->close();
    $conn->close();
} else {
    die("Invalid donor user_id");
}
?>
