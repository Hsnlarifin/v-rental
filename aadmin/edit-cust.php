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
        $cust_id = $_GET['cust_ID'];
        $phoneNo = $_POST['phoneNo'];
        $street = $_POST['street'];
        $postcode = $_POST['postcode'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        //$timestamp = date("Y-m-d H:i:s");
  
  /*--SUB-QUERY--*/
        $sql = "UPDATE user SET phoneNo = '$phoneNo'
                WHERE user_ID IN (SELECT user_ID 
                                    FROM customer
                                    WHERE cust_ID IN (SELECT cust_ID
                                                        FROM license
                                                        WHERE cust_ID = '$cust_id'))";
  
        $query = mysqli_query($conn,$sql);
        if($query)
        {
            $sql2 = "UPDATE customer SET street = '$street', postcode = '$postcode', city = '$city', state = '$state', Update_Date = CURRENT_TIME()
                     WHERE cust_ID IN (SELECT cust_ID
                                       FROM license
                                       WHERE cust_ID = '$cust_id')";
            $query2 = mysqli_query($conn,$sql2);
            if ($query2)
            {
                echo "<script type='text/javascript'>alert('You have successfully update the data!');</script>";
                echo "<script type='text/javascript'> document.location ='manage-cust.php'; </script>";
            }  
            else
            {
               echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
            }
            	
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
						<h2 class="page-title" style="font-size: 22px;">Update Customer Detail</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Customer Information</div>
<?php
$cust_id = $_GET['cust_ID'];
$sql4 = "SELECT * FROM  user u JOIN customer c ON u.user_ID = c.user_ID JOIN license l ON c.cust_ID = l.cust_ID WHERE l.cust_ID = '$cust_id'";
$result2  = mysqli_query($conn, $sql4);
$row = mysqli_fetch_assoc($result2);
?>

									<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
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
											<label class="col-sm-2 control-label">Email</label>
											<div class="col-sm-4">
												<input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" disabled>
											</div>

                                            <label class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="cust_Username" class="form-control" value="<?php echo $row['cust_Username']?>" disabled>
                                                </div>
										</div>


										<div class="form-group">
                                            <label class="col-sm-2 control-label">Age</label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="age" class="form-control" min="17" max="99"value="<?php echo $row['age']?>" disabled>
                                                </div>

                                            <label class="col-sm-2 control-label">Phone No</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="phoneNo" class="form-control" maxlength="11" value="<?php echo $row['phoneNo']?>">
                                                </div>
										</div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">License</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="license_Type" class="form-control" value="<?php echo $row['license_Type']?>" disabled>
                                                </div>

                                            <label class="col-sm-2 control-label">Date of Expiration</label>
                                                <div class="col-sm-4">
                                                    <input type="date" name="expiration" class="form-control" value="<?php echo $row['expiration']?>" disabled>
                                                </div>
										</div>


										<div class="form-group">
                                            <label class="col-sm-2 control-label">Street</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="street" class="form-control" value="<?php echo $row['street']?>">
                                                </div>

                                            <label class="col-sm-2 control-label">Postcode</label>
                                                <div class="col-sm-4">
                                                    <input type="int" name="postcode" class="form-control" maxlength="5" value="<?php echo $row['postcode']?>">
                                                </div>
										</div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">City</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="city" class="form-control" value="<?php echo $row['city']?>">
                                                </div>

                                            <label class="col-sm-2 control-label">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="state" class="form-control" value="<?php echo $row['state']?>">
                                                </div>
										</div>

									
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-success" name="submit" type="submit">Update Customer</button>
												<a href="manage-cust.php" class="btn btn-default">Back</a>
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