<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminid'])==0)
{	
    header('location:index.php');
}
else
{ 
    if(isset($_POST['submit']))
    {
      $staff_id = $_GET['staff_ID'];
	  $position = $_POST['staff_Position'];
	  $salary = $_POST['staff_Salary'];

		$sql = "UPDATE staff SET staff_Position = '$position', staff_Salary = '$salary' WHERE staff_ID = '$staff_id'";
		$query = mysqli_query($conn,$sql);
		if($query)
		{
			
			echo "<script type='text/javascript'>alert('You have successfully update the data!');</script>";
			echo "<script type='text/javascript'> document.location ='manage-staff.php'; </script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
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
						<h2 class="page-title" style="font-size: 22px;">Assign Job Position</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Job Position</div>
<?php
$staff_id = $_GET['staff_ID'];
$sql2 = "SELECT * FROM user u JOIN staff s ON u.user_ID = s.user_ID JOIN branch b ON s.branch_ID = b.branch_ID WHERE s.staff_ID = '$staff_id'";
$result  = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result);
?>

									<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Staff ID</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="staff_ID" value="<?php echo $row['staff_ID']?>" disabled>
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>


									<div class="form-group">
                                        <label class="col-sm-2 control-label">First Name</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="f_Name" value="<?php echo $row['f_Name']?>" disabled>
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>


									<div class="form-group">
                                        <label class="col-sm-2 control-label">Last Name</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="l_Name" value="<?php echo $row['l_Name']?>" disabled>
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>


									<div class="form-group">
                                        <label class="col-sm-2 control-label">Assigned Branch</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="branch_Name" value="<?php echo $row['branch_Name']?>" disabled>
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>

<!--Insert data-->
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Position</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="staff_Position" value="<?php echo $row['staff_Position']?>">
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>


									<div class="form-group">
                                        <label class="col-sm-2 control-label">Salary</label>
                                    		<div class="col-sm-8">
                                        		<input type="text" class="form-control" name="staff_Salary" value="<?php echo $row['staff_Salary']?>">
                                        		<span class="help-block m-b-none"></span>
                                        	</div>
                                    </div>


									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-success" name="submit" type="submit">Update</button>
											<a href="manage-staff.php" class="btn btn-default">Back</a>
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