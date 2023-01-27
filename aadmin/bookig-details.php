<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{	
	header('location:logout.php');
}
else{

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
						<h2 class="page-title" style="font-size: 22px;">Booking Details</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Information</div>
							<div class="panel-body">


							<div id="print">
								<table border="1"  class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%"  >
									<tbody>

<?php 
$resv_id=$_GET['resv_ID'];
$sql2 = "SELECT license.*, customer.*, reservation.*, user.*, vehicle.*, brand.*, DATEDIFF(reservation.to_Date,reservation.from_Date) as totalnodays
FROM license
JOIN customer ON license.cust_ID = customer.cust_ID
JOIN reservation ON customer.cust_ID = reservation.cust_ID
JOIN user ON customer.user_ID = user.user_ID
JOIN vehicle ON reservation.veh_ID = vehicle.veh_ID
JOIN brand ON vehicle.brand_ID = brand.brand_ID
WHERE reservation.resv_ID = '$resv_id'";

$result2  = mysqli_query($conn, $sql2);
$cnt = 1;
while ($row = mysqli_fetch_assoc($result2))
{
?>	
	<h3 style="text-align:center; color:red">#<?php echo $row['Booking_Key']?> Booking Details </h3>

										<tr>
											<th colspan="4" style="text-align:center;color:blue">User Details</th>
										</tr>
										<tr>
											<th>Booking No.</th>
											<td>#<?php echo $row['Booking_Key']?></td>
											<th>Name</th>
											<td><?php echo $row['f_Name'] . " " . $row['l_Name']?></td>
										</tr>
										<tr>											
											<th>Email ID</th>
											<td><?php echo $row['email']?></td>
											<th>Contact No</th>
											<td><?php echo $row['phoneNo']?></td>
										</tr>
											<tr>											
											<th>Address</th>
											<td><?php echo $row['street'] . ", " . $row['postcode']?></td>
											<th>City</th>
											<td><?php echo $row['city']?></td>
										</tr>
										<tr>											
											<th>State</th>
											<td colspan="3"><?php echo $row['state']?></td>
										</tr>


										<tr>
											<th colspan="4" style="text-align:center;color:blue">Booking Details</th>
										</tr>
											<tr>											
											<th>Vehicle Name</th>
											<td><a href="edit-vehicle.php?veh_ID=<?php echo $row['veh_ID']?>"><?php echo $row['brand_Name']?> , <?php echo $row['veh_Model']?></td>
											<th>Plate No</th>
											<td><?php echo $row['plateNo']?></td>
										</tr>
										<tr>
											<th>Start Date Rental</th>
											<td><?php echo $row['from_Date']?></td>
											<th>End Date Rental</th>
											<td><?php echo $row['to_Date']?></td>
										</tr>
										<tr>
											<th>Total Days</th>
											<td><?php echo $tdays=$row['totalnodays']?></td>
											<th>Rent Per Days</th>
											<td><?php echo $ppdays=$row['price_per_Day']?></td>
										</tr>


										<tr>
											<th colspan="3" style="text-align:center">Grand Total</th>
											<td><?php echo $tdays*$ppdays?></td>
										</tr>
										<tr>
											<th>Booking Status</th>
											<td>
												<?php 
												if($row['Status'] == 'PENDING')
												{
													echo 'PENDING';
												} else if ($row['Status'] == 'CONFIRMED') {
													echo 'CONFIRMED';
												}
												else{
													echo 'CANCELED';
												}
												?>
											</td>
										</tr>
<?php $cnt=$cnt+1;}?>
										
									</tbody>
								</table>
									<form method="post">
										<input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"></input>
										<div class="form-group">
												<div class="col-sm-4 col-sm-offset-5">
													<a href="confirmed-bookings.php" class="btn btn-primary">Back</a>
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
	
	<script language="javascript" type="text/javascript">
		function f3(){
			window.print(); 
		}
	</script>
</body>
</html>
<?php } ?>
