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
	<a href="add_staff.php" class="btn btn-dark mb-3">Add Staff</a>

	<table class="table table-hove text-center">
	  <thead class="table-dark">
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Age</th>
	      <th scope="col">Gender</th>
	      <th scope="col">Position</th>
	      <th scope="col">Salary</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	include('../includes/config.php');
/*---INNER JOIN TABLE---*/
	  		$sql = "SELECT s.staff_ID, u.f_Name, u.l_Name, u.age, u.gender, s.staff_Position, s.staff_Salary
					FROM user u
					INNER JOIN staff s ON u.user_ID = s.user_ID";

	  		$result = mysqli_query($conn, $sql);
	  		while ($row = mysqli_fetch_assoc($result))
	  		{
	  			?>
	  			<tr>
			      <td><?php echo $row['staff_ID']?></td>
			      <td><?php echo $row['f_Name'] . " " . $row['l_Name']?></td>
			      <td><?php echo $row['age']?></td>
			      <td><?php echo $row['gender']?></td>
			      <td><?php echo $row['staff_Position']?></td>
			      <td><?php echo $row['staff_Salary']?></td>
			      <td>	
		      		<a href="edit_staff.php?staff_ID=<?php echo $row['staff_ID']?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
		      		
		      		<a href="delete_staff.php?staff_ID=<?php echo $row['staff_ID']?>" class="link-dark" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa-solid fa-trash fs-5"></i></a>
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