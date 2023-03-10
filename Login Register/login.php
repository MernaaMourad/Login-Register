<!DOCTYPE html>
<html lang = "en">
  <head>
        <meta charset="UTF-8">
       <title>Login Form</title>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  </head> 
  

  <body>
  <script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["email"].value;
    var b = document.forms["Form"]["password"].value;
    
    if (a == null || a == "", b == null || b == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>


  </div>

<div>
<form name="Form" action="" method="post" onsubmit="return validateForm()">
  <div class="container">
    <div class="row">
        <div class="col-sm-3">
    <h1>Login</h1>
    <p>Please enter your data..</p>
    <hr>
 
 
    <label for="email"><b>Email</b></label>
    <input class="form-control" type="email" placeholder="Enter Email" name="email" id="email" >

    <label for="password"><b>Password</b></label>
    <input class="form-control" type="password" placeholder="Enter Password" name="password" id="password" >


    <hr>

    <p></p>
    <input class="btn btn-primary" type="submit" name="create" value="Login">
       </div>
  </div>
 </div>
   <div class="container registration">
    <p>You do not have an account? <a href="registration.php">register here</a>.</p>
   </div>
</form> 
</div>
 <?php

 if(isset($_POST['create']))
{

session_start();
   $db = mysqli_connect('localhost', 'root', '', 'registration');

// Check db connection

if($db === false){
  echo 'There were errors saving the data';
    die("Error: connection error. " . mysqli_connect_error());}


 $email=$_POST['email'];
 $password=$_POST['password'];
 if($email!=''&&$password!='')
 {

$query = "SELECT * FROM user WHERE email='$email' ";


$result = mysqli_query($db, $query);
$row = $result->fetch_array();
$db_pass = $row['password'];
$hashed_pass = crypt($password, $db_pass);
if($result->num_rows > 0)
    {   
       if($hashed_pass == $db_pass || $password == $db_pass )
        {
         $username = $row['name'];
         $_SESSION['username']=$username;
         header('location: welcome.php');
         exit;
        }
           
      else
        {
         echo '<script language="javascript">'; 
         echo 'alert("email or password is incorrect !")';
         echo '</script>';
         exit;
         header('location: login.php');
        }
      }

else
    {
      echo '<script language="javascript">'; 
      echo 'alert("No users with such login found in the database!")';
      echo '</script>';
      exit;
      header('location: login.php');
     }
 }


}
?>
 </body>
 </html>


