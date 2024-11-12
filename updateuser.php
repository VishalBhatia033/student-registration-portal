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

if(isset($_POST['update'])) {
    // Get the updated data from the form
    // $updatedName = $conn->real_escape_string($_POST['sname']);
    $updatedPhone = $conn->real_escape_string($_POST['phone']);
    $updatedDOB = $conn->real_escape_string($_POST['dob']);
    // $updatedGender = $conn->real_escape_string($_POST['gender']);
    $updatedEmail = $conn->real_escape_string($_POST['email']);


    // $update='CURRENT_TIMESTAMP';
   
    // Update SQL query
    $updateSql = "UPDATE st_profile SET  phone = ?,dob = ?,email=?,updated_at = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    date_default_timezone_set('Asia/Kolkata');
    $created_date = date("Y-m-d H:i:s");
    $updateStmt->bind_param("ssssi", $updatedPhone, $updatedDOB,$updatedEmail,$created_date,$edit_id);
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
</style>
</head>
<body class="container row justify-content-center align-items-center">
    <div class="row col-6 border border-2 p-5 mt-5 rounded">
        <h2 class="col-12 text-center">Edit Profile</h2>
        <form action="updateuser.php?id=<?php echo $edit_id; ?>" method="post">

            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="text" name="dob" value="<?php echo htmlspecialchars($row['DOB']); ?>" class="form-control">
            </div>
           <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <?php
            echo "<a href='profile.php' class='btn btn-success mt-4 btn-sm col-12' >back</a>";
        ?>
    </div>
</body>
</html>