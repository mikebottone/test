<?php 
include 'db-connection.php';

//value variables
$s_id = $name = $week = $status = $blockers = $health = $concerns = ""; 

//error variables
$s_id_err = $name_err = $week_err = $status_err = $blockers_err = "";
$health_err = $concerns_err = ""; 

//track how mant fields are not filled in
$err_count = 7;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
 //ensure secret code is entered
	 if(empty(trim($_POST["s_id"]))){
        $s_id_err = "Please fill in this field.";
    }
  	else{
  		//keeps value in box if other field has error
  		$s_id = trim($_POST["s_id"]);
  		$err_count = $err_count - 1;
  	}

//ensures name is entered
  	if(empty(trim($_POST["name"]))){
        $name_err = "Please fill in this field.";
    }
  	else{
  		$name = trim($_POST["name"]);
  		$err_count = $err_count - 1;
  	}

//ensure week is entered
	 if(empty(trim($_POST["week"]))){
        $week_err = "Please fill in this field.";
    }
  	else{
  		//keeps value in box if other field has error
  		$week = trim($_POST["week"]);
  		$err_count = $err_count - 1;
  	}	

//ensures status is entered
  	if(empty(trim($_POST["status"]))){
        $status_err = "Please fill in this field.";
    }
  	else{
  		$status = trim($_POST["status"]);
  		$err_count = $err_count - 1;
  	}	

//ensures blockers are entered
  	if(empty(trim($_POST["blockers"]))){
        $blockers_err = "Please fill in this field.";
    }
  	else{
  		$blockers = trim($_POST["blockers"]);
  		$err_count = $err_count - 1;
  	}	


//ensures team health is entered
  if(!isset($_POST['health'])){	
    $health_err = "Please fill in this field.";
    }
  	else{
  		$health = trim($_POST["health"]);
  		$err_count = $err_count - 1;
  	}	

//ensures concerns are entered
  	if(empty(trim($_POST["concerns"]))){
        $concerns_err = "Please fill in this field.";
    }
  	else{
  		$concerns = trim($_POST["concerns"]);
  		$err_count = $err_count - 1;
  	}

//enters when all 7 fields have been filled in
	if ($err_count==0){

		//need to input into db here

		// Prepare a select statement
       $sql = "SELECT s_id FROM `studentinfo` WHERE s_id = ?";
        
        $stmt = $todoAppMySQLConnection->prepare($sql);
            // Bind variables to the prepared statement as parameters
             $stmt->bind_param('s', $s_id);
            
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);
                // Store result
             mysqli_stmt_store_result($stmt);
                 
             // Check if s_id does not exist, if it does not exist then error message
                if(mysqli_stmt_num_rows($stmt) == 0){ 
                  $stmt->close();
                  echo "<script type='text/javascript'>alert('The secret code entered is not valid. Please enter your valid code.');</script>";  
                        $s_id_err = "Please enter a valid secret code.";        
                 }
                 else{
                 $stmt->close(); 
                 //inserts new entry given all fields have been filled in and user id has not been used before
                 $sql = "INSERT INTO `reports`
					(`s_id`,
					`Name`,
					`Week`,
					`Status`,
					`Blockers`,
					`Team Health`,
					`Concerns`)
					VALUES
					(?,?,?,?,?,?,?);";

				$stmt = $todoAppMySQLConnection->prepare($sql);
				 $stmt->bind_param('sssssss', $sID, $Name, $Week, $Status, $Blockers, $Health, $Concerns);

				$sID=$s_id;
				$Name = $name;
				$Week = $week;
				$Status = $status;
				$Blockers = $blockers;
				$Health = $health;
				$Concerns = $concerns;

				$stmt->execute();
				$stmt->close();

				echo "<script type='text/javascript'>alert('Report successfully inputted!');</script>";
				//clears all fields
				$s_id = $name = $week = $status = $blockers = $health = $concerns = "";
				

                 
    			}        
	}
}	    
 ?>

<html>
<head>
	<title>Status Report Form</title>
	 <link rel="stylesheet" href="stylesheets/default.css">
	 <style type="text/css">
	 div{
	 	padding-bottom: 6px;
	 	border-bottom: solid;
	 }
	 .topRight{
	 	 Float: right;
    	border-bottom: none;
    }
	 </style>
</head>
<body class="default">
			<div class="topRight"><a href="StudentHomepage.php"> Homepage </a></div>
<!-- Title Div  -->
	<div>
	<h1> MSCI 342 Team Status Report </h1>
	<p>Use this form to submit your status report.  Detailed instructions and marking rubric are on Learn.</p> 
	</div>
<form action="StatusReportInput.php" method="POST">
 <!-- Q1 secret code  -->
	<div>
	<h3>Secret Code</h3>
	<p>Enter your secret code received from the TA.</p>
	<input type="text" name="s_id" maxlength="8" value="<?php echo $s_id; ?>">
	 <span class="help-block"><?php echo $s_id_err; ?></span>
	</div>

<!-- Q2 Name  -->
	<div>
	<h3>Name</h3>
	<p>Enter your given and family name.</p>
	<input type="text" name="name" value="<?php echo $name; ?>">
	 <span class="help-block"><?php echo $name_err; ?></span>
	</div>

<!-- Q3 Week  -->
	<div>
	<h3>Week</h3>
	<p>Enter the week ending date. (Ex. September 5, 2018) </p>
	<input type="text" size="30" name="week" value="<?php echo $week; ?>">
	 <span class="help-block"><?php echo $week_err; ?></span>
	</div>	

<!-- Q4 Status  -->
	<div>
	<h3>Status</h3>
	<p>Enter all your tasks that are currently in-progress or that you have finished during this week for MSCI 342. Specify whether the task has been completed or is still in progress. </p>
	<textarea name="status" style = "width:100%; height: 150px"> <?php echo $status; ?></textarea>
	 <span class="help-block"><?php echo $status_err; ?></span>
	</div>

<!-- Q5 Blockers  -->
	<div>
	<h3>Blockers</h3>
	<p>Enter any blocking issues you are facing. If there are no blocking issues, enter "None".</p>
	<textarea name="blockers" style="width: 100% ; height:50px;"> <?php echo $blockers; ?> </textarea>
	 <span class="help-block"><?php echo $blockers_err; ?></span>
	</div>

<!-- Q6 Team Health  -->
	<div>
	<h3>Team Health</h3>
	<p>Rate how you feel about the team progress and team dynamic.</p><p><strong>Note: </strong>This information is confidential and will only be seen by the Instructor and TA.</p>
	<center>
	<table style="width:100%" cellpadding = "10" id="StatusFormTable" >
	<th><img src="images/VeryUnhappy.png" height="60" width="60"></th>
	<th><img src="images/Unhappy.png" height="60" width="60"></th>
	<th><img src="images/Neutral.png" height="60" width="60"></th>
	<th><img src="images/Happy.png" height="60" width="60"></th>
	<th><img src="images/VeryHappy.png" height="60" width="60"></th>	
	<tr>
	<td><input type="radio" name="health" value="Very Unhappy" <?php if ( "Very Unhappy" == $health) echo 'checked="checked"'; ?>></td> 
	<td><input type="radio" name="health" value="Unhappy" <?php if ( "Unhappy" == $health) echo 'checked="checked"'; ?>></td>
	<td><input type="radio" name="health" value="Neutral" <?php if ( "Neutral" == $health) echo 'checked="checked"'; ?>></td>
	<td><input type="radio" name="health" value="Happy" <?php if ( "Happy" == $health) echo 'checked="checked"'; ?>> </td>
	<td><input type="radio" name="health" value="Very Happy" <?php if ( "Very Happy" == $health) echo 'checked="checked"'; ?>></td>
	</tr>
	<tr>
	<td>Very Unhappy</td> 
	<td>Unhappy</td>
	<td>Neutral</td>
	<td>Happy</td>
	<td>Very Happy</td>
	<!-- {if ( "Unhappy" == $health) echo 'checked="checked"';} keeps value checked after submittal if other field is not inputted -->
	</tr>
	</table>
	</center>
	 <span class="help-block"><?php echo $health_err; ?></span>	
	</div>

<!-- Q7 Conerns  -->
	<div>
	<h3>Concerns</h3>
	<p>Enter any concerns regarding your group or the project. If you have no concerns, please enter "None".</p> <p><strong>Note: </strong>This information is confidential and will only be seen by the Instructor and TA.</p>
	<textarea name="concerns" style="width:100%; height:100px;"><?php echo $concerns; ?></textarea>
	 <span class="help-block"><?php echo $concerns_err; ?></span>
	</div>	
	<br>
<!-- submit button  -->	
<button type="submit" name="submit"> Submit </button> 	
</form>

<?php $todoAppMySQLConnection->close();  ?>
</body>
</html>
