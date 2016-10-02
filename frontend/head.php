<?php

//require_once '../connect.php';
session_start();
if (!isset($_SESSION['user_session'])) {
	header ('Location: index.php');
} else if ($_SESSION['user_session'] == 'subhead') {
		header ('Location: subhead.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>SFTechSpace | <?php echo $_SESSION['user_name'] ?></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href='css/teststyle.css'>
	<link rel="stylesheet" href='css/headstyle.css'>
</head>
<body>

<div class="fullscreen-bg">
    <video loop muted autoplay poster="images/workspace.png" class="fullscreen-bg__video">
        <source src="videos/workspace.mp4" type="video/mp4">
    </video>
</div>

<div class='fullscreen-overlay'></div>

<div id='head-title'>
	<span><img src="images/logo.png" width="50px" id='sf-logo'></span>
	<span id='head-name'><?php echo $_SESSION['user_name'] ?></span>
</div>

<button id='logout-button'>Logout</button>

<div class="row">

	<div class="col-xs-10 col-xs-push-1 col-md-5" id='free-wrapper'>
		<h2>Free SubHeads</h2>	
		<div id='free-subheads' class='subheads'></div>
		<div class="col-xs-12" id='assign-container'>
			<button id="assign-button">Assign Task</button>
		</div>

	</div>
	<div class="col-xs-10 col-xs-push-1 col-md-5 col-md-push-1" 
		id='busy-wrapper'>
		<h2>Busy SubHeads</h2>	
		<div id='busy-subheads' class='subheads'></div>
		<div class="col-xs-12 col-md-10 col-md-push-1 button-container">
			<button id="view-button" class="button">View Task</button>
		</div>

	</div>
</div>

<div class='task col-xs-12'>
	<div class='task-title col-xs-10 col-xs-push-1'><input placeholder="Task Title" type='text' class='col-xs-12'/></div>
	<div class='task-description col-xs-10 col-xs-push-1'><input placeholder="Task Description" type='text' class='col-xs-12'/></div>
	<div class='task-assigned-by col-xs-10 col-xs-push-1'><input disabled class='col-xs-12' 
	placeholder= <?php echo "TaskAssignedBy:".$_SESSION['user_name'] ?> /></div>
	<button class='assign-action col-xs-10 col-xs-push-1'>Done</button>
	<button class='exit-action col-xs-10 col-xs-push-1' id='close'>Cancel</button>

</div>

<div class='view col-xs-12'>
	<div class="row">
		<div class="col-xs-6" id="chosen-subhead">
			<center>
			</center>
		</div>
		<div class='col-xs-4'>
			<button id="edit-task" class="col-xs-6">EDIT TASK</button>
			<button id="delete-task" class="col-xs-6">DELETE</button>

		</div>
		
	</div>
	<div class="col-xs-10 col-xs-push-1 col-md-5 col-md-push-0" id = 'team-info'>
		<center>
			<h2>Team/Member</h2>
			<div id='members-div'>
				
			</div>
		</center>
	</div>
	<div class="col-xs-10 col-xs-push-1 col-md-5 col-md-push-1" id = 'task-info'>
		<center>
			<h3>Assigned Task</h3>
			<p id='task-title1'></p>
			<h3>Task Description</h3>
			<p id='task-description1'></p>
			<h3>Assigned By</h3>
			<p id='head-name1'></p>
		</center>
	</div>
	
	<!--<div class='row'>
		<div class='view-assigned-by col-xs-10 col-xs-push-1'>
			<input placeholder="" type='text' disabled class='col-xs-12'/></div>
		<div class='view-assigned-with col-xs-10 col-xs-push-1'>
			<input placeholder="" type='text' disabled class='col-xs-12'/>
				
		</div>
		
		<div class='view-title col-xs-10 col-xs-push-1'>
		</div>
		<div class='view-description  col-xs-10 col-xs-push-1'>
		</div>
	</div>
	<div class='row'>
		<button class='edit-action col-xs-3 col-xs-push-1 col-md-1'>Edit</button>
		<button class='exit-action col-xs-3 col-xs-push-1 col-md-1' id='close'>Close</button>
		<button class='delete-action col-xs-3 col-xs-push-1 col-md-1' id='close'>Delete</button>
	</div>-->
</div>



<script
	src="https://code.jquery.com/jquery-3.1.1.js"
	integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
	crossorigin="anonymous">
</script>
<script src='js/jquery-3.1.1.js'></script>
<script src='js/bootstrap.js'></script>
<script src="js/head.js"></script>
</body>
</html>