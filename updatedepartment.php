<?php
include "connection.php";
if(isset($_GET['id'])) {
    $edit_id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM st_dept WHERE id = ?";
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
    $deptname = $conn->real_escape_string($_POST['coursename']);
    $deptHOD = $conn->real_escape_string($_POST['courseteacher']);
   
    // Update SQL query
    $updateSql = "UPDATE st_dept SET dept_name = ?, dept_HOD = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $created_date = date("Y-m-d H:i:s");
    $updateStmt->bind_param("ssi", $deptname,$deptHOD, $edit_id);
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
    <div class="row justify-content-center align-items-center">
    <div class="row col-5 border border-2 p-4 mt-5 rounded">
        <h2>Edit Department</h2>
        <form action="updatedepartment.php?id=<?php echo $edit_id; ?>" method="post">
           
            <div class="form-group">
                <label>department name:</label>
                <input type="text" name="coursename" value="<?php echo htmlspecialchars($row['dept_name']); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>department HOD:</label>
                <input type="text" name="courseteacher" value="<?php echo htmlspecialchars($row['dept_HOD']); ?>" class="form-control">
            </div>
           
           <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <?php
            echo "<a href='admin.php' class='btn btn-success mt-4 mx-1 btn-sm' >back</a>";
        ?>
    </div>
    </div>

</body>
</html>