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
	echo '<h1>Database Configurations</h1>';
	echo '<form method="GET" action="?setup-db">';
	echo '<p>Are you sure you want to erase your current remote database and reconfigure it with a fresh schema?</br></p>';
	echo '<input name="execute-db-setup" type="submit" value="Yes">' . '</form>';
}

if (isset($_GET['execute-db-setup'])) // Only enter this if our URL contains a "setup-db" parameter
{	
	echo '<h1>Database Configurations</h1>';
	// STEP A - CREATE TASKS TABLE IN DATABASE
	$sqlCreateTableStatement = "
		CREATE TABLE IF NOT EXISTS `reports`(
 		 `s_id` varchar(11) NOT NULL,
 		 `Name` VARCHAR(45) NULL DEFAULT NULL,
 		 `Status` MEDIUMTEXT NULL DEFAULT NULL,
 		 `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  		`Time Log` INT(11) NULL DEFAULT NULL,
 		 `Team Health` VARCHAR(45) NULL DEFAULT NULL,
 		 `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
 		 PRIMARY KEY (`s_id`)
	);";
	if (mysqli_query($todoAppMySQLConnection, $sqlCreateTableStatement))
	{
		echo '</br>StepA: Successfully configured database.</br>';
	} 
	else 
	{
		echo '</br>StepA: Looks like there was an error :(</br>';
		echo '</br>' . mysqli_error($todoAppMySQLConnection);
	}

	// STEP B - ADD SAMPLE TASKS TO TABLE (that was created by step a)
	$sqlPopulateTableStatement = "
			INSERT INTO `reports`
			(`s_id`,
			`Name`,
			`Status`,
			`Blockers`,
			`Time Log`,
			`Team Health`,
			`Concerns`)
			VALUES
			('abcd1234',
			'jimmy smith',
			'I created the DB and did some refreshing on php',
			'Didn\'t know how to update clearDB',
			9,
			'happy',
			'none');
			";

	if (mysqli_query($todoAppMySQLConnection, $sqlPopulateTableStatement))
	{
		echo '</br>Step B: Successfully added sample tasks to task table in database.</br>';
	} 
	else 
	{
		echo '</br>Step B: Looks like there was an error :(</br>';
		echo '</br>' . mysqli_error($todoAppMySQLConnection);
	}
}
?>