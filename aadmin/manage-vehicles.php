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

						<h2 class="page-title" style="font-size: 22px;">Manage Vehicles</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Vehicle Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Vehicle Title</th>
											<th>Brand</th>
											<th>Colour</th>
											<th>Capacity</th>
											<th>Transmission</th>
											<th>Price Per day</th>
											<th>Fuel Type</th>
											<th>Date Register</th>
											<th>Supplier</th>
										</tr>
									</thead>
									<tbody>

<?php
$sql = "SELECT vehicle.*, brand.*, supplier.* FROM brand JOIN vehicle
		ON brand.brand_ID=vehicle.brand_ID JOIN supplier ON vehicle.sup_id = supplier.sup_id";
$result = mysqli_query($conn, $sql);
$cnt=1;
while ($row = mysqli_fetch_assoc($result))
{
?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php echo $row['veh_Model']?></td>
											<td><?php echo $row['brand_Name']?></td>
											<td><?php echo $row['veh_Colour']?></td>
											<td><?php echo $row['seating_Capacity']?></td>
											<td><?php echo $row['veh_Transmission']?></td>
											<td><?php echo $row['price_per_Day']?></td>
											<td><?php echo $row['fuel_Type']?></td>
											<td><?php echo $row['register_Date']?></td>
											<td><?php echo $row['company_name']?></td>

										</tr>
										<?php $cnt=$cnt+1; } ?>
										
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
