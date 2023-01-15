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
	if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //FROM TABLE LOCATION
      $street = $_POST['location_Street'];
      $postcode = $_POST['location_PostCode'];
      $city = $_POST['location_City'];
      $state = $_POST['location_State'];

    //FROM TABLE BRANCH
      $branch = $_POST['branch_Name'];
      $branchphoneno = $_POST['branch_PhoneNo'];

    //INSERT INTO TABLE LOCATION
      $sql = "INSERT INTO location (location_Street, location_PostCode, location_City, location_State)
              VALUES ('$street', '$postcode', '$city', '$state')";

      $query = mysqli_query($conn,$sql);

      if($query)
      {
      //TO GET THE PREVIOUS ID FOR FK
        $location_id = mysqli_insert_id($conn);

      //INSERT INTO TABLE BRANCH
        $sql2 = "INSERT INTO branch (location_ID, branch_Name, branch_PhoneNo)
                  VALUES ('$location_id', '$branch', '$branchphoneno')";


        $result = mysqli_query($conn,$sql2);

        if($result)
        {
          $msg = "You have successfully inserted the data";
          echo "<script type='text/javascript'>alert('$msg');</script>";
          echo "<script type='text/javascript'> document.location ='index_branch.php'; </script>";
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
			<h3>Add New Branch</h3>
			<p class="text-muted">Complete the form below to add a new branch</p>
		</div>


		<div class="container d-flex justify-content-center">
			<form action="" method="POST" style="width: 50vw; min-width: 300px;">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Branch Name:</label>
						<input type="text" class="form-control" name="branch_Name" placeholder="Car Rental Melaka">
					</div>

					<div class="col mb-3">
						<label class="form-label">Phone Number:</label>
						<input type="text" class="form-control" name="branch_PhoneNo" placeholder="06-xxxxxxx" maxlength="10">
					</div>

					<div class="mb-3">
						<label class="form-label">Street:</label>
						<input type="text" class="form-control" name="location_Street" placeholder="street address">
					</div>

					<div class="mb-3">
						<label class="form-label">Postcode:</label>
						<input type="text" class="form-control" name="location_PostCode" placeholder="12300" maxlength="5">
					</div>

					<div class="mb-3">
						<label class="form-label">City:</label>
						<input type="text" class="form-control" name="location_City" placeholder="street address">
					</div>

					<div class="mb-3">
						<label class="form-label">State:</label>
						<input type="text" class="form-control" name="location_State" placeholder="Melaka">
					</div>

					<div>
						<button type="submit" class="btn btn-success" name="submit">Save</button>

						<a href="index_branch.php" class="btn btn-danger">Cancel</a>
					</div>

				</div>
			</form>
		</div>
</div>
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>