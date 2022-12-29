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

if(isset($_POST['submit']))
{
	$veh_Brand = $_POST['veh_Brand'];
	$veh_Colour = $_POST['veh_Colour'];
	$condition_type =$_POST['condition_type'];

	$qry = "INSERT INTO vehicle (veh_Brand,veh_Colour,sup_id) VALUES ('$veh_Brand','$veh_Colour','$sup_id') ";
	

	if (mysqli_query($conn, $qry)) 
	{
		$qury = "INSERT INTO vehicle_supplier ( veh_ID,sup_id,condition_type) VALUES ('$lastid','$sup_id','$condition_type')";

 
    $lastid = mysqli_insert_id($conn);



		

	  echo "<script>alert('Add Successfully!');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=view_veh.php'/>";

	} 
	else 
	{
	  echo "<script>alert('Invalid insert, Please try again.');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=add_veh.php'/>";
	}

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
			<div class="label-block"> 
				<label for="Brand">Vehicle Brand</label> </div>
			<div class="input-box"> 
				<input type="text"  name="veh_Brand" placeholder="Vehicle Brand"  required> 
		</li>
		<li>
			<div class="label-block"> 
				<label for="Colour">Vehicle Colour</label> </div>
			<div class="input-box">
			 <input type="text" id="veh_Colour" name="veh_Colour" placeholder="colour"  required> 
		</li>
	
	<li>
			<div class="label-block">
				<label for="Type of Condition">Condition</label> 
				<select class="form-control" name="condition_type" value="<?php echo $condition_type; ?>" required>
                    	 <option selected="true" disabled="disabled" value="">- Type of Condition -</option >
                     	 <option value="Lead">Lead</option>
                     	 <option value="Full Loan">Full Loan</option>		
            </select> 
		</li>
		<li>

		

		<li>
			<button type="submit"  name= "submit" class="submit_button"> Add Vehicle </button>
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>