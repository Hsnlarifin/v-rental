<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$id = $_SESSION['Supplier_id'];
			$query_selectSupplier = "SELECT * FROM Supplier WHERE sup_id='$id'";
			$result_selectSupplier = mysqli_query($con,$query_selectSupplier);
			$row_selectSupplier = mysqli_fetch_array($result_selectSupplier);
			$query_selectVehicle = "SELECT * FROM Vehicle ORDER BY veh_id DESC LIMIT 5";
			$result_selectVehicle = mysqli_query($con,$query_selectVehicle);
		}
		else {
			header('Location:index.php');
		}
	}
	else {
		header('Location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Supplier: Home </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		Welcome <?php echo $_SESSION['sessUsername']; ?>
		<article>
			<h2>My Profile</h2>
			<table class="table_displayData">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Username</th>
				<th>Company Name</th>
				<th> Edit </th>
			</tr>
			<tr>
				<td> <?php echo $row_selectSupplier['sup_name']; ?> </td>
				<td> <?php echo $row_selectSupplier['sup_email']; ?> </td>
				<td> <?php echo $row_selectSupplier['sup_phone']; ?> </td>
				<td> <?php echo $row_selectSupplier['username']; ?> </td>
				<td> <?php echo $row_selectSupplier['']; ?> </td>
				<td> <a href="edit_profile.php"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
		</table>
		</article>
		<article>
			<h2>Vehicle Recent Leased</h2>
			<table class="table_displayData" style="margin-top:20px;">
			<tr>
				<th> Vehicle ID </th>
				<th> Date </th>
				<th> Model </th>
				<th> Brand </th>
				<th> PlateNo </th>
				<th> Colour </th>
			</tr>
			<?php $i=1; while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)) { ?>
			<tr>
			
				<td> <?php echo $row_selectVehicle['veh_id']; ?> </td>
				
				<td> <?php echo date("d-m-Y",strtotime($row_selectVehicle['date'])); ?> </td>
				<td>
					<?php
						if($row_selectVehicle['approved'] == 0) {
							echo "Not Approved";
						}
						else {
							echo "Approved";
						}
					?>
				</td>
				<td>
					<?php
						if($row_selectVehicle['status'] == 0) {
							echo "Pending";
						}
						else {
							echo "Completed";
						}
					?>
				</td>
				<td> <a href="view_Vehicle_details=<?php echo $row_selectVehicle['veh_id']; ?>">Details</a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>