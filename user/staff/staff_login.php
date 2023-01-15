<?php

session_start();
error_reporting(0);

  include('../includes/config.php');

    if(isset($_POST['submit']))
    {
      $username = $_POST['staff_Username'];
      $pass  = $_POST['staff_Pass'];
      $position = "Admin";

      $sql = "SELECT *
              FROM staff
              WHERE staff_Username = '$username' AND staff_Pass = '$pass' AND staff_Position <> '$position'";

      $query = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($query);

      if($row > 0)
      {
        $_SESSION['login'] = $row['staff_ID'];
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
  <h3>Staff Log In</h3><br>
      
  <!--USERNAME-->
    <label for="username"><b>Username</b></label>&emsp;
    <input type="text" name="staff_Username" maxlength="30" placeholder="Enter username" required><br><br>

  <!--PASSWORD-->
    <label for="pass"><b>Password</b></label>&emsp;
    <input type="password" name="staff_Pass" maxlength="12" placeholder="Enter password" required><br>

  <!--CHECKBOX REMEMBER ME-->
    <label>
      <br><input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <br><a href="#">Forgot password?</a>
  <!--BUTTON SUBMIT TO LOGIN-->
  <br><br> <!--Single line breaks-->
  <button type="submit" name="submit">Login</button>