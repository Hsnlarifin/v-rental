<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{	
	header('location:index.php');
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

						<h2 class="page-title" style="font-size: 22px;">Total Staff By Branch</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Staff</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th>Branch ID</th>
											<th>Branch Name</th>
											<th>Total No. of Staff</th>
										</tr>
									</thead>
									<tbody>

<?php
/*---STORED PROCEDURE---*/
/*$query = "CALL GetTotalStaffByBranch(@branchid, @branchname, @total)";
$conn->query($query);
$result = $conn->query( "SELECT @branchid, @branchname, @total");
while($row = $result->fetch_assoc())
{*/

//JOIN, GROUP BY, AGGREGATION, ORDER BY DESC
$sql = "SELECT b.branch_ID, b.branch_Name, COUNT(s.staff_ID) AS total
        FROM staff s INNER JOIN branch b
        ON s.branch_ID = b.branch_ID
        GROUP BY b.branch_ID, b.branch_Name
        ORDER BY COUNT(s.staff_ID) DESC;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{

?>		
										<tr>
											<td><?php echo $row['branch_ID']?></td>
											<td><?php echo $row['branch_Name']?></td>
											<td><?php echo $row['total']?></td>
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
