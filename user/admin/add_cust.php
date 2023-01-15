<?php

session_start();
error_reporting(0);

include('../includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{
	header('Location: logout.php');
}
else
{
  if(isset($_POST['submit']))
  {
    //FROM TABLE LICENSE
		  $licensetype = $_POST['license_Type'];
		  $expiration  = $_POST['expiration'];

    //FROM TABLE USER
	    $fname 	= $_POST['f_Name'];
	    $lname  = $_POST['l_Name'];
	    $gender = $_POST['gender'];
	    $email 	= $_POST['email'];

    //FROM TABLE CUSTOMER
	    $password = $_POST['cust_Pass'];


/*---NESTED QUERY INSERT---*/

    //INSERT INTO TABLE USER
      $sql = "INSERT INTO user (f_Name, l_Name, gender, age, email, phoneNo)
                  VALUES ('$fname', '$lname', '$gender', '', '$email', '')";

      $query = mysqli_query($conn,$sql);

      if($query)
      {

      //TO GET THE ID FROM PREVIOUS INSERT TABLE
				$user_id = mysqli_insert_id($conn);

		  //INSERT INTO TABLE CUSTOMER
		    $sql2 = "INSERT INTO customer (user_ID, cust_Username, cust_Pass, street, postcode, city, state)
		                  VALUES ('$user_id', '', '$password', '', '', '', '')";

        $query2 = mysqli_query($conn,$sql2);

        if ($query2)
				{  

				//TO GET THE ID FROM PREVIOUS INSERT TABLE
        	$cust_id = mysqli_insert_id($conn);

				//INSERT INTO TABLE LICENSE
      		$sql3 = "INSERT INTO license (cust_ID, license_Type, expiration) VALUES ('$cust_id', '$licensetype', '$expiration')";

      		$result = mysqli_query($conn,$sql3);

          if($result)
          {    
            $msg = "You have successfully inserted the data";
	          echo "<script type='text/javascript'>alert('$msg');</script>";
	          echo "<script type='text/javascript'> document.location ='index_cust.php'; </script>";
          }
          else
	        {
	          $msg = "Something went wrong. Please try again";
	          echo "<script type='text/javascript'>alert('$msg');</script>";
	        }
        }
	      else
	      {
	        $msg = "Failed to insert new data. Please try again";
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
			<h3>Add New Customer</h3>
			<p class="text-muted">Complete the form below to add a new customer</p>
		</div>

		<div class="container d-flex justify-content-center">
			<form action="" method="POST" style="width: 50vw; min-width: 300px;">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label">First Name:</label>
						<input type="text" class="form-control" name="f_Name" placeholder="Albert">
					</div>

					<div class="col">
						<label class="form-label">Last Name:</label>
						<input type="text" class="form-control" name="l_Name" placeholder="Einstein">
					</div>

					<div class="mb-3">
						<label class="form-label">License Type:</label>
						<input type="text" class="form-control" name="license_Type" placeholder="D/DA" maxlength="2">
					</div>

					<div class="mb-3">
						<label class="form-label">Expiration:</label>
						<input type="date" class="form-control" name="expiration" placeholder="Einstein">
					</div>

					<div class="mb-3">
						<label class="form-label">Email:</label>
						<input type="email" class="form-control" name="email" placeholder="name@example.com">
					</div>

					<div class="mb-3">
						<label class="form-label">Password:</label>
						<input type="password" class="form-control" name="cust_Pass" placeholder="pass">
					</div>

					<div class="form-group mb-3">
						<label>Gender:</label> &nbsp;
						<input type="radio" class="form-check-input" name="gender" id="male" value="Male">
						<label for="male" class="form-input-label">Male</label>
						&nbsp;
						<input type="radio" class="form-check-input" name="gender" id="female" value="Female">
						<label for="female" class="form-input-label">Female</label>
					</div>

					<div>
						<button type="submit" class="btn btn-success" name="submit">Save</button>

						<a href="index_cust.php" class="btn btn-danger">Cancel</a>
					</div>

				</div>
			</form>
		</div>
</div>
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>