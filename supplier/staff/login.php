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
  		action="check-login.php">


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