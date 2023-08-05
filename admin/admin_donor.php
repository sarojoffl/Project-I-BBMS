<?php
require 'session.php';

$conn = new mysqli('localhost', 'root', '', 'blood_bank');

$query = "SELECT * FROM donor_info";
$result = $conn->query($query);

if (!$result) {
    die("Database query failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .container {
        position: relative;
        left: 100px;
    }
</style>
<body>
    <?php include 'adminbase.html'; ?>
    <br><br>
    <div class="container">
        <h4 class="text-center">DONOR DETAILS</h4><br>
        <table class="table table-light table-hover table-bordered table-striped">
            <thead class="bg-info">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($donor = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $donor['firstname'] . ' ' . $donor['lastname']; ?></td>
                            <td><?php echo $donor['user']; ?></td>
                            <td><?php echo $donor['bloodgroup']; ?></td>
                            <td><?php echo $donor['address']; ?></td>
                            <td><?php echo $donor['mobile']; ?></td>
                            <td class="text-right">
                                <button class="btn btn-primary badge-pill" style="width: 80px;">
                                    <a style="text-decoration: none;color: white;" href="<?php echo 'update_donor.php?user_id=' . $donor['user_id']; ?>">EDIT</a>
                                </button>
                                <button class="btn btn-danger badge-pill" style="width: 80px;">
                                    <a style="text-decoration: none;color: white;" href="<?php echo 'delete_donor.php?user_id=' . $donor['user_id']; ?>">DELETE</a>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
