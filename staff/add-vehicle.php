<?php
include 'db_conn.php';
include 'header.php';

if(isset($_POST['submit'])){
  $brand_ID=$_POST['brand_ID'];
  $veh_Model=$_POST['veh_Model'];
  $price_per_Day=$_POST['price_per_Day'];
  $fuel_Type=$_POST['fuel_Type'];
  $veh_Colour=$_POST['veh_Colour'];
  $seating_Capacity=$_POST['seating_Capacity'];
  $veh_Transmission=$_POST['veh_Transmission'];
  $plateNo=$_POST['plateNo'];
  $veh_Image_1=$_POST['veh_Image_1'];
  $supp_ID=$_POST['supp_ID'];
  $branch_ID=$_POST['branch_ID'];
  
 
 


  $sql="insert into vehicle (brand_ID,veh_Model, price_per_Day, fuel_Type, veh_Colour, seating_Capacity, veh_Transmission, plateNo, veh_Image_1, supp_ID, branch_ID) values ('$brand_ID','$veh_Model', '$price_per_Day', '$fuel_Type', '$veh_Colour', 
    '$seating_Capacity', '$veh_Transmission', '$plateNo', 'images/$veh_Image_1', '$supp_ID', '$branch_ID')";
  $result=mysqli_query($conn,$sql);
  if($result){
     
    echo "<script>alert('Vehicle Added Successfully!');</script>";
	  echo"<meta http-equiv='refresh' content='0; url=car-list.php'/>";
  }else{
    die (mysqli_error($conn));
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Add Vehicle</title>

    <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="d-flex justify-content-center
  -align-items-center">

     <form action="add-vehicle.php"
           method="post" 
           class="shadow p-5 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

      <h1 class="text-center pb-5 display-4 fs-3">
        Add New Vehicle
      </h1>

      <div class="mb-3">
        <label class="form-label">
                Brand ID
               </label>
        <input type="text" 
               class="form-control" 
               name="brand_ID" required>
    </div>

      <div class="mb-3">
        <label class="form-label">
                Vehicle Model
               </label>
        <input type="text" 
               class="form-control" 
               name="veh_Model" required>
    </div>


    <div class="mb-3">
        <label class="form-label">
                Price Per Day
               </label>
        <input type="number" 
               class="form-control" 
               name="price_per_Day" required>
    </div>

    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Fuel Type</label>
  <select name="fuel_Type" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected>Select</option>
    <option value="Petrol">Petrol</option>
    <option value="Diesel">Diesel</option>
    <option value="CNG">CNG</option>
  </select>
  <div>

    <div class="mb-3">
        <label class="form-label">
                Vehicle Colour
               </label>
        <input type="text" 
               class="form-control" 
               name="veh_Colour" required>
    </div>

    <div class="mb-3">
        <label class="form-label">
                Seating Capacity
               </label>
        <input type="text" 
               class="form-control" 
               name="seating_Capacity" required>
    </div>

    <div class="mb-3">
        <label class="form-label">
                Vehicle Transmission
               </label>
        <input type="text" 
               class="form-control" 
               name="veh_Transmission" required>
    </div>

    <div class="mb-3">
        <label class="form-label">
                Plate No
               </label>
        <input type="text" 
               class="form-control" 
               name="plateNo" required>
    </div>

    <div class="form-group">
    <div class="col-sm-12">
    <h4><b>Upload Images</b></h4>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-sm-4">
    Image 1 <input type="file" name="veh_Image_1" required> 
    </div><br>

    <div class="mb-3">
        <label class="form-label">
                Supplier ID
               </label>
        <input type="text" 
               class="form-control" 
               name="supp_ID" required>
    </div>

    <div class="mb-3">
        <label class="form-label">
                Branch ID
               </label>
        <input type="text" 
               class="form-control" 
               name="branch_ID" required>
    </div>
 
 


    <div class="mb-3">
    </div>
    <div class="hr-dashed"></div>                 
    </div>

      <button type="submit" name="submit" value="Submit" 
              class="btn btn-primary">
              Add Vehicle </button>
       <input class="btn btn-primary" type="reset" value="Reset">
     </form>
  </div>
</body>
</html>

