<?php

include "connection.php";
$dir= "files/";

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $dir= "files/";
    $filePath=$dir.basename($_FILES["imgfile"]["name"]);
    $isUpload=true;
    $fileType=strtolower(pathinfo($filePath,PATHINFO_EXTENSION));

    // code to check the upload imaes is fake or actual 
    if(isset($_POST["submit"])){
        $check=getimagesize($_FILES["imgfile"]["tmp_name"]);
        if($check!=false){
            echo"file is an image -".$check["mime"]."<br";
            $isUpload=true;
        }else{
            echo"file is not an image <br>";
            $isUpload=false;
        }
    }
    // code to check files is already present in folder or not 
    if(file_exists($filePath)){
        echo"sorry , file already exists.<br>";
        $isUpload=false;
    }
    // code to insure the filesize 
    if($_FILES["imgfile"]["size"]>500000){
        echo"sorry, your file is too large <br>";
        $isUpload=false;
    }
    // Check if file is a image    
    if($fileType!="jpg"&&
    $fileType!="png"&&
    $fileType!="jpeg"&&
    $fileType!="gif"
    ){
        echo "Sorry, only jpg,png,jpeg and gif files are allowed. </br>";
        $isUpload=false;
    }
    // Check if  if the flag isupload is set to 0 due to error or not
    if(!$isUpload){
        echo "Sorry, your file was not uploaded.</br>";
    }else{
        if(move_uploaded_file($_FILES["imgfile"]
        ["tmp_name"],$filePath)){
            $filename=htmlspecialchars(basename($_FILES['imgfile']["name"]));

            echo "The file ".htmlspecialchars(basename($_FILES["imgfile"]["name"]));
            $stmt=$conn->prepare("INSERT INTO  st_profile_image (filename) VALUES (?)");
            $stmt->bind_param("s",$filename);
            if($stmt->execute()){
                echo"the file " .$filename."has been uploaded and saved in the database";
            }else{
                echo" there was and error uploading this file";
            }
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
        $stmt->close();

    }

}
?>