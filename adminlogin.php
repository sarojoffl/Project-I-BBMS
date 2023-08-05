<?php
session_start();

if (isset($_SESSION['user'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    header('Location: ./admin/admin_dashboard.php');
    exit();
}

if(isset($_POST["submit"])) {
    if(!empty($_POST['user']) && !empty($_POST['password'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];

        $message = '';

        $conn = new mysqli('localhost','root','','blood_bank');
        if($conn->connect_error){
            die("Connection Failed : ". $conn->connect_error);
        } else {
            $stmt = $conn->prepare("select * from admin_info where user = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute(); 
            $stmt_result = $stmt->get_result();
            if($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                if($data['password'] === md5($password)) {
                    $_SESSION['user_id'] = $data['user_id'];
                    $_SESSION['user'] = $data['user'];
                    header("Location: ./admin/admin_dashboard.php");
                    exit();
                } else {
                    $message = "Invalid username or password";
                }
                $stmt->close();
            } else {
                $message = "Invalid username or password";
            }
            $conn->close();
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<!Doctype html>
<html>
<head>
<title>Admin Login</title>
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
<br><br><br><br><br><br><br>
<form action="" method="POST">
<center><h1>Admin Login</h1></center>
<p style="color: red;"><?php echo $message; ?></p>
<label> Username: </label>
<input type="text" name="user"><br />
<label> Password: </label>
<input type="password" name="password"><br />
<button class="btn btn--radius-2 btn-danger" type="submit" name="submit">Login</button>
</form>
<?php include 'footer.php';?>
</body>
</html>
