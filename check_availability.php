<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["username"])) {
	$username= $_POST["username"];
	if (filter_var($username, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : Please use email as Username.";
	}
	else {
		$sql ="SELECT cust_Username FROM customer WHERE cust_Username=:username";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> 	Username already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Username available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}


?>
