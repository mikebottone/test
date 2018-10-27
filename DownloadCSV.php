<?php 
include 'db-connection.php';

if(isset($_POST["export"])){
	//specifies type of file and name
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reports.csv');

	//output stream with file pointer
	$output = fopen("php://output", "w");

	//headers in the csv file
	fputcsv($output, $arrayName = array('ID','s_id','Name','Status','Blockers','Time Log','Team Health','Concerns','time'));

	//selecting the data
	$query = "SELECT * FROM reports";

	//capture results
	$results = mysqli_query($todoAppMySQLConnection, $query);

	//insert the DB table into the CSV file
	while ($row = mysqli_fetch_assoc($results)) {
		fputcsv($output, $row);

	}
	fclose($output);
	$todoAppMySQLConnection->close();	

}


 ?>

