<?php
	include("../config.php");
	session_start();

	if(isset($_SESSION['sup_id'])) 
	{
			
			$sup_id = $_SESSION['sup_id'];
	}
		
	else 
	{
		header('Location:../sindex.php');
	}

	//$veh_ID = $_GET['veh_ID'];

	$query_selectVehicle = "SELECT v.veh_ID,v.veh_Model,v.fuel_type,v.veh_Colour,v.seating_Capacity,v.veh_Transmission,v.veh_plateNo FROM vehicle v, vehicle_record r, supplier s, brand b WHERE s.sup_id = r.sup_id AND r.veh_ID = v.veh_ID AND b.brand_ID = v.brand_ID AND s.sup_id ='$sup_id' ";
	$result_selectVehicle = mysqli_query($conn,$query_selectVehicle);
	//$row = mysqli_num_rows($result_selectVehicle);
		
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
					$chkId = $_POST['chkId'];
					foreach($chkId as $veh_ID) {
			$query_deleteVehicle = "DELETE FROM vehicle_record WHERE veh_ID='$veh_ID'";
			$result = mysqli_query($conn,$query_deleteVehicle);
					

			$query = "DELETE FROM Vehicle WHERE veh_ID = '$veh_ID'";
			$result = mysqli_query($conn,$query);
				}
					if(!$result) 
					{
						echo "<script> alert(\"Vehicle assigned to any product can not be deleted\"); </script>";
						header('Refresh:0');
					}
					else
					 {
						echo "<script> alert(\"Vehicle Deleted Successfully\"); </script>";
						header('Refresh:0');
					}
				}
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Delete Vehicle </title>
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
		<h1>Delete Vehicle</h1>
		<form action="" method="POST" class="form">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> No.</th>
				<th>Vehicle ID</th>
				
				<th>Model</th>
				<th>Fuel Type</th>
				<th>Colour</th>
				<th>Seating Capacity</th>
				<th>Transmission</th>
				<th>Plate No</th>
				
			</tr>
			<?php $i=1; while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)) { ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectVehicle['veh_ID']; ?>" /> </td>

				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_ID']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Model']; ?> </td>
				<td> <?php echo $row_selectVehicle['fuel_type']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Colour']; ?> </td>
				<td> <?php echo $row_selectVehicle['seating_Capacity']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Transmission']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_plateNo']; ?> </td>
				
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="submit" value="Delete" class="submit_button"/>
		
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>