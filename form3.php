<?php
include "connection.php";
$sucessMsg="";
$errorMsg="";
$formSubmitted=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $formSubmitted=true;
    $coursename=$conn->real_escape_string($_POST['coursename']);
    $courseteacher=$conn->real_escape_string($_POST['teachername']);

    $checkSql=$conn->prepare("SELECT * FROM st_course WHERE course_name= '$coursename'");
    $checkSql->execute();
    $result=$checkSql->get_result();
    if($result->num_rows>0){
        $errorMsg="error: course name already exists <br>";
    }else{
        $insertSql=$conn->prepare("INSERT INTO st_course(course_name ,course_teacher) VALUES('$coursename','$courseteacher')");
        if($insertSql->execute()){
            $sucessMsg="course added sucessfully";
        }else{
            $errorMsg="error: ".$insertSql->error;
        }
    }
    $checkSql->close();

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
    #for{width:500px;
        margin:0 auto;
        background-color: #002a38;
        color:white;
    }
    body{
        background-color: #002a38;
        color:white;
    }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="pt-5">
    <?php
    if($formSubmitted){
        if(!empty($sucessMsg)){
            echo"<p class='text-success fw-bold text-center h3'>$sucessMsg</p>";
        }else if(!empty($errorMsg)){
            echo"<p class='text-danger fw-bold text-center h3'>$errorMsg</p>";
        }
    }
    ?>
        <h2 class="text-center fs-4">Add New Course</h2>
    <form action="form3.php" method="POST" id="for" class="form-group mt-5 p-4  rounded border border-2">
        <input type="text" class="form-control mt-3 border-2" placeholder="Course Name" name="coursename">
        <input type="text" class="form-control mt-3 border-2" placeholder="Course Teacher" name="teachername">
        <button class="mt-3  btn btn-sm btn-primary" >Register</button>
    </form>
    <?php
            echo "<div class='row justify-content-center '> <a href='admin.php' class='btn btn-success m-4 btn-sm col-4' >back</a></div>";
        ?>
</body>
</html>