<div class="container">
	  <tbody>
		<?php
	  	include('../includes/config.php');
/*---STORED PROCEDURE---*/
	  		$query = "CALL GetTotalStaff(@total)";
	  		$conn->query($query);
	  		$result = $conn->query( "SELECT @total;");
	  		$row = $result->fetch_assoc();
	  			 echo $row['@total']?>
	  </tbody>
	</table>
</div>