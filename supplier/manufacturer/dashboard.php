<?php
session_start();
	include("../config.php");
	
	if(isset($_SESSION["sup_id"])) {

			$sup_id = $_SESSION["sup_id"];
		$sup_name = $_SESSION["sup_name"];
		}
		else
		{
			header('Location:../sindex.php');
		}
$query_selectSupplier = "SELECT * FROM supplier WHERE sup_id='$sup_id'";
$result_selectSupplier = mysqli_query($conn,$query_selectSupplier);
$row_selectSupplier = mysqli_fetch_array($result_selectSupplier);

$query_selectVehicle = "SELECT * FROM vehicle ";
$result_selectVehicle = mysqli_query($conn,$query_selectVehicle);


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
		<p>Welcome <?php echo $_SESSION['sup_name']; ?></p>
		<article>
			<h2>My Profile</h2>
			<table class="table_displayData">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Company Name</th>
				<th>Company Address</th>
				<th>Username</th>
				<th>Password</th>
				<th> Edit </th>
			</tr>
			<tr>
				<td> <?php echo $row_selectSupplier['sup_name']; ?> </td>
				<td> <?php echo $row_selectSupplier['sup_email']; ?> </td>
				<td> <?php echo $row_selectSupplier['sup_phone']; ?> </td>
				<td> <?php echo $row_selectSupplier['company_name']; ?> </td>
				<td> <?php echo $row_selectSupplier['address']; ?> </td>
				<td> <?php echo $row_selectSupplier['username']; ?> </td>
				<td> <?php echo $row_selectSupplier['password']; ?> </td>
				<td> <a href="editProfile.php"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
		</table>
		</article>
		<article>
			<h2>Vehicle Recent Leased</h2>
			<table class="table_displayData" style="margin-top:20px;">
			<tr>
				<th> Vehicle ID </th>
				<th>Brand</th>
				<th>Model</th>
				<th>Fuel Type</th>
				<th>Colour</th>
				<th>Seating Capacity</th>
				<th>Transmission</th>
				<th>Plate No</th>
			</tr>
			<?php $i=1; while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)) { ?>
			<tr>
			
				<td> <?php echo $row_selectVehicle['veh_ID']; ?> </td>
				<td> <?php echo $row_selectVehicle['brand_ID']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Model']; ?> </td>
				<td> <?php echo $row_selectVehicle['fuel_type']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Colour']; ?> </td>
				<td> <?php echo $row_selectVehicle['seating_Capacity']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Transmission']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_plateNo']; ?> </td>
				
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