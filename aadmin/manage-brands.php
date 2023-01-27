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
	if(isset($_GET['brand_ID']))
	{
		$brand_id = $_GET['brand_ID'];
		$sql2 = "DELETE FROM brand WHERE brand_ID = '$brand_id'";
		$query = mysqli_query($conn,$sql2);
		if($query)
		{	 	
			echo "<script>alert('Data is successfully deleted!');</script>";
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

						<h2 class="page-title" style="font-size: 22px;">Manage Brands</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Brands</div>
							<div class="panel-body">

								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Brand ID</th>
											<th>Brand Name</th>
											<th>Creation Date</th>
											<th>Updation date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
<?php
$sql = "SELECT * FROM brand";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
?>
										<tr>
											<td><?php echo $row['brand_ID']?></td>
											<td><?php echo $row['brand_Name']?></td>
											<td><?php echo $row['add_Date']?></td>
											<td><?php echo $row['update_Date']?></td>
<td><a href="edit-brand.php?brand_ID=<?php echo $row['brand_ID']?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-brands.php?brand_ID=<?php echo$row['brand_ID']?>" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-close"></i></a></td>
										</tr>
<?php
}
?>
									</tbody>
								</table>
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