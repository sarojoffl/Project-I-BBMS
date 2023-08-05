<?php
$message = '';
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_POST["user_id"];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user = $_POST['user'];
    $address = $_POST['address'];
    $bloodgroup = $_POST['bloodgroup'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("UPDATE donor_info SET firstname=?, lastname=?, user=?, address=?, bloodgroup=?, mobile=? WHERE user_id=?");
    $stmt->bind_param("sssssii", $firstname, $lastname, $user, $address, $bloodgroup, $mobile, $user_id);

    if ($stmt->execute()) {
        $message = "Donor information updated successfully.";
        header("Location: admin_donor.php");
        exit;
    } else {
        $message = "Error updating donor information: " . $conn->error;
    }

    $stmt->close();
}

$user_id = $_GET["user_id"];

$stmt = $conn->prepare("SELECT * FROM donor_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Donor Information</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
    body{
          margin-bottom: 0px;
          background-image: url("../image/nebula.png");
          background-size: cover;
          background-repeat: no-repeat;
        }
</style>
</head>
<body>
<?php include 'navbar.php';?>
<br><br><br><br><br><br>
    <form action="update_donor.php" method="POST">
        <center>
            <h1>Update Donor Information</h1>
        </center>
        <p style="color: red;"><?php echo $message; ?></p>
        <?php if ($row) { ?>
        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
        <label> Firstname: </label>
        <input type="text" name="firstname" required value="<?php echo $row['firstname']; ?>"> <br>
        <label> Lastname: </label>
        <input type="text" name="lastname" required value="<?php echo $row['lastname']; ?>"> <br>

        <label> Username: </label>
        <input type="text" name="user" required value="<?php echo $row['user']; ?>"><br>
        <label> Address: </label>
        <input type="text" name="address" required value="<?php echo $row['address']; ?>"><br>

        <label> Blood group: </label>
        <select name="bloodgroup" required>
            <option disabled="disabled">Choose option</option>
            <option <?php if ($row['bloodgroup'] === 'O+') echo 'selected'; ?>>O+</option>
            <option <?php if ($row['bloodgroup'] === 'O-') echo 'selected'; ?>>O-</option>
            <option <?php if ($row['bloodgroup'] === 'A+') echo 'selected'; ?>>A+</option>
            <option <?php if ($row['bloodgroup'] === 'A-') echo 'selected'; ?>>A-</option>
            <option <?php if ($row['bloodgroup'] === 'B+') echo 'selected'; ?>>B+</option>
            <option <?php if ($row['bloodgroup'] === 'B-') echo 'selected'; ?>>B-</option>
            <option <?php if ($row['bloodgroup'] === 'AB+') echo 'selected'; ?>>AB+</option>
            <option <?php if ($row['bloodgroup'] === 'AB-') echo 'selected'; ?>>AB-</option>
        </select><br>

        <label> Mobile:  </label>
        <input type="text" name="mobile" required value="<?php echo $row['mobile']; ?>">
        <button type="submit" name="submit">Update</button>
        <?php } else { ?>
        <p>Donor information not found.</p>
        <?php } ?>
    </form>
<?php include 'footer.php';?>
</body>
</html>
