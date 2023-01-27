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
		$brand_id = $_GET['brand_ID'];
		$brand_Name = $_POST['brand_Name'];
		$sql="UPDATE brand SET brand_Name = '$brand_Name', update_Date = CURRENT_TIME() WHERE brand_ID = '$brand_id'";
		$query = mysqli_query($conn,$sql);
		if($query)
		{
			echo "<script type='text/javascript'>alert('You have successfully update the data!');</script>";
			echo "<script type='text/javascript'> document.location ='manage-brands.php'; </script>";
		}	 
		else
		{
			echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
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

						<h2 class="page-title" style="font-size: 22px;">Update Brand</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Update Brand Details</div>
									<div class="panel-body">

										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">

<?php	
$brand_id = $_GET['brand_ID'];
$sql2 = "SELECT * FROM brand WHERE brand_ID = '$brand_id'";
$result  = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result);
?>

											<div class="form-group">
													<label class="col-sm-4 control-label">Brand ID</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="brand_ID" value="<?php echo $row['brand_ID']?>" disabled>
													</div>
												</div>

									<div class="hr-dashed"></div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Brand Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="brand_Name" value="<?php echo $row['brand_Name']?>">
												</div>
											</div>
											
								
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button class="btn btn-success" name="submit" type="submit">Update Brand</button>
													<a href="manage-brands.php" class="btn btn-default">Back</a>
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
<?php } ?>