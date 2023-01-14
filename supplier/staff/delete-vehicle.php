<?php 
include 'db_conn.php';

if(isset($_GET['deleteid'])){
	$veh_ID=$_GET['deleteid'];

	$sql="delete from vehicle where veh_ID=$veh_ID";
	$result=mysqli_query($conn,$sql);
	if($result){
		
		echo "<script>alert('Vehicle deleted successfully!');</script>";
	    echo"<meta http-equiv='refresh' content='0; url=car-list.php'/>";

	}else{
		die(mysqli_error($conn));
	}
}

?>