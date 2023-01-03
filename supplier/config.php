<?php 

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "veh_rental";

$conn = new mysqli($sname,$uname,$password,$db_name);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

?>