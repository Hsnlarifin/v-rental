<?php
include 'db_conn.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	<!--bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!--bootstrap 5 Js CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>


    <div class="container">
    <button class="btn btn-primary my-5"><a href="add-brand.php" class="text-light">Add Brand</a>
    </button>
  

    <!-- List of all Brand -->
<h4>Brand List</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
               <th>Brand ID</th>
               <th>Brand Name</th>
               <th>Action</th>
            </tr>
        <thead>
      <tbody>
      <?php 
      $sql="select * from brand";
      $result=mysqli_query($conn,$sql);
      if($result){
       while($row = mysqli_fetch_assoc($result)){
           $brand_ID=$row['brand_ID'];
           $brand_Name=$row['brand_Name'];
           
          
           echo' <tr>
           <th scope ="row">'.$brand_ID.'</th>
           <td>'.$brand_Name.'</td>
          
      <td>
          
          <button class="btn btn-danger"><a href="delete-brand.php?deleteid='.$brand_ID.'" class="text-light">Delete</a></button>
      </td>
          </tr>';
        }  
      }

      ?> 
	</div>
</body>
</html>

