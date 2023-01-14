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
  <button class="btn btn-primary my-5" style="position:relative; left:0%; right:90%;bottom:20%;top:80%;"><a href="add-vehicle.php" class="text-light">Add Vehicle</a>
  </button>

<!-- List of all Vehicle -->
<h4>Vehicle List</h4><br>
<form action="search-vehicle.php" class="d-flex" role="search" method="post">
      <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-1" type="submit">Search</button>
    </form><br><br>

    <table class="table table-bordered shadow">
        <thead>
            <tr>
               <th>Vehicle ID</th>
               <th>Brand Name</th> 
               <th>Vehicle Model</th>
               <th>Price Per Day</th>
               <th>Fuel Type</th>
               <th>Vehicle colour</th>
               <th>Seating Capacity</th>
               <th>Vehicle Transmission</th>
               <th>Plate No</th>
               <th>Vehicle Image</th>  
               <th>Supplier Name</th> 
               <th>Branch Name</th> 
               <th>Action</th>
            </tr>
        <thead>
      <tbody>

      <?php 
      
      $sql="SELECT vehicle.veh_ID, brand.brand_Name, vehicle.veh_Model, vehicle.price_per_Day, vehicle.fuel_Type, vehicle.veh_Colour, vehicle.seating_Capacity, vehicle.veh_Transmission, vehicle.plateNo, vehicle.veh_Image_1, supplier.supp_Name, branch.branch_Name FROM vehicle INNER JOIN brand ON vehicle.brand_ID = brand.brand_ID INNER JOIN supplier ON vehicle.supp_ID = supplier.supp_ID INNER JOIN branch ON vehicle.branch_ID = branch.branch_ID ORDER BY vehicle.veh_ID";

      $result=mysqli_query($conn,$sql);
      if($result){
       while($row = mysqli_fetch_assoc($result)){
           $veh_ID=$row['veh_ID'];
           $brand_Name=$row['brand_Name'];
           $veh_Model=$row['veh_Model'];
           $price_per_Day=$row['price_per_Day'];
           $fuel_Type=$row['fuel_Type'];
           $veh_Colour=$row['veh_Colour'];
           $seating_Capacity=$row['seating_Capacity'];
           $veh_Transmission=$row['veh_Transmission'];
           $plateNo=$row['plateNo'];
           $veh_Image_1=$row['veh_Image_1'];
           $supp_Name=$row['supp_Name'];
           $branch_Name=$row['branch_Name'];
         
           
          
           echo' <tr>
           <th scope ="row">'.$veh_ID.'</th>
           <td>'.$brand_Name.'</td>
           <td>'.$veh_Model.'</td>
           <td>'.$price_per_Day.'</td>
           <td>'.$fuel_Type.'</td>
           <td>'.$veh_Colour.'</td>
           <td>'.$seating_Capacity.'</td>
           <td>'.$veh_Transmission.'</td>
           <td>'.$plateNo.'</td>
           <td><img src="'.$row["veh_Image_1"].'" width="125px" height="125px""/></td>
           <td>'.$supp_Name.'</td>
           <td>'.$branch_Name.'</td>
           
           

          
          
      <td>
          <button class="btn btn-primary"><a href="update-vehicle.php?updateid='.$veh_ID.'" class="text-light">Edit</a></button>
          <button class="btn btn-danger"><a href="delete-vehicle.php?deleteid='.$veh_ID.'" class="text-light">Delete</a></button>
      </td>
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