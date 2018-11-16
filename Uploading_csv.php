<?php

include 'db-connection.php';
?>
<html>
<head>
      <title>Upload File</title>
       <link rel="stylesheet" href="stylesheets/default.css">
   <style type="text/css">
   .topRight{
     Float: right;
      border-bottom: none;
    }
   </style>
</head>
<body class="default">
        
        <form action="Uploading_csv.php" method="POST">
       <button type="submit" name="delete" align="right">Reset Project</button> 
       </form>
        <div class="topRight"> <a href="TAHomepage.php"> Back </a></div>
        <form method="post" enctype="multipart/form-data">
           <div align="center">  
            <label>Select CSV File:</label>
              
            <input type="file" name="file" />
            <br><br>
            <input type="submit" name="submit" value="Import" class="btn btn-info" />
    
                        

           </div>
          </form>
 </body>  
</html>

<?php

if(isset($_POST["delete"])){
  $sql = " DELETE FROM `studentinfo`";
  $sql2 = "DELETE FROM `reports`";
  $sql3 = "DELETE FROM  `Grades` ";

$stmt1 = $todoAppMySQLConnection->prepare($sql);
$stmt2= $todoAppMySQLConnection->prepare($sql2);
$stmt3= $todoAppMySQLConnection->prepare($sql3);

$stmt1->execute();
$stmt1->close();

$stmt2->execute();
$stmt2->close();

$stmt3->execute();
$stmt3->close();


}
//mysqli_select_db($todoAppMySQLConnection, "sinfo") or die ("no database");
if(isset($_POST["submit"]))
{
	$q = 'DELETE FROM studentinfo';
	mysqli_query($todoAppMySQLConnection, $q);
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
 $sqlget = "SELECT * FROM studentinfo";
$sqldata = mysqli_query($todoAppMySQLConnection, $sqlget) or die ('error getting data');
echo "<div align=\"center\">";
echo "<table>";
echo "<tr><th>Name</th><th><th>s_id</th></th><th>TeamNum</th><th>Email</th></tr>";
while($row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){
	echo "<tr><td>";
	echo $row ['Name'];
	echo "</td><td><td>";
	echo $row ['s_id'];
	echo "</td></td><td>";
	echo $row ['TeamNum'];
	echo "</td><td>";
	echo $row ['Email'];
	echo "</td></tr>";
}
echo "</table>";
echo"</div>";

?> 
