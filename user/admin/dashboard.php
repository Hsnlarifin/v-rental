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

<?php 
  	include('../includes/config.php');

  	include('totalstaff.php');
?>
<div class="container d-flex justify-content-center">
	<div>
		<a href="totalstaff_by_branch.php" class="btn btn-success">More details</a>
	</div>
</div>

					
<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>