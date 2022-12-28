<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$query_selectVehicle = "SELECT * FROM Vehicle";
			$result_selectVehicle = mysqli_query($con,$query_selectVehicle);
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['chkId'])) {
					$chkId = $_POST['chkId'];
					foreach($chkId as $ID) {
						$query_deleteVehicle = "DELETE FROM Vehicle WHERE veh_ID='$ID'";
						$result = mysqli_query($con,$query_deleteVehicle);
					}
					if(!$result) {
						echo "<script> alert(\"Vehicle assigned to any product can not be deleted\"); </script>";
						header('Refresh:0');
					}
					else {
						echo "<script> alert(\"Vehicle Deleted Successfully\"); </script>";
						header('Refresh:0');
					}
				}
			}
		}
		else {
			header('Location:../index.php');
		}
	}
	else {
		header('Location:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> View Vehicle </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
	<script language="JavaScript">
	function toggle(source) {
		checkboxes = document.getElementsByName('chkId[]');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}
	</script>
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		<h1>View Vehicle</h1>
		<form action="" method="POST" class="form">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th>Vehicle ID</th>
				<th>Brand</th>
				<th>Colour</th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)) { ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectVehicle['veh_ID']; ?>" /> </td>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Brand']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Colour']; ?> </td>
				<td> <a href="edit_Vehicle.php?id=<?php echo $row_selectVehicle['veh_ID']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="submit" value="Delete" class="submit_button"/>
		<a href="add_Vehicle.php"><input type="button" value="+ Add Vehicle" class="submit_button"/></a>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>