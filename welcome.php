<?php
session_start();
include "connection.php";

?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body class=" mt-5 mb-5 row justify-content-center bg-secondary" >
    <div class="col-10 rounded p-5" style="background-color:#CCD8D6;">


    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header("Location: login.php");
}
    ?>
        <h1 class="text-primary">welcome</h1>
        <?php  
          $id=$_SESSION['st_image_id'];
          $image="SELECT filename FROM st_profile_image WHERE id='$id'";
          $result=$conn->query($image);
          $row=$result->fetch_assoc();
          $row=$row['filename'];
          $dir="profile_images/";
  
          echo "<img style='border-radius:50%; border:2px solid black;' src='$dir/$row' height='100' width='100'  > <br>";
          
        echo "<b>Name : </b>". $_SESSION['name'];
        echo"<br>";
        echo "<b>Email : </b>". $_SESSION['email'];
        echo"<br>";
        echo "<b>DOB : </b>".$_SESSION['DOB'];
        echo"<br>";
        echo "<b>Gender : </b>".$_SESSION['gender'];
        echo"<br>";

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
        // print_r($row1);
        echo "<b>course : </b>".$row1['course_name'];
        echo"<br>";
        echo "<b>department : </b>".$row1['dept_name'];
        echo"<br>";
        echo "<b>course teacher : </b>".$row1['course_teacher'];
        echo"<br>";
        echo "<b>course HOD : </b>".$row1['dept_HOD'];
        echo"<br>";
        echo "<b>created at : </b>".$_SESSION['created_at'];
        echo"<br>";
        $update=$_SESSION['updated_at'];
        if($update=="0000-00-00 00:00:00"){
        echo "<b class='text-danger'>details never updated</b>";
        }else{
        echo "<b>updated at : </b>".$_SESSION['updated_at'];
        }
        echo"<br>";   
        $theid=$_SESSION['id'];
        echo "<a href='updateuser.php?id=".$theid."'class='btn btn-primary btn-sm mt-4' >Edit details</a>";
        echo "<a href='updatepassword.php?id=".$theid."'class='btn btn-success mx-4 mt-4 btn-sm' >update password</a>";
        ?>
        <!-- logout  -->
        <form action="welcome.php" method="POST">
            <br>
            <input type="submit" value="logout" class="btn btn-danger">
        </form>
    </div>

    </body>

</html>

<?php
?>