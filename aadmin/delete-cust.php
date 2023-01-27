<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{
	header('location: logout.php');
}
else
{
/*---NESTED QUERY---*/

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
		echo "<script>alert('Data is successfully deleted!');</script>"; 
		echo "<script>window.location.href = 'manage-cust.php'</script>";
	}
	else
	{
        echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
	}
}
?>