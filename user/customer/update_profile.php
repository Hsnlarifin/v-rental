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
  if(isset($_POST['submit']))
  {
    $cust_id = $_GET['login'];

      //FROM TABLE USER
        $fname = $_POST['f_Name'];
        $lname  = $_POST['l_Name'];
        //$gender = $_POST['gender'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phoneNo = $_POST['phoneNo'];

      //FROM TABLE CUSTOMER
        $username = $_POST['cust_Username'];
        $password = $_POST['cust_Pass'];
        $street = $_POST['street'];
        $postcode = $_POST['postcode'];
        $city = $_POST['city'];
        $state = $_POST['state'];

       //FROM TABLE LICENSE
        $licensetype = $_POST['license_Type'];
        $expiration  = $_POST['expiration'];

/*--SUB-QUERY--*/
    //UPDATE INTO TABLE USER
      $sql = "UPDATE user SET f_Name = '$fname', l_Name = '$lname', age = '$age', email = '$email', phoneNo = '$phoneNo'
              WHERE user_ID IN (SELECT user_ID 
                                FROM customer
                                WHERE cust_ID IN (SELECT cust_ID
                                                  FROM license
                                                  WHERE cust_ID = '$cust_id'))";

      $query = mysqli_query($conn,$sql);

      if($query)
      {
        //UPDATE INTO TABLE CUSTOMER
          $sql2 = "UPDATE customer SET cust_Username = '$username', cust_Pass = '$password', street = '$street', postcode = '$postcode', city = '$city', state = '$state' WHERE cust_ID IN (SELECT cust_ID
                                                      FROM license
                                                      WHERE cust_ID = '$cust_id')";
          
          $query2 = mysqli_query($conn,$sql2);

          if ($query2)
          {
          //UPDATE INTO TABLE LICENSE
            $sql3 = "UPDATE license SET license_Type = '$licensetype', expiration = '$expiration'
                      WHERE cust_ID = '$cust_id'";

            $result = mysqli_query($conn,$sql3);

            if ($result)
            {
              $msg = "You have successfully update the data!";
              echo "<script type='text/javascript'>alert('$msg');</script>";
              echo "<script type='text/javascript'> document.location ='index.php'; </script>";
            }  
            else
            {
              $msg = "Something went wrong. Please try again";
              echo "<script type='text/javascript'>alert('$msg');</script>";
            }
          }
          else
          {
            $msg = "Failed to update the data. Please try again";
            echo "<script type='text/javascript'>alert('$msg');</script>";
          } 
      }      
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php include('header.php'); ?>

</head>
<body>

  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    V-Rental Management System
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Update Profile</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
      include('../includes/config.php');

      $cust_id = $_SESSION['login'];

/*---INNER JOIN TABLE---*/
      $sql = "SELECT u.f_Name, u.l_Name, u.age, u.email, u.phoneNo, c.cust_Username, c.cust_Pass, c.street, c.postcode, c.city, c.state, l.license_Type, l.expiration
              FROM user u
              INNER JOIN customer c ON u.user_ID = c.user_ID
              INNER JOIN license l ON c.cust_ID = l.cust_ID
              WHERE l.cust_ID = '$cust_id'";

      $result  = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="POST" style="width: 50vw; min-width: 300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="f_Name" maxlength="20" value="<?php echo $row['f_Name']?>">
          </div>

          <div class="col mb-3">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="l_Name" maxlength="20" value="<?php echo $row['l_Name']?>">
          </div>
        </div>


        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Age:</label>
            <input type="int" class="form-control" name="age" maxlength="2" value="<?php echo $row['age']?>">
          </div>

          <div class="col mb-3">
            <label class="form-label">Phone No:</label>
            <input type="text" class="form-control" name="phoneNo" maxlength="11" value="<?php echo $row['phoneNo']?>">
          </div>
        </div>


          <div class="mb-4">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>">
          </div>


        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Username:</label>
            <input type="text" class="form-control" name="cust_Username" value="<?php echo $row['cust_Username']?>">
          </div>

          <div class="col mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" name="cust_Pass" value="<?php echo $row['cust_Pass']?>">
          </div>
        </div>


        <div class="row mb-3">
          <div class="col">
            <label class="form-label">License Type:</label>
            <input type="text" class="form-control" name="license_Type" value="<?php echo $row['license_Type']?>">
          </div>

          <div class="col mb-3">
            <label class="form-label">Expiration:</label>
            <input type="date" class="form-control" name="expiration" value="<?php echo $row['expiration']?>">
          </div>
        </div>


          <div class="mb-3">
            <label class="form-label">Street:</label>
            <input type="text" class="form-control" name="street" value="<?php echo $row['street']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Postcode:</label>
            <input type="int" class="form-control" name="postcode" maxlength="5" value="<?php echo $row['postcode']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">City:</label>
            <input type="text" class="form-control" name="city" value="<?php echo $row['city']?>">
          </div>

          <div class="mb-4">
            <label class="form-label">State:</label>
            <input type="text" class="form-control" name="state" value="<?php echo $row['state']?>">
          </div>

          <div class="mb-5">
            <button type="submit" class="btn btn-success" name="submit">Update</button>

            <a href="index.php" class="btn btn-danger">Back</a>
          </div>
    </form>
  </div>
</div>
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>