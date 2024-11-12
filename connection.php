<?php
$host="localhost";
$username="root";
$password="";
$dbname="hpkvn_students";

$conn=new mysqli($host,$username,$password,$dbname);
if($conn->connect_error){
    die("connection failed: ".$conn->connect_error);
}else{
    // echo"connection done";
}
?>