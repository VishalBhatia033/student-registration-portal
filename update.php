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
    $updatedName = $conn->real_escape_string($_POST['sname']);
    $updatedUser = $conn->real_escape_string($_POST['username']);
    $updatedEmail = $conn->real_escape_string($_POST['email']);
    $updatedGender = $conn->real_escape_string($_POST['gender']);
    $updatedPhone = $conn->real_escape_string($_POST['phone']);
    $updatedDOB = $conn->real_escape_string($_POST['dob']);
    $address = $conn->real_escape_string($_POST['address']);
    $state = $conn->real_escape_string($_POST['state']);



    $update='CURRENT_TIMESTAMP';
   
    // Update SQL query
    $updateSql = "UPDATE st_profile SET sname = ?, username = ?, email = ?,gender = ?, phone = ?,dob = ?,updated_at = ?,address=?, state=? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $created_date = date("Y-m-d H:i:s");
    $updateStmt->bind_param("sssssssssi", $updatedName,$updatedUser,$updatedEmail,$updatedGender, $updatedPhone, $updatedDOB,$created_date,$address,$state, $edit_id);
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
<body>
    <div class=" row  justify-content-center align-items-center">
    <div class="row col-6 border border-2 p-5 mt-5 rounded mb-5">
        <h2 class="text-center">Edit Profile</h2>
        <form action="update.php?id=<?php echo $edit_id; ?>" method="post">
           
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="sname" value="<?php echo htmlspecialchars($row['sname']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <input type="text" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="text" name="dob" value="<?php echo htmlspecialchars($row['DOB']); ?>" class="form-control">
            </div>

            <div class="form-group">
            <label for="state">state</label>
            <select class="form-control" id="state" name="state" >
                <option value="">--select your state--</option>
                <option value="himachal pardesh">himachal pardesh</option>
                <option value="punjab">punjab</option>
                <option value="madhya pardesh">madhya pardesh</option>
                <option value="rajsthan">rajsthan</option>
                <option value="uttar pardesh">uttar pardesh</option>
                <option value="bihar">bihar</option>
                <option value="maharastra">maharastra</option>
                <option value="J&K">J&K</option>
                <option value="odisha">odisha</option>
                <option value="gujrat">gujrat</option>
            </select>
        </div>
            <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" value="<?php echo htmlspecialchars($row['address']); ?>"  cols="30" class="form-control" rows="3" required>
            </textarea>
        </div>
           <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>

        <?php
            echo "<a href='admin.php' class='btn btn-success mt-4 btn-sm' >back</a>";
        ?>
    </div>
    </div>

</body>
</html>