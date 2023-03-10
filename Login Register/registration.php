<!DOCTYPE html>
<html lang = "en">
  <head>
        <meta charset="UTF-8">
       <title>Register Form</title>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  </head>
 
  <body>
  
<script type="text/javascript">  
function validateForm() {
  var messages = [];
    var username = document.forms["Form"]["username"].value;
    if (username == ""||username == null) {
        messages.push("Name must be filled out");
    }

    var email = document.forms["Form"]["email"].value;
    if (email == "" ||email == null) {
        messages.push("email must be filled out");
    }
        var password1 = document.forms["Form"]["password"].value;
    if (password1 == ""||password1 == null) {
       messages.push("password must be filled out");
    }

    var password2= document.forms["Form"]["confirm_password"].value;
    if (password2== ""||password2 == null) {
       messages.push("please confirm password");
    }

    if (messages.length > 0) {
        alert(messages.join("\n"));
        return false;
    }

    if(password1 != password2)  //match password
  {   
    alert("Passwords did not match"); 
    return false; 
  } 
  if (password1.length<8 || password1.length>15 ){ //check password length
    alert("Passwords must be at least 8 characters and must not exceed 15 characters"); 
    return false; 
  }


}
 
 

</script>  



<div>
<form name="Form" action="" method="post" onsubmit="return validateForm()">
  <div class="container">
    <div class="row">
        <div class="col-sm-3">
    <h1>Registration</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
 
    <label for="username"><b>Username</b></label>
    <input class="form-control" type="text" placeholder="Enter Username" name="username" pattern="[a-zA-Z0-9]+" >

    <label for="email"><b>Email</b></label>
    <input class="form-control" type="email" placeholder="Enter Email" name="email" id="email" >

    <label for="password"><b>Password</b></label>
    <input class="form-control" type="password" placeholder="Enter Password" name="password" id="password" >

    <label for="confirm_password"><b>Repeat Password</b></label>
    <input class="form-control" type="password" placeholder="Repeat Password" name="confirm_password" id="confirm_password" >
    <hr>

    <p>By creating an account you agree to our Terms & Privacy.</p>
    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
</div>
  </div>
      </div>
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Log in here</a>.</p>
  </div>
</form> 
</div>
<?php

/* connect to MySQL database */

if (isset($_POST['create']))
{
  session_start();
  $db = mysqli_connect('localhost', 'root', '', 'registration');

// Check db connection

if($db === false){
  echo 'There were errors saving the data';
    die("Error: connection error. " . mysqli_connect_error());
}



        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        

$query = "SELECT * FROM user WHERE (email='$email')";
$res=mysqli_query($db, $query);
if(mysqli_num_rows($res)>0){ //if email is already present in database

echo '<script language="javascript">';
echo 'alert("The email address is already registered!")';
echo '</script>';
exit;
header('location: registration.php'); 
  

}else if(mysqli_num_rows($res)==0){
    $sql = "INSERT INTO user (name, password, email) VALUES ('$username','$password_hash','$email')";

// insert in database 
$rs = mysqli_query($db, $sql);

if($rs)
{
    $_SESSION['username']=$username;

    header('location: welcome.php');
}
else{
  header('location: registration.php');
  echo '<script language="javascript">'; 
  echo 'alert("error!")'; 
  echo '</script>';
  exit;
   
}
}       
}       
?>

</body>
</html>
