<?php
	include("../config.php");
	
	session_start();
	if(isset($_SESSION['sup_id'])) 
	{
		$sup_id = $_SESSION["sup_id"];
	}
	else 
	{
		header('Location:../sindex.php');
	}

		$query = "SELECT * FROM supplier WHERE sup_id='$sup_id'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);

		if($_SERVER['REQUEST_METHOD'] == "POST") 
		{
			$sup_name = $_POST['sup_name'];
			$sup_email = $_POST['sup_email'];
			$sup_phone = $_POST['sup_phone'];
			$company_name = $_POST['company_name'];
			$address = $_POST['address'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			$qry = "UPDATE supplier SET sup_name='$sup_name',sup_email='$sup_email',sup_phone='$sup_phone',company_name='$company_name',address='$address',username='$username',password='$password' WHERE sup_id='$sup_id'";
	        $ret = mysqli_query($conn,$qry);
	
	if($ret)
	{
		echo "<script>alert('Update successfully');</script>";
		echo"<meta http-equiv='refresh' content='0; url=dashboard.php'/>";
	}
	else
	{
		echo "Failed: " .mysqli_error($conn);
	}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Edit Profile </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_Supplier.inc.php");
		include("../includes/aside_Supplier.inc.php");
	?>
	<section>
		<h1>Edit Profile</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="Supplier:name">Name</label> </div>
			<div class="input-box"> <input type="text"  name="sup_name" placeholder="Name" value="<?php echo $row['sup_name']; ?>" required /> </div> 
		</li>
		<li>
			<div class="label-block"> <label for="Supplier:email">Email</label> </div>
			<div class="input-box"> <input type="text"  name="sup_email" placeholder="Email" value="<?php echo $row['sup_email']; ?>" required /> </div>
		</li>
		<li>
			<div class="label-block"> 
				<label for="Supplier:phone">Phone</label>
			</div>
			<div class="input-box"> <input type="text"  name="sup_phone" placeholder="Phone" value="<?php echo $row['sup_phone']; ?>" /> </div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="Supplier:company name">Company Name</label>
			</div>
			<div class="input-box"> <input type="text"  name="company_name" placeholder="Company Name" value="<?php echo $row['company_name']; ?>" /> </div> 
		</li>

		<li>
			<div class="label-block"> 
				<label for="Supplier:Address">Company Address</label>
			</div>
			<div class="input-box"> <input type="text"  name="address" placeholder="Address" value="<?php echo $row['address']; ?>" /> </div> 
		</li>

		<li>
			<div class="label-block"> <label for="Supplier:username">Username</label> </div>
			<div class="input-box"> <input type="text"  name="username" placeholder="Username" value="<?php echo $row['username']; ?>" /> </div> 
		</li>
		<li>
			<div class="label-block"> <label for="Supplier:password">Password</label> </div>
			<div class="input-box"> <input type="text"  name="password" placeholder="Password" value="<?php echo $row['password']; ?>" /> </div> 
		</li>
		<li>
			
			<input type="submit" value="Update Profile" class="submit_button" /> 
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>