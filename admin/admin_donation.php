<?php
require 'session.php';

$conn = new mysqli('localhost','root','','blood_bank');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT blood_donation.*, donor_info.firstname
        FROM blood_donation
        INNER JOIN donor_info ON blood_donation.user_id = donor_info.user_id";
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
    <h4 class="text-center">BLOOD DONATION DETAILS</h4><br>
    <table class="table table-light table-hover table-bordered table-striped">
        <thead class="bg-info">
            <tr>
                <th scope="col">Donor Name</th>
                <th scope="col">Disease</th>
                <th scope="col">Age</th>
                <th scope="col">Blood Group</th>
                <th scope="col">Unit</th>
                <th scope="col">Request Date</th>
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
        <td><?php echo $row['firstname']; ?></td>
        <td><?php echo $row['disease']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['bloodgroup']; ?></td>
        <td><?php echo $row['unit']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <?php if ($row['status'] == 'Pending'): ?>
        <td class="text-right">
            <button class="btn btn-primary badge-pill" style="width: 100px;"><a style="text-decoration: none; color: white;" href="<?php echo 'approve_donation.php?id=' . $row['id'] . '&bloodgroup=' . $row['bloodgroup'] . '&unit=' . $row['unit']; ?>">APPROVE</a></button>
            <button class="btn btn-danger badge-pill" style="width: 80px;"><a style="text-decoration: none; color: white;" href="<?php echo 'reject_donation.php?id=' . $row['id']; ?>">REJECT</a></button>
        </td>
        <?php elseif ($row['status'] == 'Approved'): ?>
        <td><span class="label warning"><?php echo $row['unit']; ?> Unit Added To Stock</span></td>
        <?php else: ?>
        <td><span class="label danger">0 Unit Added To Stock</span></td> 
        <?php endif; ?>
    </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='8'>No records found.</td></tr>";
    }
    ?>
</tbody>
    </table>
</div>
</body>
</html>