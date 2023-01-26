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

						<h2 class="page-title" style="font-size: 22px;">Manage Staff</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Staff</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th>ID</th>
											<th>Full Name</th>
											<th>Age</th>
											<th>Gender</th>
                                            <th>Email</th>
                                            <th>Position</th>
                                            <th>Salary</th>
											<th>Branch</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php
$sql = "SELECT * FROM user u JOIN staff s ON u.user_ID = s.user_ID JOIN branch b ON s.branch_ID = b.branch_ID";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
?>		
										<tr>
											<td><?php echo $row['staff_ID']?></td>
											<td><?php echo $row['f_Name'] . " " . $row['l_Name']?></td>
											<td><?php echo $row['age']?></td>
											<td><?php echo $row['gender']?></td>
											<td><?php echo $row['email']?></td>
											<td><?php echo $row['staff_Position']?></td>
											<td><?php echo $row['staff_Salary']?></td>
											<td><?php echo $row['branch_Name']?></td>
<td><a href="assign-position.php?staff_ID=<?php echo $row['staff_ID']?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="delete-staff.php?staff_ID=<?php echo $row['staff_ID']?>" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-close"></i></a></td>
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
