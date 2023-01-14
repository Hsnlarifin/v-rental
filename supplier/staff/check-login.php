<?php

session_start();
include "db_conn.php";


	if (isset($_POST['username']) && isset($_POST['password'])){

		//to prevent mysql injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);


		 //get values from login.php
		$username=$_POST['username'];
		$password=$_POST['password'];

		if(empty($username)) {
			header("Location: login.php?error=Username is required.");
			exit();
		}else if (empty($password)){
			header("Location: login.php?error=Password is required.");
			exit();
		}else{		

		//select from admin table
		$adminlogin = "select * from staff where staff_Username = '$username' and staff_Pass ='$password'";
		$result = mysqli_query($conn, $adminlogin) or die(mysqli_error($conn));
      
      if(mysqli_num_rows($result)>0)
      {
			$row = mysqli_fetch_assoc($result);
			
	
			if($row['staff_Username'] == $username && $row['staff_Pass'] == $password){
				echo "Login Successful! Welcome ";
				$user = "admin";
							
							}}
							
							else  {
								header("Location: login.php?error=Username and Password does not match.");
							}
							}
			
			}		
		?>

		<!-- 	$sql = "SELECT * FROM admin WHERE username=?";
			 $stmt->execute([$username]);

			if($stmt->rowCount() === 1){
				  	$admin = $stmt ->fetch();

		 		 $admin_id = $admin['adminID'];
         $admin_name = $admin['adminName'];
         $admin_phone = $admin['adminPhoneNum'];
         $admin_dob = $admin ['DOB'];
         $admin_username = $admin['username'];
         $admin_pass = $admin['password'];

        if($username === $admin_username){
      		if(password_verify($password, $admin_pass))
      			$_SESSION['admin_id'] = $admin_id;
      			$_SESSION['adminName'] = $admin_name;
       			$_SESSION['adminPhoneNum'] = $admin_phone;
       			$_SESSION['DOB'] = $admin_dob;
        		$_SESSION['username'] = $admin_username;
        			header("Location: ../index.php");
        }else{
        	$em = "Incorrect username or password";
      	header("Location: ../login.php?error=$em");
      }
		}else{
			$em = "Incorrect username or password";
			header("Location: ../login.php?error=$em");
		}
        }else{
     	$em = "Incorrect username or password";
			header("Location: ../login.php?error=$em");   	
        }
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset = "UTF-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN PAGE</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</head>
<body>
  <div class="d-flex justify-content-center
  -align-items-center"
  		style = "min-height: 100vh;">
      
  <form class= "p-5 rounded shadow"
  		style= "max-width: 30rem;"
  		method="POST"
  		action="php/check-login.php">


  	<h1 class = "text-center display-4 pb-5 ">LOGIN</h1>
    <?php if (isset($_GET['error'])) { ?>  
  	<div class="alert alert-danger" role="alert">
 			 <?=$_GET['error']?>
			</div>
		<?php } ?>

  <div class="mb-3">
    <label for="username"
    	 class="form-label">Username</label>
    <input type="text" 
     	 class="form-control" 
      	name="username"
      	id="username" >

	</div>  
   <div class="mb-3">
  	  <label for="password" class="form-label">Password</label>
    	<input type="password" 
    							name="password"
     						  class="form-control" 
    						  id="password" >
   </div>
     
 		 <button type="submit"
 		 				 class="btn btn-primary">
 		 					Login</button>

 		 <a href="#">Don't have an account yet? Sign Up here.</a> 
</form>


  </div>
</body>
</html>