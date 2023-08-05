<?php
function is_valid_password($password)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}

function is_valid_mobile($mobile)
{
    return preg_match('/^\d{10}$/', $mobile);
}

$message = '';

if (isset($_POST["submit"])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $bloodgroup = $_POST['bloodgroup'];
    $mobile = $_POST['mobile'];

    $conn = new mysqli('localhost', 'root', '', 'blood_bank');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $check_user_query = "SELECT COUNT(*) AS count FROM donor_info WHERE user = ?";
        $check_user_stmt = $conn->prepare($check_user_query);
        $check_user_stmt->bind_param("s", $user);
        $check_user_stmt->execute();
        $result = $check_user_stmt->get_result();
        $row = $result->fetch_assoc();
        $user_count = $row['count'];
        $check_user_stmt->close();

        if ($user_count > 0) {
            $message = "Username already exists. Please choose a different username.";
        } elseif (!is_valid_password($password)) {
            $message = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.";
        } elseif (!is_valid_mobile($mobile)) {
            $message = "Mobile number must be a 10-digit number.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO donor_info(firstname, lastname, user, password, address, bloodgroup, mobile) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $firstname, $lastname, $user, $hashed_password, $address, $bloodgroup, $mobile);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header("Location: donorlogin.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Signup</title>
    <link rel="stylesheet" href="./css/main.css">
    <style>
    body{
          margin-bottom: 0px;
          background-image: url("./image/nebula.png");
          background-size: cover;
          background-repeat: no-repeat;
        }
</style>
</head>
<body>
<?php include 'navbar.php';?>
<br><br><br>
    <form action="" method="POST" onsubmit="return validateForm()">
        <center>
            <h1>Donor Signup</h1>
        </center>
        <p style="color: red;"><?php echo $message; ?></p>
        <label> Firstname: </label>
        <input type="text" name="firstname" required> <br>
        <label> Lastname: </label>
        <input type="text" name="lastname" required> <br>

        <label> Username: </label>
        <input type="text" name="user" required><br>
        <label> Password: </label>
        <input type="password" name="password" id="password" required>
        <span id="passwordError" style="color: red;"></span><br>
        <label> Address: </label>
        <input type="text" name="address" required><br>

        <label> Blood group: </label>
        <select name="bloodgroup" required>
            <option disabled="disabled" selected="selected">Choose option</option>
            <option>O+</option>
            <option>O-</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select><br>
        <label> Mobile:  </label>
        <input type="text" name="mobile" id="mobile" required>
        <span id="mobileError" style="color: red;"></span><br>
        <button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Register</button> 
    </form>
    <p>Already have an account? <a href="./donorlogin.php">Click here to login</a></p>

    <script>
    function validateForm() {
        const passwordInput = document.getElementById('password');
        const mobileInput = document.getElementById('mobile');
        const passwordError = document.getElementById('passwordError');
        const mobileError = document.getElementById('mobileError');

        passwordError.textContent = '';
        mobileError.textContent = '';

        const password = passwordInput.value;
        const mobile = mobileInput.value;

        if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/.test(password)) {
            passwordError.textContent = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.";
            return false;
        }

        if (!/\d{10}/.test(mobile)) {
            mobileError.textContent = "Mobile number must be a 10-digit number.";
            return false;
        }

        return true;
    }
    </script>
<?php include 'footer.php';?>
</body>
</html>
