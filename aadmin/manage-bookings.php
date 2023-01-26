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
	if(isset($_REQUEST['eid']))
	{
		$eid=intval($_GET['eid']);
		$status="CANCELLED";
		$sql = "UPDATE reservation SET Status = '$status' WHERE resv_ID = '$eid'";
		$query = mysqli_query($conn,$sql);
        if($query)
		{
			echo "<script type='text/javascript'>alert('Booking successfully cancelled');</script>";
		}
		else
        {
            echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
        }
	}

	if(isset($_REQUEST['aeid']))
	{
		$aeid=intval($_GET['aeid']);
		$status='CONFIRMED';
		$sql = "UPDATE reservation SET Status = '$status' WHERE resv_ID = '$aeid'";
		$query = mysqli_query($conn,$sql);
        if($query)
		{
			echo "<script type='text/javascript'>alert('Booking are confirmed');</script>";
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
<style>
.badge-warning
{
	background-color: #f4a261;
	color: white;
	padding: 5px;
	border-radius: 8px;
}

.badge-danger
{
	background-color: #d62828;
	color: white;
	padding: 5px;
	border-radius: 8px;
}

.badge-success
{
	background-color: #a7c957;
	color: white;
	padding: 5px;
	border-radius: 8px;
}

.rounded-posix_kill
{
	border-radius: 20px;
}
</style>
</head>

<body>
<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title" style="font-size: 22px;">Manage Bookings</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Information</div>
							<div class="panel-body">

								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>License</th>
											<th>Vehicle</th>
											<th>From Date</th>
											<th>To Date</th>
											<th>Message</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>									
									<tbody>

<?php 
$sql = "SELECT license.*, customer.*, reservation.*, user.*, vehicle.*, brand.*
		FROM license
		JOIN customer ON license.cust_ID = customer.cust_ID
		JOIN reservation ON customer.cust_ID = reservation.cust_ID
		JOIN user ON customer.user_ID = user.user_ID
		JOIN vehicle ON reservation.veh_ID = vehicle.veh_ID
		JOIN brand ON vehicle.brand_ID = brand.brand_ID;";
$result  = mysqli_query($conn, $sql);
$cnt = 1;
while ($row = mysqli_fetch_assoc($result))
{
?>	
										<tr>
											<td><?php echo $cnt?></td>
											<td><?php echo $row['f_Name']?></td>
											<td><?php echo $row['license_Type']?></td>
											<td><a href="edit-vehicle.php?veh_ID=<?php echo $row['veh_ID']?>"><?php echo $row['brand_Name']?> , <?php echo $row['veh_Model']?></td>
											<td><?php echo $row['from_Date']?></td>
											<td><?php echo $row['to_Date']?></td>
											<td><?php echo $row['message']?></td>
											<td>	<?php

												if ($row['Status'] == 'PENDING')
												{
													?>
														<div><span class="badge-warning rounded-pill">PENDING</span></div>
													<?php
												}
												else if ($row['Status'] == 'CONFIRMED')
												{
													?>
														<div><span class="badge-success rounded-pill">CONFIRMED</span></div>
													<?php
												}
												else
												{
													?>
														<div><span class="badge-danger rounded-pill">CANCELED</span></div>
													<?php
												}

													?>
											</td>
<td>
	<a href="manage-bookings.php?aeid=<?php echo $row['resv_ID']?>" onclick="return confirm('Are you sure you want to confirm/approve this booking?')">Confirm</a> ||
	<a href="manage-bookings.php?eid=<?php echo $row['resv_ID']?>" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a>
</td>
										</tr>
<?php
$cnt=$cnt+1;
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
