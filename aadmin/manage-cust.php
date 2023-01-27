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

						<h2 class="page-title" style="font-size: 22px;">Manage Customer</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Customer</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
										<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Age</th>
										<th>Email</th>
										<th>Phone No</th>
                                        <th>Address</th>
										<th>License</th>
										<th>Expired</th>
										<th>Date of Registration</th>
                                        <th>Date of Update</th>
                                        <th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php
$sql = "SELECT * FROM  user u JOIN customer c ON u.user_ID = c.user_ID JOIN license l ON c.cust_ID = l.cust_ID";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
?>		
										<tr>
											<td><?php echo $row['cust_ID']?></td>
											<td><?php echo $row['f_Name'] . " " . $row['l_Name']?></td>
			      							<td><?php echo $row['age']?></td>
											<td><?php echo $row['email']?></td>
											<td><?php echo $row['phoneNo']?></td>
                                            <td><?php echo $row['street'] . ", " . $row['postcode'] . ", " . $row['city'] . " " . $row['state']?></th>
											<td><?php echo $row['license_Type']?></td>
			      							<td><?php echo $row['expiration']?></td>
											<td><?php echo $row['Regist_Date']?></td>
                                            <td><?php echo $row['Update_Date']?></td>
<td><a href="edit-cust.php?cust_ID=<?php echo $row['cust_ID']?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="delete-cust.php?cust_ID=<?php echo $row['cust_ID']?>" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-close"></i></a></td>
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
