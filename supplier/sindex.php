<?php
session_start();
include ('config.php');



	if(isset($_POST['btn_login'])) {
		
			$username = $_POST['username'];
			$password = $_POST['password'];

		$query_selectSupplier = "SELECT * FROM supplier WHERE username='$username' AND password='$password'";
		
		$result = mysqli_query($conn,$query_selectSupplier);
		
				if(mysqli_num_rows($result)>0)
				{
					$row = mysqli_fetch_assoc($result);
					
					$_SESSION['sup_id'] =  $row['sup_id'];
					$_SESSION['sup_name'] =  $row['sup_name'];
				    $_SESSION['sup_email'] = $row['sup_email'];
				    $_SESSION['sup_phone'] = $row['sup_phone'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['password'] = $row['password'];
					
					echo "<script>alert('Login Success!');</script>";
			        echo"<meta http-equiv='refresh' content='0; url=manufacturer/dashboard.php'/>";

				}
				else {
			      echo "<script>alert('Woops! Username or Password was wrong');</script>";
                  echo"<meta http-equiv='refresh' content='0; url=sindex.php'/>";
				}
			}	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Login </title>
	<link rel="stylesheet" href="includes/main_style.css" >
</head>
<body class="login-box">
	<h1>SUPPLIER LOGIN</h1>
	<form action="" method="POST" class="login-form">
	<ul class="form-list">
	<li>
		<div class="label-block"> <label for="username">Username</label> </div>
		<div class="input-box"> <input type="text" id="username" name="username" placeholder="Username" /> </div>
	</li>
	<li>
		<div class="label-block"> <label for="password">Password</label> </div>
		<div class="input-box"> <input type="password" id="password" name="password" placeholder="Password" /> </div>
	</li>
	
	<li>
		<div class="input-group">
		<button name="btn_login" class="btn">Log in</button>
		</div>
		<!--<input type="submit" value="Login" class="submit_button" /> <span class="error_message"> <?php echo $loginErr; echo $reqErr; ?> </span>-->
	</li>
	</ul>
	</form>
</body>
</html>