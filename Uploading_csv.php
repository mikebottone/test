<?php
$user = 'root';
$password = 'root';
$db = 'sinfo';
$host = 'localhost';
$port = 3308;

//$link = mysqli_init();
$todoAppMySQLConnection = new mysqli($host, $user, $password, $db, $port);

$possibleLocalhosts = array('127.0.0.1', "::1");

if(in_array($_SERVER['REMOTE_ADDR'], $possibleLocalhosts)) // If our REMOTE_ADDR is a localhost, do this:
{ 
  // Open a connection with our local database
  $todoAppMySQLConnection = new mysqli($host, $user, $password, $db, $port);

 
 
} 
else // If our REMOTE_ADDR wasn't a localhost, we must be working remotely.
{ 
  // Parse our $databaseConnectURL so that we can pull out the key's we neeed
  $parsedDatabaseConnectUrl = parse_url($databaseConnectURL);
  $remote_host = $parsedDatabaseConnectUrl["host"];
  $remote_username = $parsedDatabaseConnectUrl["user"];
  $remote_password = $parsedDatabaseConnectUrl["pass"];
  $remote_databaseName = substr($parsedDatabaseConnectUrl["path"], 1);

  // Open a connection with our remote database
  $todoAppMySQLConnection = mysqli_real_connect($remote_host, $remote_username, $remote_password, $remote_databaseName);
  //notifies where connection made or not
    if ($todoAppMySQLConnection->connect_errno) 
    {
    echo 'Failed to connect to MySQL: (' . $todoAppMySQLConnection->connect_errno . ') ' . $todoAppMySQLConnection->connect_error;
    }
    
    //echo '<p>' . $todoAppMySQLConnection->host_info . '</p>';
   
} 
//mysqli_select_db($todoAppMySQLConnection, "sinfo") or die ("no database");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
                $Name = $data[0];
                $s_id = $data[1];
                $TeamNum = $data[2];
                $Email = $data[3];
                $query = "INSERT into studentinfo (Name, s_id, TeamNum, Email) values('$Name','$s_id','$TeamNum', '$Email')";
                mysqli_query($todoAppMySQLConnection, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
?> 
<html>
<body> 
<form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
 </body>  
</html>