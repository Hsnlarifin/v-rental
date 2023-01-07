<?php
	include("../config.php");
	
	session_start();
	if(isset($_SESSION['sup_id'])) {
	
			$sup_id = $_SESSION["sup_id"];
}
		else {
			header('Location:../dashboard.php');
		}

	
			$veh_ID = $_GET['veh_ID'];

			$query = "SELECT * FROM vehicle WHERE veh_ID='$veh_ID'";
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_array($result);
			
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				
			$veh_Model = $_POST['veh_Model'];
			$fuel_type = $_POST['fuel_type'];
			$veh_Colour = $_POST['veh_Colour'];
			$seating_Capacity = $_POST['seating_Capacity'];
			$veh_Transmission = $_POST['veh_Transmisson'];
			$veh_plateNo = $_POST['veh_plateNo'];
			

			$qry = "UPDATE vehicle SET veh_Model='$veh_Model',fuel_type ='$fuel_type',veh_Colour='$veh_Colour',seating_Capacity = '$seating_Capacity',veh_Transmission = '$veh_Transmission',veh_plateNo = '$veh_plateNo' WHERE veh_ID='$veh_ID'";
	        $ret = mysqli_query($conn,$qry);
	
	if($ret)
	{
		echo "<script>alert('Update successfully');</script>";
		echo"<meta http-equiv='refresh' content='0; url=dashboard.php'/>";
	}
	else
	{
		echo "Failed: " .mysqli_error($conn);
	}
			
		
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title> Edit Vehicle </title>
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
			<div class="label-block"> 
				<label for="VehicleBrand">Vehicle Model</label> 
			</div>
			
			 <div class="input-box"> <input type="text" id="veh_Model" name="veh_Model" placeholder="Vehicle Model" value="<?php echo $row['veh_Model']; ?>" required /> </div> 
			</div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="fuel_type">Fuel Type</label> 
			</div>
		
			 <div class="input-box"> <input type="text" id="fuel_type" name="fuel_type" placeholder="Fuel Type" value="<?php echo $row['fuel_type']; ?>" required /> </div> 
			</div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="VehicleColour">Vehicle Colour</label> 
			</div>
				<div class="input-box">
			<div class="input-box"> <input type="text" id="veh_Colour" name="veh_Colour" placeholder="Vehicle Colour" value="<?php echo $row['veh_Colour']; ?>" required /> </div> 
			</div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="seating_Capacity">Seating Capacity</label> 
			</div>
			<div class="input-box">
			<div class="input-box"> <input type="text" id="seating_Capacity" name="seating_Capacity" placeholder="Seating Capacity" value="<?php echo $row['seating_Capacity']; ?>" required /> </div> 
			</div> 


		<li>
			
		<div class="label-block"> 
				<label for="veh_Transmission">Vehicle Transmission</label> </div>
			<div class="input-box">
			<div class="input-box"> <input type="text" id="veh_Transmission" name="veh_Transmission" placeholder="Vehicle Transmission"  value="<?php echo $row['veh_Transmission']; ?>" required /> </div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="Plate No">Plate No</label> </div>
			<div class="input-box">
			<div class="input-box"><input type="text" id="veh_plateNo" name="veh_plateNo" placeholder="Plate No" value="<?php echo $row['veh_plateNo']; ?>" required /> </div> 
		</li>


		</li>





		<li>
			<button type="submit"  name= "submit" class="submit_button"> Update Vehicle </button>
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>