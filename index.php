<!DOCTYPE html>
<html>
<head>
	<title> Status Report Manager </title>
	

</head>
<body>
	
<h1> Welcome to the Status Report Manager </h1>

<p> If this is the first time using the application then click the following button to set up the database:</p>
<form action="index.php" method="GET">
	<button type="submit" name="setup-db"> Setup Database </button> 
</form>
<br>

<?php
//DATABASE CONNECTION AND SETUP 
	include 'db-connection.php';

	?>

<br>
<h1>Application Informaton</h1>
<!-- For the TAs/Course Instructor -->
<h3>Course Instructor/Teaching Assistants</h3>
<p> The following link will be used by the <u>Course Instructor</u> and <u>Teaching Assistants</u> of the MSCI 342 Principles of Software Engineering course 
	to upload teams, view inputted status reports, grade/comment on status reports, and download the reports:
<a href="TAHomepage.php">Visit the TA Homepage</a>
</p>

<!-- For the Students -->

<h3>Students</h3>
<p> The following link will be used by the <u>students</u> of the MSCI 342 Principles of Software Engineering course 
	to enter and view their weekly status reports:
<a href="StudentHomepage.php">Visit the Student Homepage</a>
</p>



</body>
</html>

