<?php

session_start();
error_reporting(0);

include('../includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{
	header('Location: logout.php');
}
else
{
/*---SUB-QUERY---*/

	 $cust_id = $_GET['cust_ID'];
	 
	 $sql = "DELETE FROM user
			 WHERE user_ID IN (SELECT user_ID 
				 				FROM customer 
				 				WHERE cust_ID IN (SELECT cust_ID
				 									FROM license
				 									WHERE cust_ID = '$cust_id'))";

	$query = mysqli_query($conn,$sql);

	if ($query)
	{	 	
		$msg = "Data is successfully deleted!";
		echo "<script>alert('$msg');</script>"; 
		echo "<script>window.location.href = 'index_cust.php'</script>";
	}
	else
	{
		$msg = "Something went wrong. Please try again";
        echo "<script type='text/javascript'>alert('$msg');</script>";
	}
}
?>