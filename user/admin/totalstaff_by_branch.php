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
	<table class="table table-hove text-center">
	  <thead class="table-dark">
	    <tr>
	      <th scope="col">Branch ID</th>
	      <th scope="col">Branch Name</th>
	      <th scope="col">Total Staff</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	include('../includes/config.php');

/*---AGGREGATION | INNER JOIN | GROUPING | HAVING---*/

	  		$sql = "SELECT b.branch_ID, b.branch_Name, COUNT(s.staff_ID) AS total
					FROM staff s INNER JOIN branch b
					ON s.branch_ID = b.branch_ID
					GROUP BY b.branch_ID, b.branch_Name
					ORDER BY COUNT(s.staff_ID) DESC;";

	  		$result = mysqli_query($conn, $sql);
	  		while ($row = mysqli_fetch_assoc($result))
	  		{
	  			?>
	  			<tr>
			      <td><?php echo $row['branch_ID']?></td>
			      <td><?php echo $row['branch_Name']?></td>
			      <td><?php echo $row['total']?></td>
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