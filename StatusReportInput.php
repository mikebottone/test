<?php 
include 'db-connection.php';

//value variables
$s_id = $name = $status = $blockers = $time= $health = $concerns = ""; 

//error variables
$s_id_err = $name_err = $status_err = $blockers_err = $time_err = "";
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

//ensures time log is entered
  	if(empty(trim($_POST["time"]))){
        $time_err = "Please fill in this field.";
    }
  	else{
  		$time = trim($_POST["time"]);
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
                 
             // Check if s_id exists, if yes then error message
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
					`Status`,
					`Blockers`,
					`Time Log`,
					`Team Health`,
					`Concerns`)
					VALUES
					(?,?,?,?,?,?,?);";

				$stmt = $todoAppMySQLConnection->prepare($sql);
				 $stmt->bind_param('ssssdss', $sID, $Name, $Status, $Blockers, $Time, $Health, $Concerns);

				$sID=$s_id;
				$Name = $name;
				$Status = $status;
				$Blockers = $blockers;
				$Time = $time;
				$Health = $health;
				$Concerns = $concerns;

				$stmt->execute();
				$stmt->close();

				echo "<script type='text/javascript'>alert('Report successfully inputted!');</script>";
				//clears all fields
				$s_id = $name = $status = $blockers = $time= $health = $concerns = "";
				

                 
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

<!-- Q3 Status  -->
	<div>
	<h3>Status</h3>
	<p>Enter all your tasks that are currently in-progress or that you have finished during this week for MSCI 342. Specify whether the task has been completed or is still in progress. </p>
	<textarea name="status" rows="10" cols="100" > <?php echo $status; ?></textarea>
	 <span class="help-block"><?php echo $status_err; ?></span>
	</div>

<!-- Q4 Blockers  -->
	<div>
	<h3>Blockers</h3>
	<p>Enter any blocking issues you are facing. If there are no blocking issues, enter "None".</p>
	<textarea name="blockers" style="width:850px ; height:50px;"> <?php echo $blockers; ?> </textarea>
	 <span class="help-block"><?php echo $blockers_err; ?></span>
	</div>

<!-- Q5 Time log  -->
	<div>
	<h3>Time Log</h3>
	<p>How many hours did you spend working on MSCI 342 this week outside of lecture/lab/tutorial time? (Ex. studying, project work, assignments, etc.)</p>
	<select name="time">
	<?php 
		for ($i=0; $i <= 20; $i++) {
			if ($i == $time){
			echo " <option selected=\"selected\" value=".$i.">".$i."</option>
			";
			}
			else {
			echo " <option value=".$i.">".$i."</option>
			";
			}

		}
	 ?>
	</select>
	 <span class="help-block"><?php echo $time_err; ?></span>
	</div>

<!-- Q6 Team Health  -->
	<div>
	<h3>Team Health</h3>
	<p>Rate how you feel about the team progress and team dynamic.</p>
	<table id="StatusFormTable">
	<th><img src="images/VeryUnhappyEmoji.png" height="42" width="42"></th>
	<th><img src="images/UnhappyEmoji.png" height="42" width="42"></th>
	<th><img src="images/NeutralEmoji.png" height="45" width="45"></th>
	<th><img src="images/HappyEmoji.png" height="47" width="47"></th>
	<th><img src="images/VeryHappyEmoji.png" height="42" width="42"></th>	
	<tr>
	<td><input type="radio" name="health" value="Very Unhappy" <?php if ( "Very Unhappy" == $health) echo 'checked="checked"'; ?>> Very Unhappy</td> 
	<td><input type="radio" name="health" value="Unhappy" <?php if ( "Unhappy" == $health) echo 'checked="checked"'; ?> > Unhappy</td>
	<td><input type="radio" name="health" value="Neutral" <?php if ( "Neutral" == $health) echo 'checked="checked"'; ?>> Neutral</td>
	<td><input type="radio" name="health" value="Happy" <?php if ( "Happy" == $health) echo 'checked="checked"'; ?>> Happy</td>
	<td><input type="radio" name="health" value="Very Happy" <?php if ( "Very Happy" == $health) echo 'checked="checked"'; ?>>Very Happy</td>
	<!-- {if ( "Unhappy" == $health) echo 'checked="checked"';} keeps value checked after submittal if other field is not inputted -->
	</tr>
	</table>
	 <span class="help-block"><?php echo $health_err; ?></span>	
	</div>

<!-- Q7 Conerns  -->
	<div>
	<h3>Concerns</h3>
	<p>Enter any concerns regarding your group or the project. If you have no concerns, please enter "None".</p> <p><strong>Note: </strong>This information is confidential and will only be seen by the Instructor and TA.</p>
	<textarea name="concerns" style="width:850px; height:100px;"><?php echo $concerns; ?></textarea>
	 <span class="help-block"><?php echo $concerns_err; ?></span>
	</div>	
	<br>
<!-- submit button  -->	
<button type="submit" name="submit"> Submit </button> 	
</form>

<?php $todoAppMySQLConnection->close();  ?>
</body>
</html>