<?Php
// Question 1------
// a varibale in php is a name given to the memory loaction we use $ sign to create a variable in php
// a varibale can be assign many types of values like integer,string,boolean and floating etc
echo"Hello, class my job is done <br>" ;


// Question 2-------
$str="Vishal Bhatia";


// Question 3----------
$age = array("rajesh"=>"22", "aman"=>"44", "vikrant"=>"33");


// Question 4----------
$a=10;
$b=10;
function operations($a,$b){
    $addition=$a+$b;
    $substraction=$a-$b;
    $multiplication=$a*$b;
    $division=$a/$b;
    echo"addition: $addition <br> substration: $substraction <br> multiplication: $multiplication <br> divison: $division <br>";
}
operations($a,$b);


// Question 5 ----------
// functions are the block of code which are given a value they process it and return the result
// fuctions are of two types user defined fuctions and inbuild functions, the functions helps to reduce the
// repetetiveness of code once a fuction is written it can be use multiple times.
function multipleOfThree($m){
    if($m%3==0){
        return true;
    }else{
        return false;
    }
}

// we call a function by writing its name and inside the round brackets we pass values that are know as arguments 
// this function will return true if the number passed is multiple of 3 and false if it is not 
echo multipleOfThree(8);


// Question 6-----------
// both GET and POST method are use to submit and pass the form data we access the data after submition through 
// global varibale $_GET and $_POST
//but the POST method is more secure then the GET method because GET method pass the value through the header
//which leads to security issues we can use GET to pass the type of data which will not create and security issue
//we cannot pass passwords in GET

// Question 7---------
// we can pass values by URL in PHP by GET method 
// and we can also write it manualy and the it can be fetched through GET method 
// example
$name="Vishal Bhatia";
echo "<a href='phptest3.php?name=$name'>Click to display your name passed through URL using varible</a> <br>";
if($_GET){
    echo $_GET['name']."<br>";
}


// Question 8---------
// even numbers from 0 to 20 
for($i=0;$i<=20;$i++){
    if($i%2==0){
        echo "$i <br> ";
    }
}


// Question 9 
function checkPalindrome($strORG){
    $strREV=strrev($strORG);
    if($strREV===$strORG){
        echo"string is palindrome <br>";
    }else{
        echo"string is not a palindrome <br>";
    }
}
checkPalindrome("BOOB");


// Question 10 -------
//we can fetch the form data in PHP through two methods GET and POST according to our requirements
//the input data is accessed through the name attribute 
//while creating form we specify the type of method in method attribute we want to use and the action attribute
//which specify which page will be displayed after submition or what action will be taken after submition of form

if($_POST){
    echo"<div style='border:3px solid red; padding:2rem;margin:2rem 0;'>";
    echo"<b> Your Name: </b>".$_POST['name']."<br>";
    echo"<b>Your age: </b>".$_POST['age']."<br>";
    echo"</div>";
}

?>

<html>
    <body>
        <form action="phptest3.php" method="POST">
            <label for="name">Name : </label>
            <input type="text" name="name" placeholder="enter your name">
            <br>
            <label for="name">Age : </label>
            <input type="text" name="age" placeholder="enter your age">
            <br>
            <input type="submit" value="submit">
        </form>
    </body>
</html>
<?php


// Question 11 -------
$host="localhost"; //the host name
$username="root"; //username
$password=""; //password if 
$dbname="hpkvn_students"; //name of database

$conn=new mysqli($host,$username,$password,$dbname); //passing all arguments in mysqli fuction and stored it in conn variable
if($conn->connect_error){ //checking if there is an error in connecting to SQL database
    die("connection failed: ".$conn->connect_error."<br>");//showing the error
}else{
    echo"connection done <br>";//if connection done successfully this message will display
}


// Question 12 -------
// sorting an array in ascending order 
// we can also use the sort() fuction which is an inbuild function of php for array sorting
echo"<br>";
$num=array(44,22,66,3,11,6,1,7);
for($i=0;$i<count($num);$i++){
    for($j=$i+1;$j<count($num);$j++){
        if($num[$i]>$num[$j]){
            $swap=$num[$j];
            $num[$j]=$num[$i];
            $num[$i]=$swap;
        }
    }
}
print_r($num);


// Question 13 -------
//to use include and require we need to write the keyword include and require and then name of file we want to include 
//include and require both are same but if we use require the only difference is that if the file is not found, 
// it prevents the script from running, while include does not.
//include file copies all text,code which is present inside the file as it is.
//example------
// include'filename.extension';
// require'filename.extension';

?>