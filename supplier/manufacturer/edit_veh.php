<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$id = $_GET['id'];
			$query_selectVehicle = "SELECT * FROM Vehicle WHERE veh_ID='$ID'";
			$result_selectVehicle = mysqli_query($con,$query_selectVehicleColour);
			$row_selectVehicle = mysqli_fetch_array($result_selectVehicleColour);
			$VehicleBrand = $VehicleColour = "";
			$VehicleBrandErr = $requireErr = $confirmMessage = "";
			$VehicleBrandHolder = $VehicleColourHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtVehicleBrand'])) {
					$VehicleBrandHolder = $_POST['txtVehicleBrand'];
					$VehicleBrand = $_POST['txtVehicleBrand'];
				}
				if(!empty($_POST['txtVehicleColour'])) {
					$VehicleColour = $_POST['txtVehicleColour'];
					$VehicleColourHolder = $_POST['txtVehicleColour'];
				}
				if($VehicleBrand != null) {
					$query_UpdateVehicle = "UPDATE Vehicle SET veh_Brand='$VehicleBrand',veh_Colour='$VehicleColour' WHERE veh_id='$id'";
					if(mysqli_query($con,$query_UpdateVehicle)) {
						echo "<script> alert(\"Vehicle Updated Successfully\"); </script>";
						header('Refresh:0;url=view_Vehicle.php');
					}
					else {
						$requireErr = "Updating New Vehicle Failed";
					}
				}
				else {
					$requireErr = "* Valid Vehicle Brand is required";
				}
			}
		}
		else {
			header('Lovehion:../index.php');
		}
	}
	else {
		header('Lovehion:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Update Vehicle </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		<h1>Update Vehicle</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="VehicleBrand">Vehicle Brand</label> </div>
			<div class="input-box"> <input type="text" id="VehicleBrand" Brand="txtVehicleBrand" placeholder="Vehicle Brand" value="<?php echo $row_selectVehicleColour['veh_Brand']; ?>" required /> </div> <span class="error_message"><?php echo $VehicleBrandErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="VehicleColour">Colour</label> </div>
			<div class="input-box"><textarea id="VehicleColour" Brand="txtVehicleColour" placeholder="Colour"><?php echo $row_selectVehicleColour['veh_Colour']; ?></textarea> </div>
		</li>
		<li>
			<input type="submit" value="Update Vehicle" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>