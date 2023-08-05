<?php
require 'session.php';
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bloodUnitsSql = "SELECT 
                    SUM(CASE WHEN bloodgroup='A+' THEN units ELSE 0 END) as A1_unit,
                    SUM(CASE WHEN bloodgroup='B+' THEN units ELSE 0 END) as B1_unit,
                    SUM(CASE WHEN bloodgroup='O+' THEN units ELSE 0 END) as O1_unit,
                    SUM(CASE WHEN bloodgroup='AB+' THEN units ELSE 0 END) as AB1_unit,
                    SUM(CASE WHEN bloodgroup='A-' THEN units ELSE 0 END) as A2_unit,
                    SUM(CASE WHEN bloodgroup='B-' THEN units ELSE 0 END) as B2_unit,
                    SUM(CASE WHEN bloodgroup='O-' THEN units ELSE 0 END) as O2_unit,
                    SUM(CASE WHEN bloodgroup='AB-' THEN units ELSE 0 END) as AB2_unit,
                    SUM(units) as totalbloodunit
                 FROM blood_units";
$bloodUnitsResult = $conn->query($bloodUnitsSql);
$A1_unit = 0;
$B1_unit = 0;
$O1_unit = 0;
$AB1_unit = 0;
$A2_unit = 0;
$B2_unit = 0;
$O2_unit = 0;
$AB2_unit = 0;
$totalbloodunit = 0;

if ($bloodUnitsResult->num_rows > 0) {
    $bloodUnitsRow = $bloodUnitsResult->fetch_assoc();
    $A1_unit = $bloodUnitsRow["A1_unit"];
    $B1_unit = $bloodUnitsRow["B1_unit"];
    $O1_unit = $bloodUnitsRow["O1_unit"];
    $AB1_unit = $bloodUnitsRow["AB1_unit"];
    $A2_unit = $bloodUnitsRow["A2_unit"];
    $B2_unit = $bloodUnitsRow["B2_unit"];
    $O2_unit = $bloodUnitsRow["O2_unit"];
    $AB2_unit = $bloodUnitsRow["AB2_unit"];
    $totalbloodunit = $bloodUnitsRow["totalbloodunit"];
}

$requestSql = "SELECT 
                 COUNT(*) as totalrequest,
                 SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as totalapprovedrequest
               FROM patient_info";
$requestResult = $conn->query($requestSql);
$totalrequest = 0;
$totalapprovedrequest = 0;

if ($requestResult->num_rows > 0) {
    $requestRow = $requestResult->fetch_assoc();
    $totalrequest = $requestRow["totalrequest"];
    $totalapprovedrequest = $requestRow["totalapprovedrequest"];
}

$donorSql = "SELECT COUNT(*) as totaldonors FROM donor_info";
$donorResult = $conn->query($donorSql);
$totaldonors = 0;

if ($donorResult->num_rows > 0) {
    $donorRow = $donorResult->fetch_assoc();
    $totaldonors = $donorRow["totaldonors"];
}

$conn->close();
?>
