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
		$branchid = $_GET['branch_ID'];

      //FROM TABLE LOCATION
      $street = $_POST['location_Street'];
      $postcode = $_POST['location_PostCode'];
      $city = $_POST['location_City'];
      $state = $_POST['location_State'];

      //FROM TABLE BRANCH
      $branch = $_POST['branch_Name'];
      $branchphoneno = $_POST['branch_PhoneNo'];


/*$sql = "UPDATE branch, location
					SET b.branch_Name = '$branch', b.branch_PhoneNo = '$branchphoneno', l.location_Street = '$street', l.location_PostCode = '$postcode', l.location_City = '$city', l.location_State = '$state'
					FROM branch b 
					INNER JOIN location l ON b.location_ID = l.location_ID
					WHERE b.location_ID = '$branchid'";
*/

      
/* f(x)
      if($query)
      {

       //UPDATE INTO TABLE CUSTOMER
        $sql2 = "UPDATE branch SET branch_Name = '$branch', branch_PhoneNo = '$branchphoneno' WHERE branch_ID = '$branchid'";

        $result = mysqli_query($conn,$sql2);

        if($result)
        {
          $msg = "The branch information is successfully updated!";
          echo "<script type='text/javascript'>alert('$msg');</script>";

          //DIRECTLY TO ANOTHER PAGE
         	header("location: index_branch.php");
        }
        else
        {
          $msg = "Something went wrong. Please try again";
          echo "<script type='text/javascript'>alert('$msg');</script>";
        }
      }
*/

/*--SUB-QUERY--*/
    //UPDATE INTO TABLE LOCATION
	    $sql = "UPDATE location SET location_Street = '$street', location_PostCode = '$postcode', location_City = '$city', location_State = '$state' WHERE location_ID IN (SELECT location_ID 
														FROM branch WHERE branch_ID = '$branchid')";

	    $query = mysqli_query($conn,$sql);

      if($query)
      {
	      //UPDATE INTO TABLE BRANCH
	       	$sql2 = "UPDATE branch SET branch_Name = '$branch', branch_PhoneNo = '$branchphoneno' WHERE branch_ID = '$branchid'";
					
					$result = mysqli_query($conn,$sql2);

					if ($result)
					{
						$msg = "You have successfully update the data!";
	          echo "<script>alert('$msg');</script>";
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
	      $msg = "Failed to update the data. Please try again";
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
			<h3>Edit Branch</h3>
			<p class="text-muted">Click update after changing any information</p>
		</div>

		<?php
			$branchid = $_GET['branch_ID'];
			include('../includes/config.php');

/*--INNER JOIN TABLE--*/
	  	$sql = "SELECT b.branch_ID, b.branch_Name, b.branch_PhoneNo, l.location_Street, l.location_PostCode, l.location_City, l.location_State 
	  						FROM branch b INNER JOIN location l
	  						ON b.location_ID = l.location_ID
	  						WHERE b.branch_ID = '$branchid' LIMIT 1";
	  	$result  = mysqli_query($conn, $sql);
	  	$row = mysqli_fetch_assoc($result);
	  	
		?>

		<div class="container d-flex justify-content-center">
			<form action="" method="POST" style="width: 50vw; min-width: 300px;">
				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Branch Name:</label>
						<input type="text" class="form-control" name="branch_Name" value="<?php echo $row['branch_Name']?>">
					</div>

					<div class="col mb-3">
						<label class="form-label">Phone Number:</label>
						<input type="text" class="form-control" name="branch_PhoneNo" maxlength="10" value="<?php echo $row['branch_PhoneNo']?>">
					</div>
				</div>

					<div class="mb-3">
						<label class="form-label">Street:</label>
						<input type="text" class="form-control" name="location_Street" value="<?php echo $row['location_Street']?>">
					</div>

					<div class="mb-3">
						<label class="form-label">Postcode:</label>
						<input type="text" class="form-control" name="location_PostCode" maxlength="5" value="<?php echo $row['location_PostCode']?>">
					</div>

					<div class="mb-3">
						<label class="form-label">City:</label>
						<input type="text" class="form-control" name="location_City" value="<?php echo $row['location_City']?>">
					</div>

					<div class="mb-3">
						<label class="form-label">State:</label>
						<input type="text" class="form-control" name="location_State" value="<?php echo $row['location_State']?>">
					</div>

					<div>
						<button type="submit" class="btn btn-success" name="submit">Update</button>

						<a href="index_branch.php" class="btn btn-danger">Cancel</a>
					</div>
		</form>
	</div>
</div>
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>