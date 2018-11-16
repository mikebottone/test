<?php
if(!isset($_SESSION)){session_start();}
include 'settings.php';
$password = $ta_admin_password;
$error = "";
$pass = "";
$_SESSION["logged_in"]= False;
if(isset($_POST['submit_pass']) && $_POST['pass'])
{
 $pass=$_POST['pass'];
 if($pass==$password)
 {
  $_SESSION["logged_in"]=True;
  header('Location: TAHomepage.php');
 }
 else
 {
  $error="Incorrect Password";
  $_SESSION["logged_in"]=False;
 }
}

if(isset($_POST['page_logout']))
{
$_SESSION["logged_in"]=False;
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheets/password.css">
</head>
<body>
<div id="wrapper">

<?php
if($_SESSION["logged_in"]==True)
{
 ?>
 <form method="post" action="" id="logout_form">
  <input type="submit" name="page_logout" value="LOGOUT">
 </form>
 <?php
}
else
{
 ?>

 <form method="post" action="" id="login_form">
  <h1>LOGIN TO PROCEED</h1>
  <input type="password" name="pass" placeholder="Enter Password">
  <input type="submit" name="submit_pass" value="Login">
  <p><font style="color:red;"><?php echo $error;?></font></p>
 </form>

 <?php
}
?>

</div>
</body>	
</html>
