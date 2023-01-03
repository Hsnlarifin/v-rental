<?php
	include("../config.php");
	
	session_start();
	if(isset($_SESSION['sup_id'])) {
	
			$sup_id = $_SESSION["sup_id"];
}
		else {
			header('Location:../dashboard.php');
		}

			$query = "SELECT * FROM vehicle WHERE sup_id='$sup_id'";
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_array($result);
			
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				
			$veh_Brand = $_POST['veh_Brand'];
			$veh_Colour = $_POST['veh_Colour'];
			

			$qry = "UPDATE vehicle SET veh_Brand='$veh_Brand',veh_Colour='$veh_Colour' WHERE sup_id='$sup_id'";
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
				<label for="VehicleBrand">Vehicle Brand</label> 
			</div>
			<div class="input-box">
			 <input type="text" Brand="veh_Brand" placeholder="Vehicle Brand" required /> 
			</div> 
		</li>
		<li>
			<div class="label-block"> 
				<label for="VehicleColour">Colour</label> 
			</div>
			<div class="input-box">
			<input type="text" Colour="veh_Colour" placeholder="Vehicle Colour"  required /> 
			</div> 
		</li>
		<li>
			<input type="submit" value="Update Vehicle" class="submit_button" /> 
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>