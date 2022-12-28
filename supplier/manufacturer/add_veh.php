<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$query_selectVehicle = "SELECT veh_ID,veh_Brand,veh_Colour FROM Vehicle";
			$result_selectVehicle = mysqli_query($con,$query_selectVehicle);
			$brand = $colour =  "";
			$brandErr = $requireErr = $confirmMessage = "";
			$brandHolder = $ColourHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtVehicleName'])) {
					$nameHolder = $_POST['txtVehicleName'];
					$name = $_POST['txtVehicleName'];
				}
				if(!empty($_POST['txtVehicleBrand'])) {
					$brandHolder = $_POST['txtVehiclebrand'];
					$resultValidate_brand = validate_brand($_POST['txtVehiclebrand']);
					if($resultValidate_brand == 1) {
						$brand = $_POST['txtVehiclebrand'];
					}
					else {
						$brandErr = $resultValidate_brand;
					}
				}
				
			
				if( $brand != null && $colour != null ) {
				
					$query_addVehicle = "INSERT INTO Vehicles(veh_ID,veh_Brand,veh_Colour) VALUES('$name','$brand','$colour')";
					if(mysqli_query($con,$query_addVehicle)) {
						echo "<script> alert(\"Vehicle Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Vehicle Failed";
					}
			}
				
				else {
					$requireErr = "* All Fields are Compulsory with valid values";
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
	<title> Add Vehicle </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		<h1>Add Vehicle</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="Vehicle:Brand">Vehicle Brand</label> </div>
			<div class="input-box"> <input type="text" id="Vehicle:name" name="txtVehicleBrand" placeholder="Vehicle Brand" value="<?php echo $brandHolder; ?>" required /> </div> <span class="error_message"><?php echo $brandErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="Vehicle:Colour">brand</label> </div>
			<div class="input-box"> <input type="text" id="Vehicle:Colour" name="txtVehicleColour" placeholder="brand" value="<?php echo $colourHolder; ?>" required /> </div> <span class="error_message"><?php echo $colourErr; ?></span>
		</li>
	
		

		<li>
			<input type="submit" value="Add Vehicle" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>