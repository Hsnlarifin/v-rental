<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminid'])==0)
{	
    header('location:logout.php');
}
else
{ 
    if(isset($_POST['submit']))
    {
      //FROM TABLE USER
	  $fname = $_POST['f_Name'];
	  $lname  = $_POST['l_Name'];
	  $gender = $_POST['gender'];
	  $age = $_POST['age'];
	  $email = $_POST['email'];
	  $phoneNo = $_POST['phoneNo'];

  	//FROM TABLE STAFF
	  $branch_ID = $_POST['branch_ID'];
	  $staff_Username = $_POST['staff_Username'];
	  $staff_Pass = $_POST['staff_Pass'];

	$sql = "INSERT INTO user (f_Name, l_Name, gender, age, email, phoneNo) VALUES ('$fname', '$lname', '$gender', '$age', '$email', '$phoneNo')";
	$query = mysqli_query($conn,$sql);
	if($query)
	{
		//TO GET THE ID FROM PREVIOUS INSERT TABLE
		$user_id = mysqli_insert_id($conn);
		//INSERT INTO TABLE STAFF
		$sql2 = "INSERT INTO staff (user_ID, branch_ID, staff_Username, staff_Pass, staff_Position, staff_Salary) VALUES ('$user_id','$branch_ID', '$staff_Username', '$staff_Pass', '', '')";
		$result = mysqli_query($conn,$sql2);
		if($result)
		{
		  echo "<script type='text/javascript'>alert('You have successfully inserted the data');</script>";
		  echo "<script type='text/javascript'> document.location ='new-staff.php'; </script>";
		}
	  	else
		{
		  echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
		}
	}
	else
	{
	  echo "<script type='text/javascript'>alert('Failed to insert new data. Please try again');</script>";
	}
  }
}
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<?php include('includes/title.php');?>
	<meta name="theme-color" content="#3e454c">
</head>

<body>
<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="font-size: 22px;">Add New Staff</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">

									<div class="panel-heading">Staff Information</div>


									<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
										
										<div class="form-group">
											<label class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="f_Name" class="form-control" required>
											</div>

											<label class="col-sm-2 control-label">Last Name<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="l_Name" class="form-control" required>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="email" name="email" class="form-control" required>
											</div>

											<label class="col-sm-2 control-label">Phone No<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="phoneNo" class="form-control" max="11" required>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="staff_Username" class="form-control" required>
											</div>

											<label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="password" name="staff_Pass" class="form-control" required>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="number" name="age" class="form-control" min="17" max="99" required>
											</div>
									
											<label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
											<div class="col-sm-4"><br>
												<input type="radio" class="form-check-input" name="gender" id="male" value="Male">
												<label for="male" class="form-input-label">Male</label>
												&nbsp;
												<input type="radio" class="form-check-input" name="gender" id="female" value="Female">
												<label for="female" class="form-input-label">Female</label>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Assign Branch<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select name="branch_ID" class="form-control">
													<option value="">Select branch</option>
													<option value="1">V-Rental Melaka</option>
													<option value="2">V-Rental Johor</option>
													<option value="3">V-Rental Negeri Sembilan</option>
												</select>
											</div>
										</div>

										
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-success" name="submit" type="submit">Submit</button>
												<button class="btn btn-danger" type="reset">Cancel</button>
											</div>
										</div>

									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>