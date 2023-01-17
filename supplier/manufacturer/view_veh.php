<?php
	include("../config.php");
	session_start();

	if(isset($_SESSION['sup_id'])) 
	{
			
			$sup_id = $_SESSION["sup_id"];
	}
	else 
	{
			header('Location:../sindex.php');
	}

	$query_selectVehicle = "SELECT v.veh_ID,b.brand_Name,v.veh_Model,v.fuel_type,v.veh_Colour,v.seating_Capacity,v.veh_Transmission,v.veh_plateNo,v.veh_Image_1 FROM vehicle v, vehicle_record r, supplier s, brand b WHERE s.sup_id = r.sup_id AND r.veh_ID = v.veh_ID AND b.brand_ID = v.brand_ID AND s.sup_id ='$sup_id' ";
	$result_selectVehicle = mysqli_query($conn,$query_selectVehicle);

	//$query_selectBrand = "SELECT brand_Name,add_Date FROM brand";
	//$result_selectBrand = mysqli_query($conn,$query_selectBrand);


	// $veh_ID = $_GET['veh_ID'];

	// $query = "INSERT INTO vehicle_supplier ";
	// $result = mysqli_query($conn,$query);
	// $row = mysqli_fetch_array($result);

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
		<form action="" method="POST" class="form" enctype="multipart/form-data">
		<table class="table_displayData" >
			<tr>
				<!-- <th> <input type="checkbox" onClick="toggle(this)" /> </th> -->
				<th> No.</th>
				<th>Vehicle ID</th>
				<th>Brand Name</th>
				<th>Model</th>
				<th>Fuel Type</th>
				<th>Colour</th>
				<th>Seating Capacity</th>
				<th>Transmission</th>
				<th>Plate No</th>
				<th>Image</th>
				<th>Edit</th>
			
			</tr>
			<?php $i=1; 
			while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)  ) { ?>
			<tr>
				<!-- <td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectVehicle['veh_ID']; ?>" /> </td> -->
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_ID']; ?> </td>
				<td> <?php echo $row_selectVehicle['brand_Name']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Model']; ?> </td>
				<td> <?php echo $row_selectVehicle['fuel_type']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Colour']; ?> </td>
				<td> <?php echo $row_selectVehicle['seating_Capacity']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Transmission']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_plateNo']; ?> </td>
				
				<td><img src="images/<?php echo $row_selectVehicle['veh_Image_1'] ;?>" ></td>

				<td> <a href="edit_veh.php?veh_ID=<?php echo $row_selectVehicle['veh_ID']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>

			
				
			<?php $i++; 
		
	
		} ?>
		</table>
		
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>