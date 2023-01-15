<?php
  $servername = "localhost";
  $dbusername = "root";
  $pass = "";
  $dbname = "veh_rental";

  //Create connection
  $conn = mysqli_connect($servername, $dbusername, $pass, $dbname);

  //Check connection
  if(mysqli_connect_errno())
  {
    echo "Connection failed: " . mysqli_connect_error();
  }
  //echo "Connected successfully";
?>
