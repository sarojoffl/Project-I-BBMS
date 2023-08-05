<?php
require 'session.php';

$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM patient_info";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <style>
            .container {
                position: relative;
                left: 100px;
            }

            .label {
                color: white;
                padding: 8px;
            }

            .success {background-color: #4CAF50;}
            .info {background-color: #2196F3;}
            .warning {background-color: #ff9800;} 
            .danger {background-color: #f44336;}
            .other {background-color: #e7e7e7; color: black;}
        </style>
        </head>
        <body>
            <?php include 'adminbase.html'; ?>
            <br><br>
            <div class="container">
                <H4 class="text-center">Blood Requested</H4><br>
                <table class="table table-light table-hover table-bordered table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Blood Group</th>
                            <th scope="col">Unit (in ml)</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                        <tr>
                            <td><?php echo $row['patient_name']; ?></td>
                            <td><?php echo $row['patient_age']; ?></td>
                            <td><?php echo $row['reason']; ?></td>
                            <td><?php echo $row['bloodgroup']; ?></td>
                            <td><?php echo $row['unit']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <?php if ($row['status'] == 'Pending'): ?>
                            <td class="text-right">
                                <button class="btn btn-primary badge-pill" style="width: 100px;"><a style="text-decoration: none; color: white;" href="<?php echo 'approve_request.php?id=' . $row['id'] . '&bloodgroup=' . $row['bloodgroup'] . '&unit=' . $row['unit']; ?>">Approve</a></button>
                                <button class="btn btn-danger badge-pill" style="width: 80px;"><a style="text-decoration: none; color: white;" href="<?php echo 'reject_request.php?id=' . $row['id']; ?>">Reject</a></button>
                                </td>
        <?php elseif ($row['status'] == 'Approved'): ?>
        <td><span class="label warning"><?php echo $row['unit']; ?> Unit Deducted From Stock</span></td>
        <?php else: ?>
        <td><span class="label danger">0 Unit Deducted From Stock</span></td> 
        <?php endif; ?>
    </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>No Blood Request By Patient / Donor !</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </body>
</html>
