<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>V-Rental | Pay </title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custom Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">


        
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="images/tab_icon.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
</head>
<body>


<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->

<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Pay</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Pay</li>
        
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php
if(isset($_POST['paynow']))
{
$ptype=$_POST['paytype'];
$resvid=$_GET['resvid'];
$pstatus = 'PAID';
$amount = $tds*$ppd;
$sql = "INSERT INTO PAYMENT(resv_ID,payment_Method,payment_Status,amount) VALUES (:resvid,:paytype,:pstatus,:amount)";
$query = $dbh -> prepare($sql);
$query -> bindParam(':paytype',$ptype, PDO::PARAM_STR);
$query -> bindParam(':resvid',$resvid, PDO::PARAM_STR);
$query -> bindParam(':pstatus',$pstatus, PDO::PARAM_STR);
$query -> bindParam(':amount',$amount, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('PAYMENT successful.');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";

//to call procedure to update totaldays attribute-------------
//$sql = "CALL updatetotaldays";
//$query = $dbh -> prepare($sql);
//$query->execute();

}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} }  else{
 echo "<script>alert('Car Paid Already');</script>"; 
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
}

?>

<?php 



if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">       
          <?php  }}?></p>   
    
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
   
      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline" style="color:green">Make Payment</h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">

            
<?php 


 $custid=$_SESSION['customer'];
 $resvid=$_GET['resvid'];
 $sql = "SELECT vehicle.veh_Image_1 as veh_Image_1 ,vehicle.veh_Model,vehicle.veh_ID as VID,brand.brand_Name,reservation.from_Date,reservation.to_Date,reservation.Status,vehicle.price_per_Day,reservation.total_days,reservation.Booking_Key from reservation join vehicle on reservation.veh_ID=vehicle.veh_ID join brand on brand.brand_ID=vehicle.brand_ID where reservation.resv_ID=:resvid order by reservation.resv_ID desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':resvid', $resvid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
    <h4 style="color:red">Booking No #<?php echo htmlentities($result->Booking_Key);?></h4>
                <div class="vehicle_img"> <a href="vehicle-details.php?vhid=<?php echo htmlentities($result->VID);?>"><img src="assets/images/<?php echo htmlentities($result->veh_Image_1);?>" alt="image"></a> </div>
                <div class="vehicle_title">

                  <h6><a href="vehicle-details.php?vhid=<?php echo htmlentities($result->VID);?>"> <?php echo htmlentities($result->brand_Name);?> , <?php echo htmlentities($result->veh_Model);?></a></h6>
                  <p><b>From </b> <?php echo htmlentities($result->from_Date);?> <b>To </b> <?php echo htmlentities($result->to_Date);?></p>
                  <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
                </div>

       
              </li>

<h5 style="color:blue">Invoice</h5>
<table>
  <tr>
    <th>Car Name</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Total Days</th>
    <th>Rent / Day</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->veh_Model);?>, <?php echo htmlentities($result->brand_Name);?></td>
     <td><?php echo htmlentities($result->from_Date);?></td>
      <td> <?php echo htmlentities($result->to_Date);?></td>
       <td><?php echo htmlentities($tds=$result->total_days);?></td>
        <td> RM <?php echo htmlentities($ppd=$result->price_per_Day);?></td>
  </tr>
  <tr>
    <th colspan="4" style="text-align:center;"> Grand Total</th>
    <th>RM <?php echo htmlentities($tds*$ppd);?></th>
  </tr>
</table>
<hr />
              <?php }}  else { ?>              
              <?php } ?> 
                             
            </ul> 
            <!--Side-Bar-->

          </div>
        </div>

</section>           
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>