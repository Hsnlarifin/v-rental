<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Result</title>

</head>
<body>

		<?php include("header.php");

			include ("db_conn.php");

      $search = $_POST['search'];
			
			if(empty($search)){
				echo "<script>alert('Please insert the keyword');</script>";
				echo"<meta http-equiv='refresh' content='0; url=car-list.php'/>";
			}
			else{

      //$sql = "SELECT veh_ID, brand_ID, veh_Model, price_per_Day, fuel_Type, veh_Colour, seating_Capacity, veh_Transmission, plateNo, supp_ID, branch_ID from vehicle WHERE veh_Model LIKE '%$search%' OR brand_ID LIKE '%$search%'";
      $sql="SELECT vehicle.veh_ID, brand.brand_Name, vehicle.veh_Model, vehicle.price_per_Day, vehicle.fuel_Type, vehicle.veh_Colour, vehicle.seating_Capacity, vehicle.veh_Transmission, vehicle.plateNo, supplier.supp_Name, branch.branch_Name FROM vehicle INNER JOIN brand ON vehicle.brand_ID = brand.brand_ID INNER JOIN supplier ON vehicle.supp_ID = supplier.supp_ID INNER JOIN branch ON vehicle.branch_ID = branch.branch_ID WHERE veh_Model LIKE '%$search%' OR brand_Name LIKE '%$search%'";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            
			?>
                
            <div class="container">
            <?php
            if (mysqli_num_rows($result) > 0) {

                ?>

                <h1 class="heading">Search Result</h1>
                <div class="box-container">
            
                <?php

                while ($row = mysqli_fetch_assoc($result)) 
                {

                    ?>
    <table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">veh_ID</th>
      <th scope="col">brand_Name</th>
      <th scope="col">veh_Model</th>
      <th scope="col">price_per_Day</th>
      <th scope="col">fuel_Type</th>
      <th scope="col">veh_Colour</th>
      <th scope="col">seating_Capacity</th>
      <th scope="col">veh_Transmission</th>
      <th scope="col">plateNo</th>
      <th scope="col">supp_Name</th>
      <th scope="col">branch_Name</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
                

    <?php
    if($result){
      while ($row = mysqli_fetch_assoc($result)){
    
            $veh_ID = $row['veh_ID'];
            $brand_Name = $row['brand_Name'];
            $veh_Model = $row['veh_Model'];
            $price_per_Day = $row['price_per_Day'];
            $fuel_Type = $row['fuel_Type'];
            $veh_Colour = $row['veh_Colour'];
            $seating_Capacity = $row['seating_Capacity'];
            $veh_Transmission = $row['veh_Transmission'];
            $plateNo = $row['plateNo'];
            $supp_Name = $row['supp_Name'];
            $branch_Name = $row['branch_Name'];
            echo '<tr>
            <th scope="row">'.$veh_ID.'</th>
            <td>'.$brand_Name.'</td>
            <td>' .$veh_Model.'</td>
            <td>'.$price_per_Day.'</td>
            <td>'.$fuel_Type.'</td>
            <td>'.$veh_Colour.'</td>
            <td>'.$seating_Capacity.'</td>
            <td>'.$veh_Transmission.'</td>
            <td>'.$plateNo.'</td>
            <td>'.$supp_Name.'</td>
            <td>'.$branch_Name.'</td>
            <td>
            <button class="btn btn-primary"><a href="update-vehicle.php?updateid='.$veh_ID.'" class="text-light">Edit</a></button>
            <button class="btn btn-danger"><a href="delete-vehicle.php?deleteid='.$veh_ID.'" class="text-light">Delete</a></button>
          </tr>';
       
    }
  }}
  
    ?>
    <?php
            }

            else{
                echo "<script>alert('No Record Found');</script>";
				echo"<meta http-equiv='refresh' content='0; url=car-list.php'/>";
				}
            ?>
            <?php
            }
            ?>
    
              </tbody>
</table>
</body>
</html>