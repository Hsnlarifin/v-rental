<?php

session_start();
error_reporting(0);

include('../includes/config.php');

if(strlen($_SESSION['login'])==0)
{
  header('Location: logout.php');
}
else
{
  $cust_id = $_GET['login'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>V-Rental</title>
</head>
<body>
<button class="btn btn-success"><a href="update_profile.php">Update Profile</a></button><br><br>
<button class="btn btn-danger"><a href="logout.php">Logout</a></button>
</body>
</html>


