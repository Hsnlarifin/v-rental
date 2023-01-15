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
		$staff_id = $_GET['staff_ID'];

      //FROM TABLE USER
	      $fname = $_POST['f_Name'];
	      $lname  = $_POST['l_Name'];
	      $age = $_POST['age'];
	      $email = $_POST['email'];
	      $phoneNo = $_POST['phoneNo'];

      //FROM TABLE STAFF
	      $branchid = $_POST['branch_ID'];
	      $username = $_POST['staff_Username'];
	      $password = $_POST['staff_Pass'];
	      $position = $_POST['staff_Position'];
	      $salary = $_POST['staff_Salary'];


/*---SUB-QUERY---*/
      //INSERT INTO TABLE USER
      $sql = "UPDATE user SET f_Name = '$fname', l_Name = '$lname', age = '$age', email = '$email', phoneNo = '$phoneNo'
                  WHERE user_ID IN (SELECT user_ID FROM staff WHERE staff_ID = '$staff_id')";

      $query = mysqli_query($conn,$sql);

      if($query)
      {

		   //INSERT INTO TABLE STAFF
		    $sql2 = "UPDATE staff SET branch_ID = '$branchid', staff_Username = '$username', staff_Pass = '$password', staff_Position = '$position', staff_Salary = '$salary' WHERE staff_ID = '$staff_id'";

        $result = mysqli_query($conn,$sql2);

        if($result)
        {    
          $msg = "You have successfully update the data!";
	        echo "<script type='text/javascript'>alert('$msg');</script>";
	        echo "<script type='text/javascript'> document.location ='index_staff.php'; </script>";
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
			<h3>Edit Staff</h3>
			<p class="text-muted">Click update after changing any information</p>
		</div>

		<?php
			$staff_id = $_GET['staff_ID'];
			include('../includes/config.php');

/*---INNER JOIN TABLE---*/
	  	$sql = "SELECT u.f_Name, u.l_Name, u.age, u.email, u.phoneNo, s.branch_ID, s.staff_Username, s.staff_Pass, s.staff_Position, s.staff_Salary
							FROM user u
							INNER JOIN staff s ON u.user_ID = s.user_ID
							WHERE s.staff_ID = '$staff_id'";

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

					<div class="col">
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
						<input type="text" class="form-control" name="staff_Username" value="<?php echo $row['staff_Username']?>">
					</div>

					<div class="col mb-3">
						<label class="form-label">Password:</label>
						<input type="password" class="form-control" name="staff_Pass" value="<?php echo $row['staff_Pass']?>">
					</div>
				</div>


					<div class="form-group mb-4">
						<label for="branch">Branch:</label>&nbsp;&nbsp;
						<select id="cars" name="branch_ID">
							<option value="">None</option>
						  <option value="1">V-Rental Melaka</option>
						  <option value="2">V-Rental Johor</option>
						  <option value="3">V-Rental Negeri Sembilan</option>
						</select>
					</div>


					<div class="row mb-4">
						<div class="col">
							<label class="form-label">Position:</label>
							<input type="text" class="form-control" name="staff_Position" value="<?php echo $row['staff_Position']?>">
						</div>

						<div class="col">
							<label class="form-label">Salary:</label>
							<input type="text" class="form-control" name="staff_Salary" value="<?php echo $row['staff_Salary']?>">
						</div>
					</div>
					
					<div class="mb-5">
						<button type="submit" class="btn btn-success" name="submit">Update</button>

						<a href="index_staff.php" class="btn btn-danger">Cancel</a>
					</div>

				</div>
			</form>
		</div>
</div>
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>