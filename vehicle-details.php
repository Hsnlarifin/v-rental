
<?php 

session_start();
include('includes/config.php');
error_reporting(0);

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
        // User with that email address does not exist in the database
        echo "Sorry, we couldn't find an account with that email address.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
//$message=$_POST['message'];
$username=$_SESSION['login'];
$custid=$_SESSION['customer'];
$status='PENDING';
$vhid=$_GET['vhid'];
$bookingkey=mt_rand(1000, 9999);

//

$ret="SELECT * FROM reservation where (:fromdate BETWEEN date(from_Date) and date(to_Date) || :todate BETWEEN date(from_Date) and date(to_Date) || date(from_Date) BETWEEN :fromdate and :todate) and veh_ID=:vhid";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$todate,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);


//make trigger for insert status auto pending
//make trigger for paymentid
//trigger to count days
//trigger to change availibility 

if($query1->rowCount()==0)
{
$sql="INSERT INTO reservation(Booking_Key,cust_ID,veh_ID,from_Date,to_Date,Status) VALUES(:bookingkey,:custid,:vhid,:fromdate,:todate,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingkey',$bookingkey,PDO::PARAM_STR);
$query->bindParam(':custid',$custid,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
//$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successful.');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";

//to call procedure to update totaldays attribute-------------
$sql = "CALL updatetotaldays";
$query = $dbh -> prepare($sql);
$query->execute();

}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} }  else{
 echo "<script>alert('Car already booked for these days');</script>"; 
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>

<title>V-Rental | Vehicle Details</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
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

<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="images/tab_icon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 
<?php 

$vhid=intval($_GET['vhid']);

//$sql = "SELECT * FROM brand JOIN vehicle ON brand.brand_id = vehicle.brand_id WHERE vehicle.veh_ID =:vhid"; 
//$sql2 = "SELECT STATUS FROM vehicle_status WHERE veh_ID =:vhid";

//JOIN QUERY

$sql = "SELECT * FROM vehicle_status
JOIN vehicle ON vehicle.veh_ID = vehicle_status.veh_ID
JOIN brand ON brand.brand_ID = vehicle.brand_ID
WHERE vehicle_status.veh_ID =:vhid";

$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
foreach($results as $result)
{    
?>  
</section>
<!--Listing-detail-->          
<section class="listing-detail">
  
  <div class="container">  
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->brand_Name);?> , <?php echo htmlentities($result->veh_Model);?></h2>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="assets/images/<?php echo htmlentities($result->veh_Image_1);?> "class="img-responsive" alt="Image" /> </a> 
          <div class="col-md-3">
        <div class="price_info">
          <p>RM<?php echo htmlentities($result->price_per_Day);?> </p>Per Day
        </div>               
      </div>       
        </div>
      </div>     
    </div>

    <!--Side-Bar-->
    <aside class="col-md-3">
      
      <div class="sidebar_widget">
        <div class="widget_heading">
          <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
        </div>
        <form method="post">
          <div class="form-group">
            <label>From Date:</label>
            <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
          </div>
          <div class="form-group">
            <label>To Date:</label>
            <input type="date" class="form-control" name="todate" placeholder="To Date" required>
          </div>
          
         <!-- <div class="form-group">
            <textarea rows="4" class="form-control" name="message" placeholder="Message" ></textarea>
          </div> -->
          

        <?php if($_SESSION['login'])
            {?>
            <div class="form-group">
              <input type="submit" class="btn"  name="submit" value="Book Now">
            </div>
            <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login to Book</a>

            <?php } ?>
        </form>
      </div>
    </aside>
    <!--/Side-Bar--> 
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>        
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
            <?php if($result->status=='Available'){ ?> 

              <h5 style="color:green"><?php echo htmlentities($result->status);?></h5>

            <?php } else {?>

            <h5 style="color:red"><?php echo htmlentities($result->status);?></h5>

            <?php } ?>
            
              <p>Status</p>            
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->fuel_Type);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->seating_Capacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap">                                                
<?php }} 
?>
      </div>     
    </div>   
    <div class="space-20"></div>
    <div class="divider"></div>
     </div>
    </div> 
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>