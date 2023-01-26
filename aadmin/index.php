<?php
session_start();
include('includes/config.php');

if(isset($_POST['submit']))
{
    $username = $_POST['staff_Username'];
    $pass     = $_POST['staff_Pass'];
    $position = "Admin";

    $sql = "SELECT * FROM staff WHERE staff_Username = '$username' AND staff_Pass = '$pass' AND staff_Position = '$position'";
    $query  = mysqli_query($conn,$sql);
    $row    = mysqli_fetch_array($query);
    if($row > 0)
    {
    	$_SESSION['adminid'] = $row['staff_ID'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    }
    else
    {
        $message = "Invalid username or password";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>


<!doctype html>
<html lang="en" class="no-js">
<head>
<?php include('includes/title.php');?>
</head>

<body>
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff">Admin | Log In</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
								
									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="Username" name="staff_Username" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="staff_Pass" class="form-control mb" required>
		
									<button class="btn btn-primary btn-block" name="submit" type="submit">LOGIN</button>

								</form>
								<p style="margin-top: 4%" align="center"><a href="../index.php">Back to Home</a>	</p>
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