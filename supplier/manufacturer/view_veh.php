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

	$query_selectVehicle = "SELECT * FROM vehicle";
	$result_selectVehicle = mysqli_query($conn,$query_selectVehicle);

?>

<!DOCTYPE html>
<html>
<head>
	<title> View Vehicle </title>
	<link rel="stylesheet" href="../includes/main_style.css" >

</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		<h1>View Vehicle</h1>
		<form action="" method="POST" class="form">
		<table class="table_displayData">
			<tr>
				<th> No.</th>
				<th>Vehicle ID</th>
				<th>Brand</th>
				<th>Colour</th>
			
			</tr>
			<?php $i=1; while($row_selectVehicle = mysqli_fetch_array($result_selectVehicle)) { ?>
			<tr>
				
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_ID']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Brand']; ?> </td>
				<td> <?php echo $row_selectVehicle['veh_Colour']; ?> </td>
				
			</tr>
			<?php $i++; } ?>
		</table>
		
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>