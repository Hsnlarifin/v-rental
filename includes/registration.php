<?php
//error_reporting(0);
if(isset($_POST['signup']))
{
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$phone=$_POST['phoneno'];
$username=$_POST['username']; 
//$password=$_POST['password']; 
$password=md5($_POST['password']);
$userid=mt_rand(30, 100);

$sql2="INSERT INTO customer (cust_Username,cust_Pass) VALUES(:username,:password)";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':username',$username,PDO::PARAM_STR);
$query2->bindParam(':password',$password,PDO::PARAM_STR);
//$query2->bindParam(':userid',$userid,PDO::PARAM_STR);
$query2->execute();

// $sql="INSERT INTO user (user_ID,f_name,l_name,phoneNo) VALUES(:userid,:firstname,:lastname,:phoneno)";
// $query = $dbh->prepare($sql);
// $query->bindParam(':firstname',$fname,PDO::PARAM_STR);
// $query->bindParam(':lastname',$lname,PDO::PARAM_STR);
// $query->bindParam(':phoneno',$phone,PDO::PARAM_STR);
// $query->bindParam(':userid',$userid,PDO::PARAM_STR);
// $query->execute();



// $stmt = $dbh->prepare("EXEC get_userid @user_ID = :userid OUT, @fname = :fname , @lname = :lname");
// $stmt->bindParam(':userid', $userid, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 10);
// $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
// $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
// $stmt->execute();
// $userid = $stmt->fetchColumn(0);




$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Registration successful. You can now login');</script>";
}
else 
{
  echo "<script>alert('Registration successful. You can now login');</script>";
//echo "<script>alert('Something went wrong. Please try again');</script>";

}
}
?>

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="firstname" placeholder="First Name" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="phoneno" placeholder="Phone Number" maxlength="11" required="required">
                </div>                     
                <div class="form-group">
                  <input type="email" class="form-control" name="username" id="username" onBlur="checkAvailability()" placeholder="Username" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>