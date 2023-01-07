<?php
	include("../config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['sup_id']))
	 {
		 
		 	$sup_id = $_SESSION["sup_id"];
	}
	else 
	{
		header('Location:../dashboard.php');
	}

if(isset($_POST['submit']))
{
	$veh_Brand = $_POST['veh_Brand'];
	$veh_Colour = $_POST['veh_Colour'];
	echo "$veh_Brand";
	echo "$veh_Colour";

	$qry = "INSERT INTO vehicle (veh_Brand,veh_Colour,sup_id) VALUES ('$veh_Brand','$veh_Colour','$sup_id') ";

	if (mysqli_query($conn, $qry)) 
	{
	  echo "<script>alert('Add Successfully!');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=add_veh.php'/>";

	} 
	else 
	{
	  echo "<script>alert('Invalid insert, Please try again.');</script>";
	  //echo"<meta http-equiv='refresh' content='0; url=add_veh.php'/>";
	}

}
	
?>