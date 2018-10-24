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
				<h1 id="MsciTitle"> MSCI342 Status Reports </h1> 

			<table id="TeamTable">
<?php  
		for ($i=1; $i <= 10; $i++) { 
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
		$todoAppMySQLConnection->close();	
?> 
			</table>
      
	        </center>
			</div>
		</body>
	</html>
