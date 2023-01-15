<?php

session_start();
error_reporting(0);

include('../includes/config.php');

if(isset($_POST['submit']))
{
  $username = $_POST['cust_Username'];
  $pass  = $_POST['cust_Pass'];

  $sql = "SELECT * FROM customer WHERE cust_Username = '$username' AND cust_Pass = '$pass'";

  $query = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($query);
  if($row > 0)
  {
    $_SESSION['login'] = $row['cust_ID'];
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
  }
  else
  {
    $message = "Invalid username or password";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}
?>

<?php
  include('../includes/header.php');
?>


  <form method="POST">&emsp;
  <h3>Customer Log In</h3><br>
      
  <!--USERNAME-->
    <label for="username"><b>Username</b></label>&emsp;
    <input type="text" name="cust_Username" maxlength="30" placeholder="Enter username" required><br><br>

  <!--PASSWORD-->
    <label for="pass"><b>Password</b></label>&emsp;
    <input type="password" name="cust_Pass" maxlength="12" placeholder="Enter password" required><br>

  <!--CHECKBOX REMEMBER ME-->
    <label>
      <br><input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <br><a href="#">Forgot password?</a>
    <br><a href="signup.php">Create an account</a>
  <!--BUTTON SUBMIT TO LOGIN-->
  <br><br> <!--Single line breaks-->
  <button type="submit" name="submit">Login</button>