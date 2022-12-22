<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		if($_SESSION['Supplier_login'] == true) {
			$query_selectCategory = "SELECT cat_id,cat_name FROM categories";
			$query_selectUnit = "SELECT id,unit_name FROM unit";
			$result_selectCategory = mysqli_query($con,$query_selectCategory);
			$result_selectUnit = mysqli_query($con,$query_selectUnit);
			$name = $price = $unit = $category = $rdbStock = $description = "";
			$nameErr = $priceErr = $requireErr = $confirmMessage = "";
			$nameHolder = $priceHolder = $descriptionHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtVehicleName'])) {
					$nameHolder = $_POST['txtVehicleName'];
					$name = $_POST['txtVehicleName'];
				}
				if(!empty($_POST['txtVehiclePrice'])) {
					$priceHolder = $_POST['txtVehiclePrice'];
					$resultValidate_price = validate_price($_POST['txtVehiclePrice']);
					if($resultValidate_price == 1) {
						$price = $_POST['txtVehiclePrice'];
					}
					else {
						$priceErr = $resultValidate_price;
					}
				}
				if(isset($_POST['cmbVehicleUnit'])) {
					$unit = $_POST['cmbVehicleUnit'];
				}
				if(isset($_POST['cmbVehicleCategory'])) {
					$category = $_POST['cmbVehicleCategory'];
				}
				if(empty($_POST['rdbStock'])) {
					$rdbStock = "";
				}
				else {
					if($_POST['rdbStock'] == 1) {
						$rdbStock = 1;
					}
					else if($_POST['rdbStock'] == 2) {
						$rdbStock = 2;
					}
				}
				if(!empty($_POST['txtVehicleDescription'])) {
					$description = $_POST['txtVehicleDescription'];
					$descriptionHolder = $_POST['txtVehicleDescription'];
				}
				if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 1) {
					$rdbStock = 0;
					$query_addVehicle = "INSERT INTO Vehicles(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category','$rdbStock')";
					if(mysqli_query($con,$query_addVehicle)) {
						echo "<script> alert(\"Vehicle Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Vehicle Failed";
					}
			}
				else if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 2) {
						$query_addVehicle = "INSERT INTO Vehicles(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category',NULL)";
					if(mysqli_query($con,$query_addVehicle)) {
						echo "<script> alert(\"Vehicle Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Vehicle Failed";
					}
				}
				else {
					$requireErr = "* All Fields are Compulsory with valid values except Description";
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
			<div class="label-block"> <label for="Vehicle:name">Vehicle Name</label> </div>
			<div class="input-box"> <input type="text" id="Vehicle:name" name="txtVehicleName" placeholder="Vehicle Name" value="<?php echo $nameHolder; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="Vehicle:price">Price</label> </div>
			<div class="input-box"> <input type="text" id="Vehicle:price" name="txtVehiclePrice" placeholder="Price" value="<?php echo $priceHolder; ?>" required /> </div> <span class="error_message"><?php echo $priceErr; ?></span>
		</li>
		<li>
		<div class="label-block"> <label for="Vehicle:unit">Unit Type</label> </div>
		<div class="input-box">
		<select name="cmbVehicleUnit" id="Vehicle:unit">
			<option value="" disabled selected>--- Select Unit ---</option>
			<?php while($row_selectUnit = mysqli_fetch_array($result_selectUnit)) { ?>
			<option value="<?php echo $row_selectUnit["id"]; ?>"> <?php echo $row_selectUnit["unit_name"]; ?> </option>
			<?php } ?>
		</select>
		</div>
		</li>
		<li>
		<div class="label-block"> <label for="Vehicle:category">Category</label> </div>
		<div class="input-box">
		<select name="cmbVehicleCategory" id="Vehicle:category">
			<option value="" disabled selected>--- Select Category ---</option>
			<?php while($row_selectCategory = mysqli_fetch_array($result_selectCategory)) { ?>
			<option value="<?php echo $row_selectCategory["cat_id"]; ?>"> <?php echo $row_selectCategory["cat_name"]; ?> </option>
			<?php } ?>
		</select>
		</div>
		</li>
		<li>
			<div class="label-block"> <label for="Vehicle:stock">Stock Management</label> </div>
			<input type="radio" name="rdbStock" value="1">Enable
			<input type="radio" name="rdbStock" value="2">Disable
		</li>
		<li>
			<div class="label-block"> <label for="Vehicle:description">Description</label> </div>
			<div class="input-box"> <textarea type="text" id="Vehicle:description" name="txtVehicleDescription" placeholder="Description"><?php echo $descriptionHolder; ?></textarea> </div>
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