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
    if(isset($_GET['veh_ID']))
    {
        $veh_ID=$_GET['veh_ID'];
        $sql="delete from vehicle where veh_ID=$veh_ID";
        $query = mysqli_query($conn,$sql);
        if ($query)
        {
            echo "<script>alert('Data is successfully deleted!');</script>"; 
            echo "<script>window.location.href = 'manage-vehicles.php'</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Something went wrong. Please try again');</script>";
        }
    }
}
?>