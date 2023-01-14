<?php 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$db_name = "vehicle_rental";


// Create connection 
$conn = mysqli_connect($servername, $username, $password, $db_name); 

// Check connection 
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); 
} 
"Connected to mySQL";

//mysqli_close($conn); 

?> 

