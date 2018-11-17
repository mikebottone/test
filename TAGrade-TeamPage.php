<?php 
include 'db-connection.php';
session_start(); //start session to pass in the team number

 ?>
<html>
<head>
	<title>Team <?php echo $_SESSION['teamNum']; ?> Status Reports </title>
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
	 	#topright {
			 float:right;
		 }
		
  	</style>
</head>
<body>
<div class="default">

			<a href="TAHomepage.php"> Back </a>
					
			<center>
				<h1>
					Team <?php echo $_SESSION["teamNum"]; ?> Status Reports 
				</h1> 
			</center>
		
		
<?php 
$teamNum = $_SESSION["teamNum"];

			$sql = "SELECT
			    `reports`.`s_id`,
			    `reports`.`Name`,
			    `reports`.`Week`,
			    `reports`.`Status`,
			    `reports`.`Blockers`,
			    `reports`.`Team Health`,
			    `reports`.`Concerns`,
			    `reports`.`time`,
			    `studentinfo`.`TeamNum`
			FROM `reports` , `studentinfo`
			Where  `reports`.`s_id` = `studentinfo`.`s_id` and `TeamNum` = ?
			ORDER BY `reports`.`time` DESC;";

						$stmt = $todoAppMySQLConnection->prepare($sql);
						$stmt->bind_param('i', $teamNum);
						$stmt->execute();
						$stmt->bind_result($sID, $Name, $Week, $Status, $Blockers, $Health, $Concerns, $time, $Team);
						
					$count = 0;	//see number of entries pulled from DB
					while($stmt->fetch()){
						//border around each team members entry
						echo "<div style=\"border: solid; 
						border-radius: 6px; padding: 3 3 3 3;\">"; 
						
						//add a grade field input field
						

								

						echo "<strong> Date: </strong>";
						printf ('%s', $Week);	//display week ending info
						echo "<br><strong> Time Submitted: </strong> ";
						printf ('%s', $time);	//display time submitted

						//comments input for TA
						/*
						//first option: 
						echo "<div id=\"topright\">
						Comments:<input type=\"text\" name=\"comments\" size=30 >
						</div>";
						*/

						
						//second option:
						echo "<div id=\"topright\">
								Comments: <textarea name=\"comments\" rows=\"4\" cols=\"30\"></textarea>
							</div>";						

						echo "<br><strong> ID: </strong> "; 
						printf ('%s', $sID);	//display sercret id
						echo "<br><strong> Name: </strong> ";
						printf ('%s', $Name);	//display name
						echo "<br><strong> Team Health Rating: </strong> ";
						printf ('%s', $Health);	//display team health rating 

								//Status
								echo"<div> 
												<div>
												<h2>Status</h2>
												<p>";
												printf ("%s",$Status); //status data
										  echo "</p></div>"; 
										 
										  //Blockers
										  echo "<div> 
												<h2>Blockers</h2>
												<p>";	
												printf ("%s",$Blockers); //blocker data
											 echo "</p></div>"; 
										 
										 //Concerns
										  echo "<div> 
												<h2>Concerns</h2>
												<p>";	
												printf ("%s",$Concerns); //blocker data
											 echo "</p></div>"; 
								 echo '</div><br>'; //end row of 3 columns
						echo "</div>";	//end team member division	
					$count++;
					}

           				//notify user if there are no results	
			if ($count==0){	echo "There are no reports for this team.";}			
						$stmt->close();
						$todoAppMySQLConnection->close(); 
?>
			<button type="button" name="Save">Save and Submit</button> 


</div>


</body>
</html>