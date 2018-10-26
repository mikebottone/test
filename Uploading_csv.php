<?php
include 'db-connection.php';

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
