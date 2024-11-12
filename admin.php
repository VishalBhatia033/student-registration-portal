<?php
        session_start();
        include "connection.php";
    ?>
<?php
if(isset($_GET['delete_id'])){
    $delete_id=$conn->real_escape_string($_GET['delete_id']);
    $tabelname=$_GET['tablename'];
    $conn->query("SET FOREIGN_KEY_CHECKS=0");
    $delete_sql="DELETE FROM $tabelname WHERE id=?";
    $delete_stmt=$conn->prepare($delete_sql);
    $delete_stmt->bind_param("i",$delete_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    $conn->query("SET FOREIGN_KEY_CHECKS=1");
    header("Location: admin.php");
    // exit;
}
            if(isset($_GET['logout'])){
              session_destroy();
              header('Location:home.php');
            }
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .logo p{
    margin: 0;
    padding: 0;
}
.links{
    display: flex;
    /* padding: 0 1rem; */
    /* gap: 1rem; */
    width:88%;
}
.links p{
    margin: 0;
    padding: 0;
}

a{
    text-decoration: none;
    text-transform: capitalize;
    color: black;
}
.links>a{
    width: 100%;
    display: flex;
    gap: 1rem;
}
#main_logo_a{
    display: flex;
    justify-content: space-between;
}
#nav{
    transition:0.5s ease all;
}
#main_container{
    transition:0.5s ease all;
}
</style>
<body>
    
    <div class="container">
        <div class="thenavbanner">
        </div>
        <div class="sidebar" id="nav">
            <div class='buttons'>
           <div class="logo links">
            <a href="#" id="main_logo_a">
            <p class="nav_link">NOWNESS</p>
            <span class="nav_main_logo ">
                <i onclick="slide(this)" class="fa-solid nav_logo fa-angle-left"></i>
            </span>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('dashbord')">
            <div class="links">
            <a href="#" class="main_a">
            <span >
            <i class="fa-solid fa-igloo nav_logo"></i>
            </span>
            <p class="nav_link">Dashbord</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table1')">
            <div class="links">
            <a href="#" class="main_a">
            <span >
            <i class="fa-solid fa-user-pen nav_logo"></i>
            </span>
            <p class="nav_link">Manage Students</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table2')">
            <div class="links">
            <a href="#" class="main_a">
            <span >
            <i class="fa-solid fa-file-pen nav_logo"></i>
            </span>
            <p class="nav_link">Manage Courses</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table3')">
            <div class="links">
            <a href="#" class="main_a">
            <span >
            <i class="fa-solid fa-pen-to-square nav_logo"></i>
            </span>
            <p class="nav_link">Manage Departments</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table3')">
            <div class="links">
            <a href="form3.php" class="main_a">
            <span >
            <i class="fa-solid fa-file-circle-plus nav_logo"></i>
            </span>
            <p class="nav_link">Add Courses</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table3')">
            <div class="links">
            <a href="form2.php" class="main_a">
            <span>
            <i class="fa-solid fa-plus nav_logo"></i>
            </span>
            <p class="nav_link">Add Departments</p>
            </a>
            </div>
            </div>

            <div class="buttons" onclick="display('table3')">
            <div class="links">
            <a href="form1.php" class="main_a">
            <span >
            <i class="fa-solid fa-user-plus nav_logo"></i>
            </span>
            <p class="nav_link">Add Student</p>
            </a>
            </div>
            </div>
            
            
            <div class="buttons logoutbtn" onclick="logout()">
            <div class="links">
            <a href="admin.php?logout='yes'" class="main_a">
            <span class="nav_logo">
            <i class="fa-solid fa-right-from-bracket nav_logo"></i>
            </span>
            <p class="nav_link">Log Out</p>
            </a>
            </div>
            </div>
        </div>
        <div class="maincontainer" id='main_container' >
            <div class="nav">
                <span class="heading">ADMIN'S PAGE</span>
                <span class="profile">
                    <?php
                     $id=$_SESSION['st_image_id'];
                     $image="SELECT filename FROM st_profile_image WHERE id='$id'";
                     $result=$conn->query($image);
                     $row=$result->fetch_assoc();
                     $row=$row['filename'];
                     $dir="profile_images/";
                     $adminname=$_SESSION['name'];             
                    ?>
                <img class="profilepicture" src="<?php echo $dir.'/'.$row;?>" alt="">
                <p><?php echo "  ".$adminname;?></p>
                </span>
            </div>
           
            <div class="totalcontainer" id="dashbord">
                <div class="third">
                    <div class="textbanner">
                        WELCOME   &nbsp; <span style="text-transform:uppercase;"><?php echo "  ".$adminname;?></span>
                    </div>
    
                </div>
                <div class="boxes">
                    <div class="total totalpersons">
                        <div class="num">
                            <?php
                              $table="st_profile";
                              $r="SELECT COUNT(*) FROM st_profile";
                              $res=$conn->query($r);
                              $ro=$res->fetch_assoc();
                            ?>
                            <h1><?php echo $ro['COUNT(*)'];?></h1>
                            <i class="fa-solid fa-person-circle-check"></i>
                        </div>
                        <span class="flag">TOTAL</span>
                        <p>Persons Registered</p>
                    </div>
                    <div class="total totalcourses">
                        <div class="num">
                            <?php
                            $table="st_course";
                            $r="SELECT COUNT(*) FROM st_course";
                            $res=$conn->query($r);
                            $ro=$res->fetch_assoc();
                            ?>
                            <h1><?php echo $ro['COUNT(*)'];?></h1>
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <span class="flag">TOTAL</span>
                        <p>Courses Registered </p>
                    </div>
                    <div class="total totaldepartments">
                        <div class="num">
                            <?php 
                            $table="st_dept";
                            $r="SELECT COUNT(*) FROM st_dept";
                            $res=$conn->query($r);
                            $ro=$res->fetch_assoc();
                            ?>
                            <h1><?php echo $ro['COUNT(*)'];?></h1>
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <span class="flag">TOTAL</span>
                        <p>Departments Registered</p>
                    </div>
                </div>
               
            </div>

            <?php

                
                $role="student";
                $sql="SELECT * FROM st_profile WHERE prole='$role'";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    echo" <div id='total_students_table'> <table id='table1''>
                    <tr>
                    <th>S No.</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>Id created at</th>
                    <th colspan='3'>Last updated</th>
                    </tr>";
                    $i=1;
                    while($row=$result->fetch_assoc()){
                        $table="st_profile";

                        $update=$row['updated_at'];
                        if($update=="0000-00-00 00:00:00"){
                            $update="never updated";
                            }else{
                                $update=$row['updated_at'];
                            }
                            $did=$row["department_id"];
                        $sql5="SELECT dept_name FROM st_dept WHERE id='$did'";
                        $result5=$conn->query($sql5);
                        $result5=$result5->fetch_assoc();
            
                        $cid=$row["course_id"];
                        $sql6="SELECT course_name FROM st_course WHERE id='$cid'";
                        $result6=$conn->query($sql6);
                        $result6=$result6->fetch_assoc();
                    echo"<tr>
                    <td>" .$i++."</td>
                    <td>" .$result5['dept_name']."</td>
                    <td>" .$result6['course_name']."</td> 
                    <td>" .htmlspecialchars($row["sname"])."</td>
                    <td>" .htmlspecialchars($row["gender"])."</td>
                    <td>" .htmlspecialchars($row["username"])."</td>
                    <td>" .htmlspecialchars($row["email"])."</td>
                    <td>" .$row["phone"]."</td>
                    <td>" .$row["DOB"]."</td>
                    <td>" .$row["state"]."</td>
                    <td>" .$row["address"]."</td>
                    <td>" .$row["created_at"]."</td>
                    
                    <td>" .$update."</td>
            
                    <td>
                    <a href='update.php?id=".$row["id"]."'class='editbtn' >Edit</a></td>
                    <td> 
                    <a  href='admin.php?delete_id=".$row["id"]."&tablename=".$table."' class='deletebtn'>Delete</a>
                    </td>
                    </tr>";

                    }
                    echo"</table> </div>";
                    
                }else{
                    echo "0 results";
                }



                $sql3="SELECT * FROM st_course";
                $result3=$conn->query($sql3);
                if($result3->num_rows>0){
                    $table="st_course";
                    $r="SELECT COUNT(*) FROM st_course";
                    $res=$conn->query($r);
                    $ro=$res->fetch_assoc();
                     echo"<div id='total_courses_table'> <table id='table2'>
                    <tr>
                    <th>S No.</th>
                    <th>Course name</th>
                    <th colspan='3'>Course Teacher</th>
                    </tr>";
                    $i=1;
                    while($row4=$result3->fetch_assoc()){
                    echo"<tr>
                    <td>" .$i++."</td>
                    <td>" .$row4["course_name"]."</td>
                    <td>" .$row4["course_teacher"]."</td>
                    <td>
                    <a href='updatecourse.php?id=" . $row4["id"]."'class='editbtn' >Edit</a></td>
                    <td> 
                    <a href='admin.php?delete_id=" . $row4["id"]."&tablename=".$table."'class='deletebtn' >Delete</a>
                    </td>
                    </tr>";
              }
              echo"</table> </div>";
              
              }else{
              echo "0 results";
              }
      


                $sql2="SELECT * FROM st_dept";
                $result2=$conn->query($sql2);
                if($result2->num_rows>0){
                    $table="st_dept";
                    $r="SELECT COUNT(*) FROM st_dept";
                    $res=$conn->query($r);
                    $ro=$res->fetch_assoc();
                    echo"<div id='total_departments_table'>  <table id='table3'>
                    <tr>
                    <th>S No.</th>
                    <th>Department Name</th>
                    <th colspan='3'>Department HOD</th>
                    </tr>";
                    $i=1;
                    while($row3=$result2->fetch_assoc()){
                    echo"<tr>
                    <td>" .$i++."</td>
                    <td>" .$row3["dept_name"]."</td>
                    <td>" .$row3["dept_HOD"]."</td>
                    <td>
                    <a href='updatedepartment.php?id=" . $row3["id"]."'class='editbtn' >Edit</a></td>
                    <td> 
                    <a href='admin.php?delete_id=" . $row3["id"]."&tablename=".$table."'class='deletebtn'>Delete</a>
                    </td>
                    </tr>";
                    }
                    echo"</table>  </div>";
                    
                    }else{
                    echo "0 results";
                    }
                 $conn->close();

            ?>
           
            

            
            
            
           
        </div>
    </div>


</body>

<script src="js/admin.js"></script>
</html>