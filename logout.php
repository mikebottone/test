<html>
<head>
</head>
<body>
<div id="wrapper">

<?php
if(!isset($_SESSION)){session_start();}
if($_SESSION["logged_in"]==True)
{
 ?>
 <form method="post" action="" id="logout_form">
  <input type="submit" name="page_logout" value="LOGOUT">
 </form>
 <?php
}
if(isset($_POST['page_logout']))
{
$_SESSION["logged_in"]=False;
}
?>

</div>
</body>
</html>
