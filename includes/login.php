<?php

if(isset($_POST['login']))
{
$username=$_POST['username'];
//$password=md5($_POST['password']);
$password=($_POST['password']);
$sql ="SELECT cust_Username,cust_Pass,user_ID,cust_ID FROM customer WHERE cust_Username=:username AND cust_Pass=:password";

$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
//$results=$query->fetchAll(PDO::FETCH_OBJ);
//$_SESSION['customer'] = $results[0]->cust_ID;

if($query->rowCount() > 0)
{
$results=$query->fetchAll(PDO::FETCH_OBJ); 
$_SESSION['login']=$_POST['username'];
//$_SESSION['customer']= $results['cust_ID'];
//$_SESSION['customer']= htmlentities($result->cust_ID);
//$_SESSION['userid']=$results->user_ID;
$currentpage=$_SERVER['REQUEST_URI'];
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";
}

}

?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="username" placeholder="Username*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>New User? <a href="#signupform" data-toggle="modal" data-dismiss="modal"> Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
        <p><a href="admin/index.php">Administrator</a>  |  <a href="supplier/sindex.php">Supplier</a></p> 
      </div>
    </div>
  </div>
</div>
