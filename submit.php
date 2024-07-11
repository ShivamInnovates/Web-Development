<?php
error_reporting(0);
$server= "localhost";
$user = "root";
$pass = "admin";
$db= "Registration";

$conn = mysqli_connect($server,$user,$pass,$db);

if($conn)
{
    //echo " connected to Database";
}
else
{
    echo "not Connected successfully";
}

?>