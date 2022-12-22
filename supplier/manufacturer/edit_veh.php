<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$id = $_GET['id'];
			$query_selectVehicleDetails = "SELECT * FROM Vehicle WHERE veh_ID='$ID'";
			$result_selectVehicleDetails = mysqli_query($con,$query_selectVehicleDetails);
			$row_selectVehicleDetails = mysqli_fetch_array($result_selectVehicleDetails);
			$VehicleName = $VehicleDetails = "";
			$VehicleNameErr = $requireErr = $confirmMessage = "";
			$VehicleNameHolder = $VehicleDetailsHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtVehicleName'])) {
					$VehicleNameHolder = $_POST['txtVehicleName'];
					$VehicleName = $_POST['txtVehicleName'];
				}
				if(!empty($_POST['txtVehicleDetails'])) {
					$VehicleDetails = $_POST['txtVehicleDetails'];
					$VehicleDetailsHolder = $_POST['txtVehicleDetails'];
				}
				if($VehicleName != null) {
					$query_UpdateVehicle = "UPDATE Vehicle SET veh_name='$VehicleName',cat_details='$VehicleDetails' WHERE cat_id='$id'";
					if(mysqli_query($con,$query_UpdateVehicle)) {
						echo "<script> alert(\"Vehicle Updated Successfully\"); </script>";
						header('Refresh:0;url=view_Vehicle.php');
					}
					else {
						$requireErr = "Updating New Vehicle Failed";
					}
				}
				else {
					$requireErr = "* Valid Vehicle Name is required";
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
			<div class="label-block"> <label for="VehicleName">Vehicle Name</label> </div>
			<div class="input-box"> <input type="text" id="VehicleName" name="txtVehicleName" placeholder="Vehicle Name" value="<?php echo $row_selectVehicleDetails['cat_name']; ?>" required /> </div> <span class="error_message"><?php echo $VehicleNameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="VehicleDetails">Details</label> </div>
			<div class="input-box"><textarea id="VehicleDetails" name="txtVehicleDetails" placeholder="Details"><?php echo $row_selectVehicleDetails['cat_details']; ?></textarea> </div>
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