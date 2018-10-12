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
	 	.column {
    	float: left;
    	width: 33.33%;
    	    	
		}

		/* Clear floats after the columns */
		.row:after {
   			content: "";
    		display: table;
    		clear: both;
			}
  	</style>
</head>
<body>
<div class="default">
			<a href="TAHomepage.php"> Back </a>

			<center>
				<h1>
					Team <?php echo $_POST['teamNum']; ?> Status Reports 
				</h1> 
			</center>
			
<?php 
$teamNum = $_POST['teamNum'];
$sql = "SELECT `s_id`, `Name`,`Status`, `Blockers`,`Time Log`,
				`Team Health`, `Concerns`
	 	FROM `teams`
	 	Where TeamNum = ?";

						$stmt = $todoAppMySQLConnection->prepare($sql);
						$stmt->bind_param('i', $teamNum);
						$stmt->execute();
						$stmt->bind_result($sID, $Name, $Status, $Blockers, $Time, $Health, $Concerns);
						
					$count = 0;	//see number of entries pulled from DB
					while($stmt->fetch()){
						//border around each team members entry
						echo "<div style=\"border: solid; 
						border-radius: 6px; padding: 3 3 3 3;\">"; 

						echo "<strong> ID: </strong> "; 
						printf ('%s', $sID);
						echo "<br><strong> Name: </strong> ";
						printf ('%s', $Name);
						echo "<br><strong>Time Spent on Course: </strong> ";
						printf ('%d', $Time);
						echo "<br><strong> Team Health Rating: </strong> ";
						printf ('%s', $Health);

					//creates 3 equal width columns for Status, Blockers, and Concerns	
					echo"<div class=\"row\"> 
							<div class=\"column\">
							<h2>Status</h2>
							<p>";
							printf ("%s",$Status); //status data
					  echo "</p></div>"; //end column 1
					 
					  //start column 2
					  echo "<div class=\"column\"> 
							<h2>Blockers</h2>
							<p>";	
							printf ("%s",$Blockers); //blocker data
						 echo "</p></div>"; //end column 2
					 
					 //start column 3
					  echo "<div class=\"column\"> 
							<h2>Concerns</h2>
							<p>";	
							printf ("%s",$Concerns); //blocker data
						 echo "</p></div>"; //end column 2
					 echo '</div><br>'; //end row of 3 columns
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