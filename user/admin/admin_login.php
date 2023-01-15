<?php

session_start();
error_reporting(0);

  include('../includes/config.php');

    if(isset($_POST['submit']))
    {
      $email = $_POST['email'];
      $pass     = $_POST['staff_Pass'];
      $position = "Admin";

      $sql = "SELECT u.user_ID, u.email, s.staff_ID, s.staff_Pass
              FROM user u
              INNER JOIN staff s
              ON u.user_ID = s.user_ID
              WHERE (u.email = '$email' OR s.staff_Username = '$email') AND staff_Pass = '$pass' AND staff_Position = '$position'";

      $query  = mysqli_query($conn,$sql);
      $row    = mysqli_fetch_array($query);

      if($row > 0)
      {
        $_SESSION['adminid'] = $row['staff_ID'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
      }
      else
      {
        $message = "Invalid username or password";
         echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>V-Rental</title>
</head>
<body>

  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    V-Rental Management System
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Admin Log In</h3>
    </div>

    <div class="container d-flex justify-content-center">
      <form action="" method="POST" style="width: 50vw; min-width: 300px;">
        <div class="row mb-3">
          <div class="col mb-3">
            <label class="form-label">Email / Username:</label>
            <input type="text" class="form-control" name="email" maxlength="30" placeholder="Enter email or username">
          </div>

          <div class="row">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" name="staff_Pass" maxlength="12" placeholder="Enter password">
          </div>

        <!--CHECKBOX REMEMBER ME-->
        <div class="col mb-3">
          <label>
            <br><input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>
          
        <br><a href="#">Forgot password?</a>
        <!--BUTTON SUBMIT TO LOGIN-->
          <div>
            <button type="submit" class="btn btn-success" name="submit">Log In</button>
          </div>

        </div>
      </form>
    </div>
</body>
</html>