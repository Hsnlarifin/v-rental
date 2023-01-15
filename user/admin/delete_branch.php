<?php

session_start();
error_reporting(0);

include('../includes/config.php');

	/*
<!--f(x)-->
	$branch_ID = $_GET['branch_ID'];
	$location_ID = $_GET['location_ID'];

	$sql = "DELETE FROM branch WHERE location_ID = '$location_ID'";
	$query = mysqli_query($conn,$sql);

	$sql2 = "DELETE FROM location WHERE location_ID = '$location_ID'";
	$result = mysqli_query($conn, $sql2);

	if ($result)
	{	 	
		$msg = "Branch is successfully deleted";
	    echo "<script type='text/javascript'>alert('$msg');</script>";

	    header("Location: index_branch.php");
	}
	else
	{
		$msg = "Something went wrong. Please try again";
        echo "<script type='text/javascript'>alert('$msg');</script>";
	}
*/
if(strlen($_SESSION['adminid'])==0)
{
	header('Location: logout.php');
}
else
{
/*---SUB-QUERY---*/

	//CASCADE DELETE also f(x)
	 $branchid = $_GET['branch_ID'];
	 $sql = "DELETE FROM location WHERE location_ID IN (SELECT location_ID FROM branch WHERE branch_ID = '$branchid')";

	 $query = mysqli_query($conn,$sql);

	if ($query)
	{	 	
		$msg = "Data is successfully deleted!";
		echo "<script>alert('$msg');</script>"; 
		echo "<script>window.location.href = 'index_branch.php'</script>";
	}
	else
	{
		$msg = "Something went wrong. Please try again";
        echo "<script type='text/javascript'>alert('$msg');</script>";
	}
}



/*
	 $branchid = $_GET['location_ID'];
	 $sql = "DELETE FROM branch WHERE location_ID IN
				(SELECT location_ID
				 FROM location
				 WHERE location_ID = '$branchid')";


	$branchid = $_GET['branch_ID'];
	$sql = "DELETE FROM branch WHERE branch_ID = '$branchid'";
*/

/*
<!--error-->
	$locationid = $_GET['location_ID'];

	$sql = "DELETE FROM location l
	INNER JOIN branch b ON l.location_ID = b.location_ID
	WHERE b.location_ID = '$locationid'";

	$query = mysqli_query($conn,$sql);

	if ($query)
	{	 	
		$msg = "Branch is successfully deleted";
	    echo "<script type='text/javascript'>alert('$msg');</script>";

	    header("Location: index_branch.php");
	}
	else
	{
		$msg = "Something went wrong. Please try again";
        echo "<script type='text/javascript'>alert('$msg');</script>";
	}
*/
	
/*
<!--error-->
	$branchid = $_GET['branch_ID'];
	$locationid = $_GET['location_ID'];

	$sql = "DELETE FROM branch WHERE location_ID = '$locationid'";
	$query = mysqli_query($conn,$sql);

	if ($query)
	{	 	
	 	$sql2 = "DELETE FROM location WHERE location_ID = '$location_ID'";
		$result = mysqli_query($conn, $sql2);

		if ($result)
		{
			$msg = "Branch is successfully deleted";
	        echo "<script type='text/javascript'>alert('$msg');</script>";

	        header("Location: index_branch.php");
		}
		else
		{
			$msg = "Something went wrong. Please try again";
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	}
*/
?>