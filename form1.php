<?php
//error_reporting(0);
include "connection.php";
$successMsg = "";
$errorMsg = "";
$usernameErr="";
$emailErr="";
$imgErr="";
// $dir= "profile_images/";
$isUpload=true;
$isvalid=false;


$nameErr=$genderErr=$usernameErr=$emailErr=$phoneErr=$DOBErr=$passwordErr=$addressErr=$stateErr="";
$formSubmitted = false;
$isvalid=true;
// Fetch departments
$deptQuery = "SELECT id, dept_name FROM st_dept";
$deptResult = $conn->query($deptQuery);

//fetch image name
// $imgresult = "SELECT id, filename FROM st_profile_image";
// $imgresult = $conn->query($imgresult);
// Fetch courses
$courseQuery = "SELECT id, course_name FROM st_course";
$courseResult = $conn->query($courseQuery);

function testinput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}



if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $dir= "profile_images/";
    $filePath=$dir.basename($_FILES["imgfile"]["name"]);
    $isUpload=true;
    $fileType=strtolower(pathinfo($filePath,PATHINFO_EXTENSION));

    // code to check the upload imaes is fake or actual 
    if(isset($_POST["submit"])){
        $check=getimagesize($_FILES["imgfile"]["tmp_name"]);
        if($check!=false){
            // echo"file is an image -".$check["mime"]."<br";
            // echo"<p class='text-sucess'>file uploaded<?p>";
            $isUpload=true;
        }else{
            $imgErr="file is not an image <br>";
            $isUpload=false;
            $isvalid=false;
        }
    }
    // code to check files is already present in folder or not 
    if(file_exists($filePath)){
        $imgErr="sorry , file already exists.<br>";
        $isUpload=false;
        $isvalid=false;
    }
    // code to insure the filesize 
    if($_FILES["imgfile"]["size"]>1000000){
        $imgErr="sorry, your file is too large <br>";
        $isUpload=false;
        $isvalid=false;
    }
    // Check if file is a image    
    if($fileType!="jpg"&&
    $fileType!="png"&&
    $fileType!="jpeg"&&
    $fileType!="gif"
    ){
        $imgErr="Sorry, only jpg,png,jpeg and gif files are allowed. </br>";
        $isUpload=false;
        $isvalid=false;
    }
    // Check if  if the flag isupload is set to 0 due to error or not
    if(!$isUpload){
        $isUpload=false;
    }else{
        if(move_uploaded_file($_FILES["imgfile"]
        ["tmp_name"],$filePath)){ 
            $filename=htmlspecialchars(basename($_FILES['imgfile']["name"]));

            // echo "The file ".htmlspecialchars(basename($_FILES["imgfile"]["name"]));
            $stmt=$conn->prepare("INSERT INTO  st_profile_image (filename) VALUES (?)");
            $stmt->bind_param("s",$filename);
            if($stmt->execute()){
                echo" <p class='text-success text-center'>the file " .$filename."has been uploaded and saved in the database</p>";
            }else{
                $imgErr=" there was and error uploading this file";
                $isvalid=false;
            }
            $stmt->close();
        }else{
            $imgErr="Sorry, there was an error uploading your file.";
            $isvalid=false;

        }
        

    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true;
   
    // Sanitize and fetch form data
    
//fetch image name
    $imgresult = "SELECT id FROM st_profile_image GROUP BY id DESC LIMIT 1";
    $imgresult = $conn->query($imgresult);
    $row1=$imgresult->fetch_assoc();
    $pid= $row1['id'];
    // another way 
    // while($row1=$imgresult->fetch_assoc()){
    //     $pid= $row1['id'];
    // }
    

    
    $did = $conn->real_escape_string($_POST['did']);
    $address = $conn->real_escape_string($_POST['address']);
    $state = $conn->real_escape_string($_POST['state']);
    $cid = $conn->real_escape_string($_POST['cid']);
    $name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); // Consider hashing the password
    $phone = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $role = $conn->real_escape_string($_POST['role']);



    if(empty($_POST['name'])){
        $nameErr="Name is required";
        $isvalid=false;
    }else{
        $name=testinput($_POST['name']);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$name )){
            $nameErr="not valid name";
            $isvalid=false;
        }
    }
    // username
    if(empty($_POST['username'])){
        $usernameErr="username name is required";
        $isvalid=false;
    }else{
        $username=testinput($_POST['username']);
        if(!preg_match('/^[a-z\d_]{2,20}$/i',$username)){
            $usernameErr="invalid username";
            $isvalid=false;
        }
    }
    // password
    if(empty($_POST['password'])){
        $passwordErr="password name is required";
        $isvalid=false;
    }else{
        $password=testinput($_POST['password']);
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password)){
            $passwordErr="
            <ul>
            <p>you password must contain:</p>
            <p>at least one lowercase char</p>
            <p>at least one uppercase char</p>
            <p>at least one digit</p>
            <p>at least one special sign of @#-_$%^&+=§!?</p>
            </ul>
            ";
            $isvalid=false;
        }
    }
    // phone
    if(empty($_POST['phone'])){
        $phoneErr="phone number is required";
        $isvalid=false;
    }else{
        $phone=testinput($_POST['phone']);
        if(!preg_match("/^[0-9]*$/",$phone)){
            $phoneErr="your phone number must contain 10 number and only numbers";
            $isvalid=false;
        }
    }
    // email 
    if(empty($_POST['email'])){
        $emailErr="email is required";
        $isvalid=false;
    }else{
        $email=testinput($_POST['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $emailErr="invalid email format";
            $isvalid=false;
        }
    }

    // gender 
    if(empty($_POST['gender'])){
        $genderErr="also select gender";
        $isvalid=false;
    }else{
        $gender=testinput($_POST['gender']);
    }
    // state 
    if(empty($_POST['gender'])){
        $stateErr="also select state";
        $isvalid=false;
    }else{
        $state=testinput($_POST['state']);
    }
    
    // address 
    if(empty($_POST['address'])){
        $addressErr="enter your address";
        $isvalid=false;
    }else{
        $address=testinput($_POST['address']);
    }

 

if($isvalid){

    $sql1="SELECT * FROM st_profile WHERE  username = '$username'";
    $result1 = $conn->query($sql1);
    $check1 = mysqli_fetch_array($result1);

    $sql2="SELECT * FROM st_profile WHERE  email = '$email'";
    $result2 = $conn->query($sql2);
    $check2 = mysqli_fetch_array($result2);

    if(isset($check1)){
        $usernameErr="username exists";
        $deletImg="DELETE FROM st_profile_image WHERE id='$pid'";
        $deletImgRes=$conn->query($deletImg);
    }else if(isset($check2)){
       $emailErr="email exists";
       $deletImg="DELETE FROM st_profile_image WHERE id='$pid'";
       $deletImgRes=$conn->query($deletImg);
    }else{
 // SQL query to insert data into your table
 $hashedpass=password_hash($password,PASSWORD_DEFAULT);
 $sql = "INSERT INTO st_profile (department_id,st_image_id, course_id, sname, gender, username, email, spassword, phone, DOB,prole,address,state,updated_at,created_at) VALUES ( ?,?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?)";
 $update="0";
 date_default_timezone_set('Asia/Kolkata');
 $created_date = date("Y-m-d H:i:s");
 // Prepare and bind
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("iiissssssssssss", $did,$pid, $cid, $name, $gender, $username, $email, $hashedpass, $phone, $dob,$role,$address,$state,$update,$created_date);
 // Execute the statement
 if ($stmt->execute()) {
     $successMsg = "Student Added successfully";

     } else {
        $deletImg="DELETE FROM st_profile_image WHERE id='$pid'";
        $deletImgRes=$conn->query($deletImg);
        $errorMsg =  "Error: " . $insertSql->error;
     }

    }

}else{

    if($isUpload==true){
        $deletImg="DELETE FROM st_profile_image WHERE id='$pid'";
        $deletImgRes=$conn->query($deletImg);
    }

}
    
   

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/registration.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Profile Form</title>
    <style>
         footer {
  display: flex;
  height: 20vh;
  width: 100%;
  background-color: #002a38;
  line-height: 1.3;
  font-family: Menlo, monospace;
  justify-content:center;
  align-items:center;
  
}
footer ul{
  list-style: none;
  display:flex;
  justify-content:center;
  align-items:center;

}
footer ul li a{
  text-decoration:none;
  color:white;
  padding:1rem;
}
.footerlink:hover ~ #wave{
  animation: wave-animation 0.3s infinite;
}
header{
    background-color: #002a38;
    color:white;
  }
  .navbar p a{
    border-bottom:3px solid  #002a38;
    color:white;
  }
  .navbar p {
    border-bottom:3px solid  #002a38;
  }
  body{
    background-color:  #002a38;
    color:white;
  }
  label{
    padding:1rem 0;
    padding-bottom:0.5rem;
    color:rgb(201, 200, 200);
  }
  ::placeholder{
    color: rgb(213, 211, 211);
  }




@keyframes wave-animation {
  0%,
  100% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(20deg);
  }
  75% {
    transform: rotate(-15deg);
  }
}
    </style>
</head>
<body class="row justify-content-center ">
    <div class="row justify-content-center">
    <header class="col-12 row justify-content-center">
    <div class="heading col-12">REGISTER</div>
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
      <p><a href="about.php">ABOUT</a></p>
      <p><a href="contact.php">CONTACT US</a></p>
    </nav>
    </div>
    </header>

    
    <div class="container col-6 pt-5 pb-5 px-5 py-5 rounded border border-2 m-4 " >
        <!-- <h1 class="text-center text-dark">REGISTER</h1> -->
        <?php
            // Display messages only if the form has been submitted
            if ($formSubmitted) {
                if (!empty($successMsg)) {
                    echo "<p style='color: green;'>$successMsg</p>";
                } elseif (!empty($errorMsg)) {
                    echo "<p style='color: red;'>$errorMsg</p>";
                }
            }
            ?>
    <form method="POST" class="c" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        <!-- Department Dropdown -->
        <div class="form-group">
            <label for="did">Department Name</label>
            <select class="form-control" id="did" name="did" required>
                <?php
                if ($deptResult->num_rows > 0) {
                    while ($row = $deptResult->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . htmlspecialchars($row["dept_name"]) . "</option>";
                    }  
                } else {
                    echo "<option value=''>No departments available</option>";
                }
                ?>
            </select>
        </div>

        <!-- image id -->
        
        <!-- Course Dropdown -->
        <div class="form-group">
            <label for="cid">Course Name</label>
            <select class="form-control" id="cid" name="cid" required>
                <?php
                if ($courseResult->num_rows > 0) {
                    while ($row = $courseResult->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . htmlspecialchars($row["course_name"]) . "</option>";
                    }
                } else {
                    echo "<option value=''>No courses available</option>";
                }
                ?>
            </select>
        </div>

        <!-- role  -->
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="cid" name="role" required>
                <option value="student">student</option>
                <option value="admin">admin</option>
            </select>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="name">
        </div>
        <span style="color:red"><?php echo $nameErr ?></span>

        <!-- Gender -->
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <span style="color:red"><?php echo $genderErr ?></span>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="username">
        </div>
        <span style="color:red"><?php echo $usernameErr ?></span>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="email">
        </div>
        <span style="color:red"><?php echo $emailErr ?></span>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="password">
        </div>
        <span style="color:red"><?php echo $passwordErr ?></span>
        <!-- role  -->
        <div class="form-group">
            <label for="state">state</label>
            <select class="form-control" id="state" name="state" >
                <option value="">--select your state--</option>
                <option value="himachal pardesh">himachal pradesh</option>
                <option value="punjab">punjab</option>
                <option value="madhya pardesh">madhya pardesh</option>
                <option value="rajsthan">rajsthan</option>
                <option value="ttar pardesh">uttar pardesh</option>
                <option value="bihar">bihar</option>
                <option value="maharastra">maharastra</option>
                <option value="J&K">J&K</option>
                <option value="odisha">odisha</option>
                <option value="gujrat">gujrat</option>


            </select>
        </div>
        


        <!-- address -->
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address"  cols="30" class="form-control" rows="3" required>
            </textarea>
        </div>
        <span style="color:red"><?php echo $addressErr ?></span>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required placeholder="phone number">
        </div>
        <span style="color:red"><?php echo $phoneErr ?></span>

        <!-- Date of Birth -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required placeholder="date of birth">
        </div>
        <!-- image  -->
        <div class="form-group">
            <label for="imgfile">Date of Birth</label>
            <input type="file" class="form-control" id="dob" name="imgfile" >
        </div>
        <span style="color:red"><?php echo $imgErr ?></span>
        <br>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Register</button>
       
    </form>
   
            </div>

            <footer>
  <ul>
  <li>
      <p id="wave">👋</p>
    </li>
    <li><a class="footerlink" href="home.php">Home</a></li>
    <li><a class="footerlink" href="about.php">About</a></li>
    <li><a class="footerlink" href="form1.php">Register</a></li>
    <li><a class="footerlink" href="login.php">Log in</a></li>
    <li><a class="footerlink" href="contact.php">Contact us</a></li>
  </ul>
</footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>