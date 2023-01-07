<?php
	include("../config.php");
	
	session_start();
	//$currentDate = date('Y-m-d');

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

	$brand_Name = $_POST['brand_Name'];
	
	$veh_Model = $_POST['veh_Model'];
	$fuel_type = $_POST['fuel_type'];
	$veh_Colour = $_POST['veh_Colour'];
	$seating_Capacity = $_POST['seating_Capacity'];
	$veh_Transmission = $_POST['veh_Transmission'];
	$veh_plateNo = $_POST['veh_plateNo'];


	$quey = "SELECT brand_ID,brand_Name FROM Brand WHERE brand_Name ='$brand_Name'";
	$resultBrand= mysqli_query($conn,$quey);
	$resultCheckBrand = mysqli_num_rows($resultBrand);
	

	if($resultCheckBrand > 0) {

	while($row = mysqli_fetch_assoc($resultBrand)){
		$brand_ID = $row['brand_ID'];
	}


	$qry = "INSERT INTO Vehicle (veh_Model,fuel_type,veh_Colour,seating_Capacity,veh_Transmission,veh_plateNo,brand_ID) VALUES ('$veh_Model','$fuel_type','$veh_Colour','$seating_Capacity','$veh_Transmission','$veh_plateNo','$brand_ID') ";
	
	if(mysqli_query($conn,$qry)) {
		echo "<script> alert(\"Vehicle Added Successfully\"); </script>";
						
	}
}
else{

	$insert_brand ="INSERT INTO brand (brand_Name, add_Date) VALUES ('$brand_Name', sysdate())";
	$result = mysqli_query($conn, $insert_brand);

	//$brand_ID_quey = "SELECT brand_ID FROM Brand WHERE brand_Name ='$brand_Name'";
	$brand_ID_quey ="SELECT * from brand WHERE brand_Name = '$brand_Name'";
	$resultBrand= mysqli_query($conn,$brand_ID_quey);
	$resultCheckBrand = mysqli_num_rows($resultBrand);
		
	while($row = mysqli_fetch_assoc($resultBrand)){
		$brand_ID = $row['brand_ID'];
	}

	$qry = "INSERT INTO Vehicle (veh_Model,fuel_type,veh_Colour,seating_Capacity,veh_Transmission,veh_plateNo,brand_ID) VALUES ('$veh_Model','$fuel_type','$veh_Colour','$seating_Capacity','$veh_Transmission','$veh_plateNo','$brand_ID') ";
	
	if(mysqli_query($conn,$qry)) {
		echo "<script> alert(\"Vehicle Added Successfully\"); </script>";
						
	}


}



	$condition_type = $_POST['condition_type'];
//	$add_date = $_POST['add_date'];
	$policy_no = $_POST['policy_no'];
	$ins_plan = $_POST['ins_plan'];

	$query = "SELECT veh_ID FROM vehicle ";
	$result= mysqli_query($conn,$query);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) {
						
						while ($row = mysqli_fetch_assoc($result)) 
						{
							$veh_ID = $row['veh_ID'];
						}

			
	$qury = "INSERT INTO Vehicle_Record ( veh_ID,sup_id,policy_no,ins_plan,condition_type,add_Date) VALUES ('$veh_ID','$sup_id','$policy_no','$ins_plan','$condition_type',sysdate())";
	$result1= mysqli_query($conn,$qury);



	  echo "<script>alert('Add Successfully! ');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=view_veh.php'/>";

	} 
	else 
	{
	  echo "<script>alert('Invalid insert, Please try again.')
	  ;</script>";
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
				<input type="text"  name="brand_Name" placeholder="Vehicle Brand"  required> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="Model">Vehicle Model</label> </div>
			<div class="input-box"> 
				<input type="text"  name="veh_Model" placeholder="Vehicle Model"  required> 
		</li>

		 <li>
			<div class="label-block" style="white-space: nowrap;">
				<label for="fuel_type" style="display: inline-block; font-size: 15px;">Fuel Type</label>
           <input type="radio" name="fuel_type" value="Ron 95" style="display: inline-block;"> Ron 95</input>
           <input type="radio" name="fuel_type" value="Ron 97"style="display: inline-block;"> Ron 97</input>

           <li>

		<li>
			<div class="label-block"> 
				<label for="Colour">Vehicle Colour</label> </div>
			<div class="input-box">
			 <input type="text" id="veh_Colour" name="veh_Colour" placeholder="Colour"  required> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="seating_Capacity">Seating Capacity</label> </div>
			<div class="input-box">
			 <input type="text" id="seating_Capacity" name="seating_Capacity" placeholder="Seating Capacity"  required> 
		</li>
	
		<li>
			<div class="label-block"> 
				<label for="veh_Transmission">Vehicle Transmission</label> </div>
			<div class="input-box">
			 <input type="text" id="veh_Transmission" name="veh_Transmission" placeholder="Vehicle Transmission"  required> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="Plate No">Plate No</label> </div>
			<div class="input-box">
			 <input type="text" id="veh_plateNo" name="veh_plateNo" placeholder="Plate No"  required> 
		</li>

	    <li>
			<div class="label-block" style="white-space: nowrap;">
				<label for="Type of Condition" style="display: inline-block; font-size: 15px;">Condition</label>
           <input type="radio" name="condition_type" value="Lead" style="display: inline-block;"> Lead</input>
           <input type="radio" name="condition_type" value="Full Loan"style="display: inline-block;"> Full Loan</input>

           <li>
			<div class="label-block"> 
				<label for="policy_no">Policy No</label> </div>
			<div class="input-box">
			 <input type="text" id="policy_no" name="policy_no" placeholder="Policy No"  required> 
		</li>

           <li>
           	<div class="label-block" style="white-space: nowrap;"> 
           		<label for="ins_plan"  style="display: inline-block; font-size: 15px;"> Insurans plan</label>
           		<select class="form-control" name="ins_plan" required>
                    	 <option selected="true" disabled="disabled" value=""> - Type of Insurans - </option >
                     	 <option value="Third Party">Third Party</option>
                     	 <option value="Third Party Fire & Theft">Third Party Fire & Theft</option>	
                     	 <option value="Comprehensive">Comprehensive</option>	
            </select> 
				
           </li>
			 
			</div>
		</li>


	
	

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