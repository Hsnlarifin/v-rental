<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['adminid'])==0)
{
	header('location: index.php');
}
else
{
/*---NESTED QUERY---*/

    $staff_id = $_GET['staff_ID'];
	 
    $sql = "DELETE FROM user
            WHERE user_ID IN (SELECT user_ID 
                            FROM staff 
                            WHERE staff_ID = '$staff_id')";

    $query = mysqli_query($conn,$sql);
    if ($query)
    {	 	
        echo "<script>alert('Data is successfully deleted!');</script>"; 
        echo "<script>window.location.href = 'manage-staff.php'</script>";
    }
    else
    {
        echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
    }
}
?>