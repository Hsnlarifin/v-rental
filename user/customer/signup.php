<?php

session_start();

  include('../includes/config.php');

    if(isset($_POST['submit']))
    {
      //FROM TABLE LICENSE
	      $licensetype = $_POST['license_Type'];
	      $expiration  = $_POST['expiration'];

      //FROM TABLE USER
	      $fname = $_POST['f_Name'];
	      $lname  = $_POST['l_Name'];
	      $email = $_POST['email'];
        $gender = $_POST['gender'];

      //FROM TABLE CUSTOMER
	      $username = $_POST['cust_Username'];
	      $password = $_POST['cust_Pass'];

      $ret=mysqli_query($conn, "select email from user where email='$email'");
      $ret1=mysqli_query($conn, "select cust_Username from customer where cust_Username='$username'");
      if (mysqli_fetch_array($ret)>0)
      {
         echo "<script type='text/javascript'>alert('This email is already associated with another account');</script>";
        echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
      }
      elseif (mysqli_fetch_array($ret1)>0)
      {
        echo "<script type='text/javascript'>alert('This username is already been taken');</script>";
        echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
      }
      else
      {
          /*---NESTED QUERY INSERT---*/

      //INSERT INTO TABLE USER
        $sql = "INSERT INTO user (f_Name, l_Name, gender, age, email, phoneNo)
                    VALUES ('$fname', '$lname', '$gender', '', '$email', '')";

        $query = mysqli_query($conn,$sql);

        if($query)
        {

        //TO GET THE ID FROM PREVIOUS INSERT TABLE
          $user_id = mysqli_insert_id($conn);

        //INSERT INTO TABLE CUSTOMER
          $sql2 = "INSERT INTO customer (user_ID, cust_Username, cust_Pass, street, postcode, city, state)
                        VALUES ('$user_id', '$username', '$password', '', '', '', '')";

          $query2 = mysqli_query($conn,$sql2);

          if ($query2)
          {  

          //TO GET THE ID FROM PREVIOUS INSERT TABLE
            $cust_id = mysqli_insert_id($conn);

          //INSERT INTO TABLE LICENSE
            $sql3 = "INSERT INTO license (cust_ID, license_Type, expiration) VALUES ('$cust_id', '$licensetype', '$expiration')";

            $result = mysqli_query($conn,$sql3);

              if($result)
              {    
                $msg = "You have successfully register! Now you can login.";
                echo "<script type='text/javascript'>alert('$msg');</script>";
                echo "<script type='text/javascript'> document.location ='index.php'; </script>";
              }
              else
              {
                $msg = "Something went wrong. Please try again";
                echo "<script type='text/javascript'>alert('$msg');</script>";
              }
          }
          else
          {
            $msg = "Failed to register, please try again.";
             echo "<script type='text/javascript'>alert('$msg');</script>";
          }
        }
      }
    }
?>

<?php
  include('../includes/header.php');
?>
<head>
<script type="text/javascript">
function valid()
{
if(document.submit.cust_Pass.value!= document.submit.cust_CPass.value)
{
alert("The password does not match!");
document.submit.cust_CPass.focus();
return false;
}
return true;
}
</script>
</head>
<form method="POST" onSubmit="return valid();">&emsp;
  <h3>Sign Up</h3>
      
  <!--FIRST NAME-->
    <label for="text"><b>First Name</b></label>&emsp;
    <input type="text" name="f_Name" placeholder="Enter first name" required>&emsp;

   <!--LAST NAME-->
    <label for="text"><b>Last Name</b></label>&emsp;
    <input type="text" name="l_Name" placeholder="Enter last name" required><br><br>

    <label for="text">Gender:</label> &nbsp;
    <input type="radio" class="form-check-input" name="gender" id="male" value="Male">
    <label for="male" class="form-input-label">Male</label>
            &nbsp;
    <input type="radio" class="form-check-input" name="gender" id="female" value="Female">
    <label for="female" class="form-input-label">Female</label><br><br>

   <!--LICENSE TYPE-->
	  <label for="text"><b>License Type</b></label>&emsp;
	  <input type="text" name="license_Type" placeholder="e.g D / DA" required>&emsp;

   <!--EXPIRATION-->
    <label for="text"><b>Expiration</b></label>&emsp;
    <input type="date" name="expiration" required><br><br>

   <!--EMAIL-->
    <label for="text"><b>Email</b></label>&emsp;
    <input type="email" name="email" placeholder="Enter email address" required>&emsp;

   <!--USERNAME-->
    <label for="text"><b>Username</b></label>&emsp;
    <input type="username" name="cust_Username" placeholder="Enter username" required><br><br>

   <!--PASSWORD-->
    <label for="pass"><b>Password</b></label>&emsp;
    <input type="password" name="cust_Pass" placeholder="Enter password" required>&emsp;

   <!--PASSWORD-->
    <label for="pass"><b>Confirm password</b></label>&emsp;
    <input type="password" name="cust_CPass" placeholder="Re-enter password" required><br>


  <!--CHECKBOX REMEMBER ME-->
    <label>
      <br><input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

	<br><a href="cust_login.php">Already have an account? Login!</a>
  <!--BUTTON SUBMIT TO LOGIN-->
  <br><br> <!--Single line breaks-->
  <button type="submit" name="submit">Sign Up</button>
</form>