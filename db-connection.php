<?php

//======================================================================
// DATABASE CONFIGURATIONS
//======================================================================

// Local Database Connection Details (in this example, the developer is using a
// ClearDB mysql database that is different than the deployment DB.  You can
// simply use your own MySql DB on your computer.
$local_host = "localhost";
$local_username = "root";
$local_password = "root";
$local_databaseName = "mydb";

// Production Database Connection Details:
//$databaseConnectURL = "mysql://bf8cfe944478ec:c196a6fa@us-cdbr-iron-east-01.cleardb.net/heroku_e37e59d4fdca5ad?setup-db=true&reconnect=true";
// CLEARDB_DATABASE_URL needs to be set in Heroku.  
$databaseConnectURL = getenv("CLEARDB_DATABASE_URL");




//======================================================================
// DATABASE CONNECTION
//======================================================================

$possibleLocalhosts = array('127.0.0.1', "::1");

if(in_array($_SERVER['REMOTE_ADDR'], $possibleLocalhosts)) // If our REMOTE_ADDR is a localhost, do this:
{
	// Open a connection with our local database
	$todoAppMySQLConnection = mysqli_connect($local_host, $local_username, $local_password, $local_databaseName);

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
	$todoAppMySQLConnection = mysqli_connect($remote_host, $remote_username, $remote_password, $remote_databaseName);


		//notifies where connection made or not
		if ($todoAppMySQLConnection->connect_errno) 
		{
		echo 'Failed to connect to MySQL: (' . $todoAppMySQLConnection->connect_errno . ') ' . $todoAppMySQLConnection->connect_error;
		}
		
		//echo '<p>' . $todoAppMySQLConnection->host_info . '</p>';
	 
}




//======================================================================
// FRESH DEPLOY DATABASE SETUP WIZARD
//======================================================================

if (isset($_GET['setup-db'])) // Only enter this if our URL contains a "setup-db" parameter
{	
	echo "<div style=\"border: solid;
						border-radius: 6px; padding: 3 3 3 3;\">";

	echo '<h1>Database Configurations</h1>';
	echo '<form method="GET" action="?setup-db">';
	echo '<p>Are you sure you want to configure your database with a fresh schema?</br></p>';
	echo '<input name="execute-db-setup" type="submit" value="Yes">' . '</form>';

	echo "<br></div>";
}

if (isset($_GET['execute-db-setup'])) // Only enter this if our URL contains a "setup-db" parameter
{	echo "<div style=\"border: solid;
						border-radius: 6px; padding: 3 3 3 3;\">";

	echo '<h1>Database Configurations</h1>';


	// STEP A - CREATE REPORTS TABLE IN DATABASE
	$sqlCreateTableStatement = "
		CREATE TABLE `reports` (
			  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
			  `s_id` varchar(8) NOT NULL,
			  `Name` varchar(45) DEFAULT NULL,
			  `Week` varchar(100) DEFAULT NULL,
			  `Status` mediumtext,
			  `Blockers` mediumtext,
			  `Team Health` varchar(45) DEFAULT NULL,
			  `Concerns` mediumtext,
			  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `Label` varchar(100) DEFAULT NULL,
			  `Grade` INT(3) DEFAULT NULL,
			  `Comments` varchar(200) DEFAULT NULL,
			  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

	if (mysqli_query($todoAppMySQLConnection, $sqlCreateTableStatement))
	{
		echo 'StepA: Successfully added Reports table into the database.</br>';
	} 
	else 
	{
		echo '</br>StepA: Looks like there was an error. </br>';
		echo mysqli_error($todoAppMySQLConnection) . "<br>";
	}

	// STEP B - CREATES STUDENTINFO TABLE IN DATABASE
	$sqlCreateTable2Statement = "
			CREATE TABLE `studentinfo` (
		 	 	`Name` varchar(255) DEFAULT NULL,
		  		`s_id` varchar(255) NOT NULL,
		  		`TeamNum` int(11) DEFAULT NULL,
		  		`Email` varchar(255) NOT NULL,
		  		PRIMARY KEY (`s_id`)
			);";

	if (mysqli_query($todoAppMySQLConnection, $sqlCreateTable2Statement))
	{
		echo '</br>Step B: Successfully added StudentInfo table into the database.</br>';
	} 
	else 
	{
		echo '<br>Step B: Looks like there was an error. </br>';
		echo  mysqli_error($todoAppMySQLConnection);
	}
	echo "</div>";
}
?>
