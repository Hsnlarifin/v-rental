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

  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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

						<h2 class="page-title" style="font-size: 22px;">Registered Users</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Reg Users</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Age</th>
										<th>Email</th>
										<th>Phone No</th>
										<th>License</th>
										<th>Expired</th>
										<th>Reg Date</th>
										</tr>
									</thead>
									<tbody>

<?php
$sql = "SELECT * from  user u join customer c on u.user_ID = c.user_ID join license l on c.cust_ID = l.cust_ID";
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
											<td><?php echo $row['license_Type']?></td>
			      							<td><?php echo $row['expiration']?></td>
											<td><?php echo $row['Regist_Date']?></td>
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
