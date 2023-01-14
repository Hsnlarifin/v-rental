<?php 
include 'db_conn.php';

if(isset($_GET['deleteid'])){
	$brand_ID=$_GET['deleteid'];

	$sql="delete from brand where brand_ID=$brand_ID";
	$result=mysqli_query($conn,$sql);
	if($result){
		// //echo"Deleted successfully";
		// header('location:brand-listing.php');
		echo "<script>alert('Brand deleted successfully!');</script>";
	    echo"<meta http-equiv='refresh' content='0; url=brand-listing.php'/>";

	}else{
		die(mysqli_error($conn));
	}
}

?>