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

<title>V-Rental | My Reservation</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custom Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
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
        <h1>My Reservation</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>My Reservation</li>
        
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 





<?php 

session_start();
try {
  $username=$_SESSION['login'];
    $stmt = $dbh ->prepare("SELECT * FROM customer WHERE cust_Username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // User with that email address exists in the database
        // fetch the user's data and do something with it
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['customer'] = $user['cust_ID'];
    } else {       
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$username=$_SESSION['login'];
/*$sql = "SELECT * FROM user WHERE user_ID = 
   (SELECT user_ID
    FROM customer
    WHERE cust_Username = :username)";
    */
$sql = "CALL getuserinfo(:username)";
$query = $dbh -> prepare($sql);
//$stmt = $dbh->prepare("CALL getUserinfo(:username)");
$query -> bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"> <img src="assets/images/utem.png" alt="image">
      </div>

      <div class="dealer_info">
        <h5><?php echo htmlentities($result->f_name);?></h5>
        <p><?php echo htmlentities($result->email);?><br>
          <?php echo htmlentities($result->phoneNo);?>&nbsp;<?php echo htmlentities($result->Country); }}?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
   
      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">RESERVATION </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">

            
<?php 

 $custid=$_SESSION['customer'];
 $sql = "SELECT vehicle.veh_Image_1 as veh_Image_1 ,vehicle.veh_Model,vehicle.veh_ID as VID,brand.brand_Name,reservation.resv_ID,reservation.from_Date,reservation.to_Date,reservation.Status,vehicle.price_per_Day,reservation.total_days,reservation.Booking_Key from reservation join vehicle on reservation.veh_ID=vehicle.veh_ID join brand on brand.brand_ID=vehicle.brand_ID where reservation.cust_ID=:custid order by reservation.resv_ID desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':custid', $custid, PDO::PARAM_STR);
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
                <?php if($result->Status=='PENDING')
                { ?>
                <div class="vehicle_status"> <a href="payment.php?resvid=<?php echo htmlentities($result->resv_ID);?>" class="btn outline btn-xs ">CONFIRM PAYMENT</a>  
              
                <?php echo htmlentities($result->Status);?>
                           <div class="clearfix"></div>
        </div>

              <?php } else if($result->Status=='CONFIRMED') { ?>
 <div class="vehicle_status"> <a class="btn outline active-btn btn-xs">PAYMENT SUCCESSFUL</a>
            <?php echo htmlentities($result->Status);?>
            <div class="clearfix"></div>
        </div>
             


                <?php } else { ?>
 <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">-</a>
            <div class="clearfix"></div>
        </div>
                <?php } ?>
       
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
                <h5 align="center" style="color:red">No booking yet</h5>
              <?php } ?>
             
         
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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