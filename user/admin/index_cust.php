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

	<a href="add_cust.php" class="btn btn-dark mb-3">Add Customer</a>

	<table class="table table-hove text-center">
	  <thead class="table-dark">
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Age</th>
	      <th scope="col">Gender</th>
	      <th scope="col">License</th>
	      <th scope="col">Expired</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	include('../includes/config.php');
/*---INNER JOIN TABLE---*/
	  		$sql = "SELECT c.cust_ID, u.f_Name, u.l_Name, u.age, u.gender, l.license_Type, l.expiration
					FROM user u
					INNER JOIN customer c ON u.user_ID = c.user_ID
					INNER JOIN license l ON c.cust_ID = l.cust_ID";

	  		$result = mysqli_query($conn, $sql);
	  		while ($row = mysqli_fetch_assoc($result))
	  		{
	  			?>
	  			<tr>
			      <td><?php echo $row['cust_ID']?></td>
			      <td><?php echo $row['f_Name'] . " " . $row['l_Name']?></td>
			      <td><?php echo $row['age']?></td>
			      <td><?php echo $row['gender']?></td>
			      <td><?php echo $row['license_Type']?></td>
			      <td><?php echo $row['expiration']?></td>
			      <td>	
		      		<a href="edit_cust.php?cust_ID=<?php echo $row['cust_ID']?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
		      		
		      		<a href="delete_cust.php?cust_ID=<?php echo $row['cust_ID']?>" class="link-dark" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa-solid fa-trash fs-5"></i></a>
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