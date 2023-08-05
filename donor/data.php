<?php
require 'session.php';
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
           COUNT(*) as requestmade,
           SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as requestpending,
           SUM(CASE WHEN status='approved' THEN 1 ELSE 0 END) as requestapproved,
           SUM(CASE WHEN status='rejected' THEN 1 ELSE 0 END) as requestrejected
        FROM patient_info";

$result = $conn->query($sql);

$requestmade = 0;
$requestpending = 0;
$requestapproved = 0;
$requestrejected = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $requestmade = $row["requestmade"];
    $requestpending = $row["requestpending"];
    $requestapproved = $row["requestapproved"];
    $requestrejected = $row["requestrejected"];
}

$conn->close();
?>