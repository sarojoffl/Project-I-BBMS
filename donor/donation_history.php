<?php
require 'session.php';
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM blood_donation WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Database query failed.");
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<?php include 'donorbase.html'; ?>
<br><br>
<div class="container">
    <H4 class="text-center">My Donation History</H4><br>
    <table class="table table-light table-hover table-bordered table-striped">
        <thead class="bg-info">
            <tr>
                <th scope="col">Donor Age</th>
                <th scope="col">Disease (if any)</th>
                <th scope="col">Blood Group</th>
                <th scope="col">Unit</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['age'] . '</td>';
                    echo '<td>' . $row['disease'] . '</td>';
                    echo '<td>' . $row['bloodgroup'] . '</td>';
                    echo '<td>' . $row['unit'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    if ($row['status'] == 'Approved') {
                        echo '<td><span class="label warning">Approved</span></td>';
                    } elseif ($row['status'] == 'Rejected') {
                        echo '<td><span class="label success">Rejected</span></td>';
                    } else {
                        echo '<td><span style="color: white;margin-left: 0px;" class="label info">Pending</span></td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No donation history found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>