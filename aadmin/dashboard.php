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
					<h2 class="page-title text-center" style="font-size: 22px;">Dashboard</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
<?php 
$sql ="SELECT cust_ID from customer";
$result = mysqli_query($conn, $sql);
$regusers = mysqli_num_rows($result);
?>
													<div class="stat-panel-number h1 "><?php echo $regusers;?></div>
													<div class="stat-panel-title text-uppercase">No. of Registered Users</div>
												</div>
											</div>
											<a href="reg-users.php" class="block-anchor panel-footer text-center">More &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
<?php 
$sql2 ="SELECT resv_ID from reservation";
$result2 = mysqli_query($conn, $sql2);
$bookings = mysqli_num_rows($result2);
?>
													<div class="stat-panel-number h1 "><?php echo $bookings;?></div>
													<div class="stat-panel-title text-uppercase">Reservations made</div>
												</div>
											</div>
											<a href="manage-bookings.php" class="block-anchor panel-footer text-center">More &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
<?php 
$sql1 ="SELECT veh_ID from vehicle";
$result1 = mysqli_query($conn, $sql1);
$totalvehicle = mysqli_num_rows($result1);
?>

													<div class="stat-panel-number h1 "><?php echo $totalvehicle;?></div>
													<div class="stat-panel-title text-uppercase">No. of Vehicles</div>
												</div>
											</div>
											<a href="manage-vehicles.php" class="block-anchor panel-footer text-center">more &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
<?php 
$sql3 ="SELECT brand_ID from brand";
$result3 = mysqli_query($conn, $sql3);
$brands = mysqli_num_rows($result3);
?>												
													<div class="stat-panel-number h1 "><?php echo $brands;?></div>
													<div class="stat-panel-title text-uppercase">Vehicle Brands</div>
												</div>
											</div>
											<a href="manage-brands.php" class="block-anchor panel-footer text-center">More &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
<?php												
$query = "CALL GetTotalStaff(@total)";
$conn->query($query);
$result = $conn->query( "SELECT @total;");
$row = $result->fetch_assoc();
?>
													<div class="stat-panel-number h1 "><?php echo $row['@total']?></div>
													<div class="stat-panel-title text-uppercase">No. of Staff</div>
												</div>
											</div>
											<a href="manage-staff.php" class="block-anchor panel-footer text-center">More &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
										<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
<?php 
$sql5 ="SELECT resv_ID from reservation where status = 'CONFIRMED'";
$result5 = mysqli_query($conn, $sql5);
$reserved = mysqli_num_rows($result5);
?>
													<div class="stat-panel-number h1 "><?php echo $reserved;?></div>
													<div class="stat-panel-title text-uppercase">Reservation Confirmed</div>
												</div>
											</div>
											<a href="confirmed-bookings.php" class="block-anchor panel-footer text-center">More &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
<?php 
$sql4 ="SELECT veh_ID from vehicle_status where status = 'Unavailable'";
$result4 = mysqli_query($conn, $sql4);
$vstatus = mysqli_num_rows($result4);
?>
													<div class="stat-panel-number h1 "><?php echo $vstatus;?></div>
													<div class="stat-panel-title text-uppercase">Vehicles in maintenance</div>
												</div>
											</div>
											<a href="v-availability.php" class="block-anchor panel-footer text-center">More <i class="fa fa-arrow-right"></i></a>
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
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>