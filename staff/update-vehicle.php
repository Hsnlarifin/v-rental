<?php
include ('db_conn.php');
include 'header.php';

$veh_ID=$_GET['updateid'];
$sql = "select brand_ID, veh_Model, price_per_Day, fuel_Type, veh_Colour, seating_Capacity, veh_Transmission, plateNo, supp_ID from vehicle where veh_ID ='$veh_ID'";
$result = mysqli_query($conn,$sql);
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $brand_ID=$row['brand_ID'];
    $veh_Model=$row['veh_Model'];
    $price_per_Day=$row['price_per_Day'];
    $fuel_Type=$row['fuel_Type'];
    $veh_Colour=$row['veh_Colour'];
    $seating_Capacity=$row['seating_Capacity'];
    $veh_Transmission=$row['veh_Transmission'];
    $plateNo=$row['plateNo'];
    $supp_ID=$row['supp_ID'];
    
  }
}

if (isset($_POST['submit'])) {
  $veh_ID = $_POST['veh_ID'];
  $brand_ID=$_POST['brand_ID'];
  $veh_Model=$_POST['veh_Model'];
  $price_per_Day=$_POST['price_per_day'];
  $fuel_Type=$_POST['fuel_Type'];
  $veh_Colour=$_POST['veh_Colour'];
  $seating_Capacity=$_POST['seating_Capacity'];
  $veh_Transmission=$_POST['veh_Transmission'];
  $plateNo=$_POST['plateNo'];
  $supp_ID=$_POST['supp_ID'];
  

  $sql = "update vehicle set brand_ID='$brand_ID', veh_Model='$veh_Model', price_per_Day='$price_per_Day', fuel_Type='$fuel_Type', veh_Colour='$veh_Colour', seating_Capacity='$seating_Capacity', veh_Transmission='$veh_Transmission', plateNo='$plateNo', supp_ID='$supp_ID' where veh_ID ='$veh_ID'";
  
  
  if (mysqli_query($conn, $sql)) {
   
    echo "<script>alert('Update successfully');</script>";
		echo"<meta http-equiv='refresh' content='0; url=car-list.php'/>";
    
  } else {
    die("Connection failed: " . mysqli_connect_error());
    echo "Updated";
    header('location: car-list.php');
  } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<!-- <title>Add Brand</title> -->

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex justify-content-center
  -align-items-center">
<form action="update-vehicle.php"
      method="post"
      class="shadow p-4 rounded mt-5"
      style="width:90%; max-width:50rem;">

  <h1 class="text-center p-5 display-4 fs-3">
    Update Vehicle Details
  </h1>

  <div class="mb-3">
  <input type="hidden" name="veh_ID" class="form-control" value=<?php echo $veh_ID?>>
  <label class="form-label"> Brand ID</label>
    <input type="text" name="brand_ID" class="form-control" required placeholder="Enter Brand ID" value=<?php echo 
    $brand_ID?>>
  </div> 

  <div class="mb-3">
  <label class="form-label"> Vehicle Model</label>
  <input type="text" name="veh_Model" class="form-control" required placeholder="Enter Vehicle Model" value=<?php echo $veh_Model?>>
  </div>

  <div class="mb-3">
  <label class="form-label"> Price Per Day</label>
    <input type="text" name="price_per_day" class="form-control" required placeholder="Enter Price Per Day" value=<?php echo $price_per_Day?>>
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
  <label class="form-label"> Vehicle Colour</label>
    <input type="text" name="veh_Colour" class="form-control" required placeholder="Enter Vehicle Colour" value=<?php echo $veh_Colour?>>
  </div>

  <div class="mb-3">
  <label class="form-label"> Seating Capacity</label>
    <input type="text" name="seating_Capacity" class="form-control" required placeholder="Enter Seating Capacity" value=<?php echo $seating_Capacity?>>
  </div>

  
  <div class="mb-3">
  <label class="form-label"> Vehicle Transmission</label>
    <input type="text" name="veh_Transmission" class="form-control" required placeholder="Enter Vehicle Transmission" value=<?php echo $veh_Transmission?>>
  </div>

  <div class="mb-3">
  <label class="form-label"> Plate No</label>
    <input type="text" name="plateNo" class="form-control" required placeholder="Enter Vehicle Plate No" value=<?php echo $plateNo?>>
  </div>

  <div class="mb-3">
  <label class="form-label"> Supplier ID</label>
    <input type="text" name="supp_ID" class="form-control" required placeholder="Enter Supplier ID" value=<?php echo 
    $supp_ID?>>
  </div> 


<button type="submit" name="submit" value="submit" 
              class="btn btn-primary">
              Update Vehicle </button>
</form>
	</div>
</body>

</html>