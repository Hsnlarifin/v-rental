<?php
include 'db_conn.php';
include 'header.php';

if(isset($_POST['submit'])){
	$brand_Name=$_POST['brand_Name'];

	$sql="insert into brand (brand_Name) values ('$brand_Name')";
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "<script>alert('Brand Added Successfully!');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=brand-listing.php'/>";
	}else{
		die (mysqli_error($conn));
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Brand</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
    <div class="d-flex justify-content-center
    -align-items-center">

	
     <form action="add-brand.php"
           method="post" 
           class="shadow p-5 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-5 fs-3">
     		Add New Brand
     	</h1>
     	<div class="mb-3">
		    <label class="form-label">
		           	Brand Name
		           </label>
		    <input type="text" 
		           class="form-control" 
		           name="brand_Name" required>
		</div>

	    <button type="submit" name="submit" value="Submit" 
	            class="btn btn-primary">
	            Add Brand </button>
     </form>
	</div>
</body>
</html>


