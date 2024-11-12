<?php
include "connection.php";
if(isset($_GET['id'])) {
    $edit_id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM st_profile WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Now $row contains the data of the record to be edited
    } else {
        echo "No record found";
        // Redirect or handle the error
    }
} else {
    echo "No ID provided";
    // Redirect or handle the error
}
$passwordErr="";
$isvalid=true;
function testinput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

if(isset($_POST['update'])) {
    // Get the updated data from the form
    $oldpassword = $conn->real_escape_string($_POST['oldpassword']);
    $sql = "SELECT spassword FROM st_profile WHERE id = '$edit_id'";
    $res=$conn->query($sql);
    $row2=$res->fetch_assoc();
    $hashedpassword=$row2['spassword'];
    if(password_verify($oldpassword,$hashedpassword)){

        $newpassword1 = $conn->real_escape_string($_POST['newpassword1']);
        $newpassword2 = $conn->real_escape_string($_POST['newpassword2']);
        if($newpassword1==$newpassword2){

            // newpassword1 validation
            if(empty($_POST['newpassword1'])){
            $passwordErr="password name is required";
            $isvalid=false;
            }else{
            $newpassword1=testinput($_POST['newpassword1']);
            if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$newpassword1)){
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

           if($isvalid){
                 // Update SQL query
                 $updateSql = "UPDATE st_profile SET spassword = ?,updated_at=? WHERE id = ?";
                 $updateStmt = $conn->prepare($updateSql);
                 date_default_timezone_set('Asia/Kolkata');
                 $created_date = date("Y-m-d H:i:s");
                 $hashedpass=password_hash($newpassword1,PASSWORD_DEFAULT);
                 $updateStmt->bind_param("sss", $hashedpass,$created_date,$edit_id);
                 $updateStmt->execute();
                 
                 if ($updateStmt->affected_rows > 0) {   
                     echo "Record updated successfully";
                     // Redirect or further processing
                 } else {   
                     if($updateStmt->error) {
                         echo "Error updating record: " . $updateStmt->error;
                     } else {
                         echo "No changes were made to the record.";
                     }
                 }
                 $updateStmt->close();
           }

        }else{
            echo"new password doesnot match";
        }

    }else{
        echo"old password doesnot match "; 
    }

    
}
$conn->close();

?>

<!-- HTML form for editing -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
     body{
        background-color: #002a38;
        color:white;
    }
    label{
    padding:1rem 0;
    padding-bottom:0.5rem;
    color:rgb(201, 200, 200);
  }
</style></head>
<body class="row justify-content-center align-items-center">
    <div class="row col-5 border border-2 p-4 mt-5 rounded">
        <h2>Edit Password</h2>
        <form action="updatepassword.php?id=<?php echo $edit_id; ?>" method="post">
           
            <div class="form-group">
                <label>old password:</label>
                <input type="password" name="oldpassword"  class="form-control">
            </div>

            <div class="form-group">
                <label>new password :</label>
                <input type="password" name="newpassword1"  class="form-control">
            </div>
            <span><?php echo $passwordErr ?></span>

            <div class="form-group">
                <label>new password:</label>
                <input type="password" name="newpassword2" class="form-control">
            </div>
            <span><?php echo $passwordErr ?></span>
           <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <?php
            echo "<a href='profile.php' class='btn btn-success mt-4 btn-sm' >back</a>";
        ?>
    </div>
    </div>

</body>
</html>