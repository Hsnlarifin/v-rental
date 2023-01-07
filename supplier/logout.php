<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['sup_id']) ) {
		session_destroy();
		echo "<h1 style=\"color:#009688\">Log Out Successful</h1>";
//		echo "<h2 style=\"color:#009688\">You will be redirected to Login page in 3 seconds...</h2>";
		header('Refresh:2;url="sindex.php"');
	}
	else {
			header('Location:../sindex.php');
	}
?>