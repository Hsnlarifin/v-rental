<?php
	include('includes/config.php');
	$reqErr = $loginErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(!empty($_POST['txtUsername']) && !empty($_POST['txtPassword']) ){
			session_start();
			$username = $_POST['txtUsername'];
			$password = $_POST['txtPassword'];
			
		
				$query_selectSupplier = "SELECT sup_id,username,password FROM supplier WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectSupplier);
				
			
				if (mysqli_num_rows($result) === 1) {
						$row = mysqli_fetch_assoc($result);
					if ($row['username'] === $username && $row['password'] === $password) {
						$_SESSION['supplier_id'] =  $row['sup_id'];
            			$_SESSION['username'] = $row['username'];
            			$_SESSION['password'] = $row['password'];
						$_SESSION['sup_login'] = true;
						header('Location:supplier/index.php');
				}
				else {
					$loginErr = "* Username or Password is incorrect.";
				}
			}
			
			}
		}
		
	
?>
<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<link rel="stylesheet" href="includes/main_style.css" >
</head>
<body class="login-box">
	<h1>LOGIN</h1>
	<form action="" method="POST" class="login-form">
	<ul class="form-list">
	<li>
		<div class="label-block"> <label for="login:username">Username</label> </div>
		<div class="input-box"> <input type="text" id="login:username" name="txtUsername" placeholder="Username" /> </div>
	</li>
	<li>
		<div class="label-block"> <label for="login:password">Password</label> </div>
		<div class="input-box"> <input type="password" id="login:password" name="txtPassword" placeholder="Password" /> </div>
	</li>
	
	<li>
		<input type="submit" value="Login" class="submit_button" /> <span class="error_message"> <?php echo $loginErr; echo $reqErr; ?> </span>
	</li>
	</ul>
	</form>
</body>
</html>