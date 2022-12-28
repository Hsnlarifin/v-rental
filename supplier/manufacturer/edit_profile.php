<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['Supplier_login'])) {
		$name = $phone = $email = "";
		$nameErr = $phoneErr = $emailErr = $requireErr = $confirmMessage = "";
		$usernameHolder = $phoneHolder = $emailHolder = "";
		$id = $_SESSION['Supplier_id'];
		$query_selectMan = "SELECT * FROM Supplier WHERE man_id='$id'";
		$result_selectMan = mysqli_query($con,$query_selectMan);
		$row_selectMan = mysqli_fetch_array($result_selectMan);
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(!empty($_POST['txtSupplierName'])) {
					$nameHolder = $_POST['txtSupplierName'];
					$resultValidate_name = validate_name($_POST['txtSupplierName']);
					if($resultValidate_name == 1) {
						$name = $_POST['txtSupplierName'];
					}
					else{
						$nameErr = $resultValidate_name;
					}
				}
				if(!empty($_POST['txtSupplierEmail'])) {
					$emailHolder = $_POST['txtSupplierEmail'];
					$resultValidate_email = validate_email($_POST['txtSupplierEmail']);
					if($resultValidate_email == 1) {
						$email = $_POST['txtSupplierEmail'];
					}
					else {
						$emailErr = $resultValidate_email;
					}
				}
				if(!empty($_POST['txtSupplierPhone'])) {
					$phoneHolder = $_POST['txtSupplierPhone'];
					$resultValidate_phone = validate_phone($_POST['txtSupplierPhone']);
					if($resultValidate_phone == 1) {
						$phone = $_POST['txtSupplierPhone'];
					}
					else {
						$phoneErr = $resultValidate_phone;
					}
				}
			if($name != null && $phone != null) {
					$query_updateMan = "UPDATE Supplier SET man_name='$name',man_email='$email',man_phone='$phone' WHERE man_id='$id'";
					if(mysqli_query($con,$query_updateMan)) {
						echo "<script> alert(\"Supplier Updated Successfully\"); </script>";
						header("Refresh:0");
					}
					else {
						$requireErr = "Updating Supplier Failed";
					}
				}
				else {
					$requireErr = "* Valid Name & Phone is compulsory";
				}
		}
	}
	else {
		header('Location:../index.php');
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
			<div class="input-box"> <input type="text" id="Supplier:name" name="txtSupplierName" placeholder="Name" value="<?php echo $row_selectMan['man_name']; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="Supplier:email">Email</label> </div>
			<div class="input-box"> <input type="text" id="Supplier:email" name="txtSupplierEmail" placeholder="Email" value="<?php echo $row_selectMan['man_email']; ?>" required /> </div> <span class="error_message"><?php echo $emailErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="Supplier:phone">Phone</label> </div>
			<div class="input-box"> <input type="text" id="Supplier:phone" name="txtSupplierPhone" placeholder="Phone" value="<?php echo $row_selectMan['man_phone']; ?>" /> </div> <span class="error_message"><?php echo $phoneErr; ?></span>
		</li>
		<li>
			<a href="change_password.php"><input type="button" value="Change Password" class="submit_button" /></a>
			<input type="submit" value="Update Profile" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>