<?php
include "connection.php";
$sql="SELECT filename FROM st_profile_image";
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo '<img src="files/'.$row["filename"].'"alt="'.$row["filename"].'"style="width:200px">';
    }
}else{
    echo"no images found";
}
$conn->close();
?>