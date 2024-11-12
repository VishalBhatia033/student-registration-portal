<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/profile.css" />
  </head>
  <body>
    <div class="profilecontainer">
      <div class="profile">
        <?php
         $id=$_SESSION['st_image_id'];
         $image="SELECT filename FROM st_profile_image WHERE id='$id'";
         $result=$conn->query($image);
         $row=$result->fetch_assoc();
         $row=$row['filename'];
         $dir="profile_images/";
         $theid=$_SESSION['id'];
        ?>
         <?php
            if(isset($_GET['logout'])){
              session_destroy();
              header('Location:home.php');
            }
          ?>
        <img src="<?php echo $dir.'/'.$row; ?>" alt="" />
        <p style="text-transform:uppercase;"><?php echo $_SESSION['name']; ?></p>
        <button onclick="window.location.href = 'updateuser.php?id=<?php echo $theid;?>'" class="editdetails">Edit Details</button>
        <button onclick="window.location.href = 'updatepassword.php?id=<?php echo $theid;?>'" class="editpassword">Edit Password</button>
        <button onclick="window.location.href = 'profile.php?logout=`yes`';" class="logout">logout</button>
      </div>
      <div class="details">
        <div class="first">
          <p><b>USERNAME: &nbsp;</b><span class="content"><?php echo $_SESSION['username']; ?></span></p>
          <p><b>NAME: &nbsp;</b><span class="content"><?php echo $_SESSION['name']; ?></span></p>
          <p><b>EMAIL: &nbsp;</b><span class="content"><?php echo $_SESSION['email']; ?></span></p>
          <p><b>DOB: &nbsp;</b><span class="content"><?php echo $_SESSION['DOB']; ?></span></p>
          <p><b>STATE: &nbsp;</b><span class="content"><?php echo $_SESSION['state']; ?></span></p>
          <p><b>ADDRESS: &nbsp;</b><span class="content"><?php echo $_SESSION['address']; ?></span></p>
        </div>
        <div class="second">
          <p><b>PHONE NO: &nbsp;</b><span class="content"><?php echo $_SESSION['phone']; ?></span></p>
          <p><b>GENDER: &nbsp;</b><span class="content"><?php echo $_SESSION['gender']; ?></span></p>
          <p><b>ROLE: &nbsp;</b><span class="content" ><?php echo $_SESSION['role']; ?></span></p>
          <?php
              $username=$_SESSION['username'];
              $sql = "SELECT st_profile.*, st_profile_image.filename AS filename ,
              st_dept.dept_name AS dept_name,
              st_course.course_name AS course_name,
              st_course.course_teacher AS course_teacher, 
              st_dept.dept_HOD AS dept_HOD
              FROM st_profile 
              LEFT JOIN st_dept ON st_profile.department_id=st_dept.id 
              LEFT JOIN st_course ON st_profile.course_id=st_course.id 
              LEFT JOIN st_profile_image ON st_profile.st_image_id=st_profile_image.id 
              WHERE st_profile.username = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $username);
              $stmt->execute();
              $result1 = $stmt->get_result();
              $row1= $result1->fetch_assoc();
          ?>
          <p><b>COURSE: &nbsp;</b><span class="content"><?php echo $row1['course_name']; ?></span></p>
          <p><b>DEPARTMENT: &nbsp;</b><span class="content"><?php echo $row1['dept_name']; ?></span></p>
          <?php
          $conn->close();
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
