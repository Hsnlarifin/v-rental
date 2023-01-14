<?php
include 'db_conn.php';
include 'header.php';

if(isset($_POST['submit'])){
       $veh_ID=$_POST['veh_ID'];
       $maintenance_ID=$_POST['maintenance_ID'];
       $status=$_POST['status'];
       
       $sql="insert into vehicle_status (veh_ID,maintenance_ID, status) values ('$veh_ID','$maintenance_ID', '$status')";
       $result=mysqli_query($conn,$sql);
       if($result){
        echo "<script>alert('Data Inserted Successfully!');</script>";
	      echo"<meta http-equiv='refresh' content='0; url=veh-status-list.php'/>";
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
	<title>Vehicle Status</title>

    <!-- bootstrap 5 CDN-->
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	   <div class="d-flex justify-content-center
     -align-items-center">
	
     <form action="vehicle-status.php"
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		Vehicle Status
     	</h1>

     	<div class="mb-3">
        <label class="form-label">
                Vehicle ID
               </label>
        <input type="text" 
               class="form-control" 
               name="veh_ID" required>
      </div>
     	
     	<div class="mb-3">
        <label class="form-label">
                Maintenance ID
               </label>
        <input type="text" 
               class="form-control" 
               name="maintenance_ID" required>
      </div>

      <label>Vehicle Status:</label><br></br>
      <input type="radio" name="status"<?php if (isset($status) && $status == "Available") echo "checked";?>
      value="Available" required> Available

      <input type="radio" name="status"<?php if (isset($status) && $status == "Unavailable") echo "checked";?>
      value="Unavailable" required>  Unavailable
      <br></br>

    <div>  
	    <button type="submit" name="submit" value="Submit" 
	            class="btn btn-primary">
	            Submit </button>
     </form>
   </div>
	</div>
</body>
</html>