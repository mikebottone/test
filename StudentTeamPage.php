<<?php 
include 'db-connection.php';
 ?>
<html>
<head>
	<title>Team <?php echo $_POST['teamNum']; ?> Status Reports </title>
	<link rel="stylesheet" href="stylesheets/default.css">
	 <style type="text/css">
	 	h2{
	 		display: block;
    	font-size: 1.5em;
    	margin-block-start: 7px;
    	margin-block-end: 2px;
    	margin-inline-start: 0px;
    	margin-inline-end: 0px;
    	font-weight: bold;
	 	}
	 	p{
	 		background-color: lightgrey;
    	padding: 2 5 2 5;
    	border-radius: 12px;
	 	}
	 	
		
  	</style>
</head>
<body>
<div class="default">
			<a href="StudentHomepage.php"> Back </a>

			<center>
				<h1>
					Team <?php echo $_POST['teamNum']; ?> Status Reports 
				</h1> 
			</center>
			
<?php 
$teamNum = $_POST['teamNum'];
$sql = "SELECT
			    `reports`.`Name`,
			    `reports`.`Week`,
			    `reports`.`Status`,
			    `reports`.`Blockers`,
			    `reports`.`time`,
			    `studentinfo`.`TeamNum`
			FROM `reports` , `studentinfo`
			Where  `reports`.`s_id` = `studentinfo`.`s_id` and `TeamNum` = ?
			ORDER BY `reports`.`time` DESC;";

						$stmt = $todoAppMySQLConnection->prepare($sql);
						$stmt->bind_param('i', $teamNum);
						$stmt->execute();
						$stmt->bind_result($Name, $Week, $Status, $Blockers, $time, $Team);
						
					$count = 0;	//see number of entries pulled from DB
					while($stmt->fetch()){
						//border around each team members entry
					echo "<div style=\"border: solid; 
						border-radius: 6px; padding: 3 3 3 3;\">"; 

						echo "<strong> Week Ending: </strong> "; 
						printf ('%s', $Week);	//display week ending info
						echo "<br><strong> Time Submitted: </strong> "; 
						printf ('%s', $time);	//display time of submission
						echo "<br><strong> Name: </strong> ";
						printf ('%s', $Name);	//display name
						
						//Status 
						echo"<div> 
									<div>
									<h2>Status:</h2>
									<p>";
									printf ("%s",$Status); //status data
							  echo "</p></div>"; 
							 
							  //Blockers
							  echo "<div> 
									<h2>Blockers:</h2>
									<p>";	
									printf ("%s",$Blockers); //blocker data
								 echo "</p></div>"; 
							 
						echo '</div><br>'; //end of stuedent
					echo "</div>";	//end team member division	
					$count++;
					}
				//notify user if there are no results	
			if ($count==0){	echo "There are no reports for this team.";}			
						$stmt->close();
						$todoAppMySQLConnection->close(); 
?>
			
		

</div>


</body>
</html>