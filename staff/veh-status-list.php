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
  <button class="btn btn-primary my-5" style="position:relative; left:0%; right:90%;bottom:20%;top:80%;"><a href="vehicle-status.php" class="text-light">Add Vehicle Status</a>
  </button>

<!-- List of all Vehicle -->
<h4>Vehicle Status List</h4><br><br>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
               <th>Vehicle ID</th>
               <th>Maintenance</th> 
               <th>Status</th>
               <!-- <th>Action</th> -->
            </tr>
        <thead>
      <tbody>

      <?php 
      
      $sql="SELECT * from vehicle_status";

      $result=mysqli_query($conn,$sql);
      if($result){
       while($row = mysqli_fetch_assoc($result)){
           $veh_ID=$row['veh_ID'];
           $maintenance_ID=$row['maintenance_ID'];
           $status=$row['status'];
           
          
           echo' <tr>
           <th scope ="row">'.$veh_ID.'</th>
           <td>'.$maintenance_ID.'</td>
           <td>'.$status.'</td>
           
           
      
      </tr>';
        }  
      }

    ?>
          </td>
        </tr>
      </tbody>
    </table>
</body>
</html>