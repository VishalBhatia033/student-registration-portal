<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="css/form2.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        .navbar{
            border-top:1px solid rgb(199, 197, 197);

        }
    </style>
</head>
<body style="font-family: 'Kanit';">

<?php
//error_reporting(0);
session_start();
include "connection.php";
$successMsg = "";
$errorMsg = "";
// $formSubmitted = false;
$roleof="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true;
    $username=$conn->real_escape_string($_POST['username']);
    $password=$conn->real_escape_string($_POST['password']);

    $sql1="SELECT spassword FROM st_profile WHERE username =?  ";

    $sqlemail="SELECT spassword FROM st_profile WHERE email = ? ";
    $stmtemail=$conn->prepare($sqlemail);
    $stmtemail->bind_param("s",$username);
    $stmtemail->execute();
    $resemail=$stmtemail->get_result();

    $stmt=$conn->prepare($sql1);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $res=$stmt->get_result();
    if($res->num_rows>0||$resemail->num_rows>0){
        // $row=$res->fetch_assoc();
        // $row=$resemail->fetch_assoc();
        ($res->num_rows>0)?$row=$res->fetch_assoc(): $row=$resemail->fetch_assoc();
        $hashedpassword=$row['spassword'];
        if(password_verify($password,$hashedpassword)){
            ($res->num_rows>0)?$sql2="SELECT * FROM st_profile WHERE username = ? ": $sql2="SELECT * FROM st_profile WHERE email = ? ";
            // $sql2="SELECT * FROM st_profile WHERE username = ? ";
            $stmt2=$conn->prepare($sql2);
            $stmt2->bind_param("s",$username);
            $stmt2->execute();
            $res2=$stmt2->get_result();
            $row2=$res2->fetch_assoc();
            $roleof=$row2['prole'];
            $_SESSION['name']=$row2['sname'];
            $_SESSION['username']=$row2['username'];
            $_SESSION['id']=$row2['id'];
            $_SESSION['email']=$row2['email'];
            $_SESSION['role']=$row2['prole'];
            $_SESSION['phone']=$row2['phone'];
            $_SESSION['state']=$row2['state'];
            $_SESSION['address']=$row2['address'];
            $_SESSION['DOB']=$row2['DOB'];
            $_SESSION['gender']=$row2['gender'];
            $_SESSION['department_di']=$row2['department_di'];
            $_SESSION['course_id']=$row2['course_id'];
            $_SESSION['st_image_id']=$row2['st_image_id'];
            if($roleof=="admin"){
                header("Location:admin.php");
                exit;
             }else{
                 header("Location:profile.php");
                 exit;
             }
        }else{
            echo"wrong password";
        }
    }else{
            header("Location:form1.php");
    }
}
?>
<div class="row justify-content-center nav">
    <div class="heading col-12">NOWNESS</div>
    <nav class="navbar col-6">
      <p><a href="home.php">HOME</a></p>
      <p><a href="form1.php">REGISTER</a></p>
      <?php
        $set=false;
        $file="";
        $show="";

        if(isset($_SESSION['name'])){
          $show="MY PROFILE";
          if(($_SESSION['role']=="admin")){
            $file="admin.php";
          }else{
            $file="profile.php";
          }
        }else{
          $show="LOG IN";
          $file="login.php";
        }
        // if(($_SESSION['role']=="admin")){
        //   $file="admin.php";
        // }else{
        //   $file="prolile.php";
        ?>
        
        <p><a href="<?php echo $file; ?>"> <?php echo $show; ?> </a></p>
      <!-- <p><a href="login.php">LOGIN</a></p> -->
      <p><a href="about.php">ABOUT</a></p>
      <p><a href="contact.php">CONTACT US</a></p>
    </nav>
    </div>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1" style="font-family: 'Kanit';">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100" style="font-family: 'Kanit';">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100" style="font-family: 'Kanit';">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn mt-4">
						<button class="login100-form-btn" style="font-family: 'Kanit';">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
	
<?php
// Close the database connection
$conn->close();
?>

</body>
</html>