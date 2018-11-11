<?php
include 'db-connection.php';
include 'settings.php';
if(!isset($_SESSION)){session_start();}
if($_SESSION["logged_in"]==False){
	require('access.php');
}
else{
	if(!isset($_SESSION)){session_start();}
	if($_SESSION["logged_in"]==True)
	{
	 ?>
	 <link rel="stylesheet" type="text/css" href="stylesheets/password.css">
	 <form method="post" action="" id="logout_form">
	  <input type="submit" name="page_logout" value="LOGOUT">
	 </form>
	 <?php
	}
	if(isset($_POST['page_logout']))
	{
	$_SESSION["logged_in"]=False;
	header("Location: access.php"); // return to login screen
	}
	?>
			 <html>
				<head>
					<title>TA Homepage</title>
			    <link rel="stylesheet" href="stylesheets/default.css">
				</head>

				<body>

					<div class="default">
						<div> <a href="Uploading_csv.php"> Upload CSV File </a>
					<br>
					<form method="POST" action="DownloadCSV.php">
					<button type="submit" name="export"> Download All Reports </button>
					</form>

					</div>

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
						//displays a button for the number of teams uploaded in the CSV
						for ($i=1; $i <= $NumOfTeams; $i++) {
							echo"<tr>
							<td id=\"Teamtxt\">Team " . $i ."</td>
				    		<td>
				    			<form action=\"TATeamPage.php\" method=\"POST\">
				    				<button type=\"submit\" value=\"". $i ."\" name=\"teamNum\">
				    				View Status Reports
				    				</button>
				    			</form>
				    		</td>
				    		</tr>
				    		";

						}
				}
				else {Echo"There are currently no teams uploaded. Please upload a CSV."; }
				$todoAppMySQLConnection->close();
		?>
					</table>

			        </center>
					</div>
				</body>
			</html>
<?php
}
?>
