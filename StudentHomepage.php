<?php
include 'db-connection.php';
?>
	 <html>
		<head>
			<title>Student Homepage</title>
	    <link rel="stylesheet" href="stylesheets/default.css">
	   	</head>
		
		<body>
		<div class="default" id="Teamtxt">
		<div> <a href="StatusReportInput.php"> New Status Report </a></div>
			<center>
				<h1 id="MsciTitle"> MSCI 342 Status Reports </h1> 

			<table id="TeamTable">
<?php  
	
	//selects the max team number indicating the number of teams created
	$sql = "SELECT max(TeamNum) FROM studentinfo;";

		$stmt = $todoAppMySQLConnection->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($NumOfTeams);
		$stmt->fetch();	//gets the number returned from the query & binds it to the variable $NumOfTeams

		//checks if $NumOfTeams is greater than 0 indicating whether or not a csv has been uploaded
		if ($NumOfTeams > 0){
				//displays a buttons for the number of teams uploaded in the CSV
				for ($i=1; $i <= $NumOfTeams; $i++) { 
					echo"<tr>
					<td id=\"Teamtxt\">Team " . $i ."</td>
		    		<td> 
		    			<form action=\"StudentTeamPage.php\" method=\"POST\"> 
		    				<button type=\"submit\" value=\"". $i ."\" name=\"teamNum\"> 
		    				View Status Reports
		    				</button> 
		    			</form>
		    		</td>
		    		</tr>
		    		"; 
		    		
				}
		}
		Else {Echo"There are currently no teams created. Teams will be uploaded by the Course Instructor."; }
		
		$todoAppMySQLConnection->close();	
?> 
			</table>
      
	        </center>
			</div>
		</body>
	</html>
