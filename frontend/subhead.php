<?php
session_start();
if (!isset($_SESSION['user_session'])) {
	header ('Location: index.php');
} else if ($_SESSION['user_session'] == 'head') {
		header ('Location: head.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SFTECHSPACE | <?php echo $_SESSION['user_name']; ?></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href='css/teststyle.css'>
	<link rel="stylesheet" href='css/subheadstyle.css'>

</head>
<body>
	
<div class="fullscreen-bg">
    <video loop muted autoplay poster="images/workspace.png" class="fullscreen-bg__video">
        <source src="videos/workspace.mp4" type="video/mp4">
    </video>
</div>

<div class='fullscreen-overlay'></div>

<div id='subhead-title'>
	<span><img src="images/logo.png" width="50px" id='sf-logo'></span>
	<span id='subhead-name'><?php echo $_SESSION['user_name']; ?></span>
</div>

<button id='logout-button'>Logout</button>

<div class="row">

	<div class="col-xs-10 col-xs-push-1 col-md-4" id='free-wrapper'>
		<h2>Free SubHeads</h2>	
		<div id='free-subheads' class='subheads'></div>
	</div>

	<div class="col-xs-10 col-xs-push-1 col-md-6 col-md-push-1" id='task-wrapper'>
		<div class="row">
			<div class="col-xs-8 col-xs-push-2">
				<button class="col-xs-6 button" id='all-task-button'>All Tasks</button><button class="col-xs-6 button" id='my-task-button'>MyTasks</button>
			</div>
		</div>
		<div class="row">	
			<div class="col-xs-12">
				<div id='busy-subheads' class='subheads col-xs-12'></div>
				<div class="col-xs-12"><button id="view-task">View Task</button></div>
				<div id='my-task' class="col-xs-12">
					<h2 class='my-taskheading'></h2>
					<div class='my-task-body'>
						<h2></h2>
						<p class='task-body'></p>
					</div>
				</div>
			</div>
		</div>
	</div>
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
</div>


<script
	src="https://code.jquery.com/jquery-3.1.1.js"
	integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
	crossorigin="anonymous">
</script>
<script src='js/jquery-3.1.1.js'></script>
<script src='js/bootstrap.js'></script>
<script src="js/subhead.js"></script>
</body>
</html>