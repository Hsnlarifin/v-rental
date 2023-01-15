<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include('header.php'); ?>

</head>
<body>

	<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
		V-Rental Management System
	</nav>

<div class="container">

	<a href="add_branch_loc.php" class="btn btn-dark mb-3">Add Branch</a>

	<table class="table table-hove text-center">
	  <thead class="table-dark">
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Branch Name</th>
	      <th scope="col">Phone No</th>
	      <th scope="col">Address</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	include('../includes/config.php');
/*---INNER JOIN TABLE---*/
	  		$sql = "SELECT b.branch_ID, b.branch_Name, b.branch_PhoneNo, l.location_Street, l.location_PostCode, l.location_City, l.location_State 
	  				FROM branch b INNER JOIN location l
	  				ON b.location_ID = l.location_ID;";

	  		$result = mysqli_query($conn, $sql);
	  		while ($row = mysqli_fetch_assoc($result))
	  		{
	  			?>
	  			<tr>
			      <td><?php echo $row['branch_ID']?></td>
			      <td><?php echo $row['branch_Name']?></td>
			      <td><?php echo $row['branch_PhoneNo']?></td>
			      <td><?php echo $row['location_Street'] . ", " . $row['location_PostCode'] . ", " . $row['location_City'] . " " . $row['location_State']?></th>
			      <td>	
		      		<a href="edit_branch.php?branch_ID=<?php echo $row['branch_ID']?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
		      		
		      		<a href="delete_branch.php?branch_ID=<?php echo $row['branch_ID']?>" class="link-dark" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa-solid fa-trash fs-5"></i></a>
	      		  </td>
	    		</tr>
	  			<?php
	  		}
	  	?>
	  </tbody>
	</table>
</div>

<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>