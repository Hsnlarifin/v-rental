<?php
include 'db_conn.php';
include 'header.php';

if(isset($_POST['submit'])){
  $service_Type=$_POST['service_Type'];

  $sql="insert into maintenance (service_Type) values ('$service_Type')";
  $result=mysqli_query($conn,$sql);
  if($result){
   
    echo "<script>alert('Data Inserted Successfully!');</script>";
    echo"<meta http-equiv='refresh' content='0; url=maintenance-list.php'/>";
  }else{
    die (mysqli_error($conn));
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
  <title>Maintenance</title>

    <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

     <div class="d-flex justify-content-center
     -align-items-center">
     <form action="maintenance.php"
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

      <h1 class="text-center pb-5 display-4 fs-3">
        Maintenance
      </h1>

      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Service Type</label>
  <select name="service_Type" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected>Select</option>
    <option value="Interim Car Service">Interim Car Service</option>
    <option value="Full Car Service">Full Car Service</option>
    <option value="Major Car Service">Major Car Service</option>
  </select>
  <div>
    
  
      <button type="submit" name="submit" value="Submit" 
              class="btn btn-primary">
              Submit </button>
     </form>
  </div>
</body>
</html>
