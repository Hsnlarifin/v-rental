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
		$brand = $_POST['brand_Name'];
		$sql = "SELECT brand_Name FROM brand WHERE brand_Name = '$brand'";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			echo "<script type='text/javascript'>alert('Brand name is already exist!');</script>";
		}
		else
		{
			$sql2 = "INSERT INTO brand (brand_Name) VALUES ('$brand')";
			$query = mysqli_query($conn,$sql2);
			if($query)
			{
				echo "<script type='text/javascript'>alert('You have successfully create new brand');</script>";
				echo "<script type='text/javascript'> document.location ='create-brand.php'; </script>";
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
					
						<h2 class="page-title" style="font-size: 22px;">Create Brand</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Create Brand</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">

											<div class="form-group">
												<label class="col-sm-4 control-label">Brand Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="brand_Name" id="brand" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											

											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button class="btn btn-success" name="submit" type="submit">Create</button>
													<a href="manage-brands.php" class="btn btn-primary">Back</a>
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