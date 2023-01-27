<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{	
    header('location:logout.php');
}
else
{ 
    if(isset($_POST['submit']))
    {
        $resv_id = $_GET['resv_ID'];
        $paymentstatus = $_POST['payment_Status'];

        $sql = "UPDATE payment SET payment_Status = '$paymentstatus' WHERE payment_ID IN (SELECT payment_ID FROM reservation WHERE resv_ID = '$resv_id')";
  
        $query = mysqli_query($conn,$sql);
        if($query)
        {
            echo "<script type='text/javascript'>alert('You have successfully update the data!');</script>";
            echo "<script type='text/javascript'> document.location ='payment-status.php'; </script>";
        }  
        else
        {
            echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
        }  
    }
}
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<?php include('includes/title.php');?>
	<meta name="theme-color" content="#3e454c">
</head>

<body>
<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="font-size: 22px;">Update Payment Status</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Booking Details</div>
<?php
$resv_id = $_GET['resv_ID'];
$sql = "SELECT license.*, customer.*, reservation.*, user.*, vehicle.*, brand.*, payment.*
		FROM license
		JOIN customer ON license.cust_ID = customer.cust_ID
		JOIN reservation ON customer.cust_ID = reservation.cust_ID
		JOIN user ON customer.user_ID = user.user_ID
		JOIN vehicle ON reservation.veh_ID = vehicle.veh_ID
		JOIN brand ON vehicle.brand_ID = brand.brand_ID
        JOIN payment ON reservation.payment_ID = payment.payment_ID
		WHERE reservation.Status = 'CONFIRMED'
        AND reservation.resv_ID = '$resv_id'";
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

									<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-4 control-label">Booking No</label>
											<div class="col-sm-5">
												<input type="text" name="Booking_Key" class="form-control" value="<?php echo $row['Booking_Key']?>" disabled>
											</div>
										</div>

                                <div class="hr-dashed"></div>

                                        <div class="form-group">
                                        <label class="col-sm-2 control-label">First Name</label>
											<div class="col-sm-4">
												<input type="text" name="f_Name" class="form-control" value="<?php echo $row['f_Name']?>" disabled>
											</div>

                                            <label class="col-sm-2 control-label">Last Name</label>
											<div class="col-sm-4">
												<input type="text" name="l_Name" class="form-control" value="<?php echo $row['l_Name']?>" disabled>
											</div>
                                        </div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Vehicle Brand</label>
											<div class="col-sm-4">
												<input type="text" name="brand_Name" class="form-control" value="<?php echo $row['brand_Name']?>" disabled>
											</div>

                                            <label class="col-sm-2 control-label">Vehicle Model</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="veh_Model" class="form-control" value="<?php echo $row['veh_Model']?>" disabled>
                                                </div>
										</div>


										<div class="form-group">
                                            <label class="col-sm-2 control-label">Date Start Rental</label>
                                                <div class="col-sm-4">
                                                    <input type="date" name="from_Date" class="form-control" value="<?php echo $row['from_Date']?>" disabled>
                                                </div>

                                            <label class="col-sm-2 control-label">Date End Rental</label>
                                                <div class="col-sm-4">
                                                    <input type="date" name="to_Date" class="form-control" value="<?php echo $row['to_Date']?>" disabled>
                                                </div>
										</div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Payment Method</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="payment_Method" class="form-control" value="<?php echo $row['payment_Method']?>" disabled>
                                                </div>

                                            <label class="col-sm-2 control-label">Date of Payment</label>
                                                <div class="col-sm-4">
                                                    <input type="date" name="payment_Date" class="form-control" value="<?php echo $row['payment_Date']?>" disabled>
                                                </div>
										</div>

                                <div class="hr-dashed"></div>
                                
										<div class="form-group">
                                            <label class="col-sm-2 control-label">Payment Status</label><br>
                                                <div class="col-sm-4">
                                                    <input type="checkbox" name="payment_Status" value="PAID">&nbsp;&nbsp;&nbsp;
                                                    <label for="payment_Status">PAID</label>
                                                </div>
										</div>

									
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-success" name="submit" type="submit">Update Customer</button>
												<a href="payment-status.php" class="btn btn-default">Back</a>
											</div>
										</div>

									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>