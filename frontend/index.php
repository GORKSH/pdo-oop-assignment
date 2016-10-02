<?php
session_start();

//require_once '../connect.php';

if (isset($_SESSION['user_session'])) {
	if ($_SESSION['user_session'] == 'head') {
		header ('Location: head.php');
	} else if ($_SESSION['user_session'] == 'subhead') {
		header ('Location: subhead.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>TechSpace</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href='css/teststyle.css'>
	<link rel="stylesheet" href='css/loginstyle.css'>

</head>
<body>

<div class="fullscreen-bg">
    <video loop muted autoplay poster="images/workspace.png" class="fullscreen-bg__video">
        <source src="videos/workspace.mp4" type="video/mp4">
    </video>
</div>

<div class='sflogo container-fluid'>
	<img src="images/logo.png" width="55px">
	<h2>SFTechSpace</h2>
</div>

<div class='taglines container-fluid'>
	<h1>We work 24X7! Login here...</h1>
	<h2>A small work space for the Heads and Sub-heads of Spring Fest 2017</h2>
</div>

<div class='login-form col-xs-12'>
	<div class='form-wrapper col-xs-10 col-xs-push-1 col-md-8 col-md-push-2 wrapper'>
		<div class='input-fields-wrapper col-md-8 col-xs-12'>
			<div class='col-md-5 col-xs-10 col-xs-push-1'>
				<input class='col-xs-12' id='user-credentials' type = 'text' placeholder="Username or Email" >
				<div id='credentials-error' class='col-xs-12 container'></div>
			</div>	
			<div class='col-md-5 col-xs-10 col-xs-push-1'>	
				<input class='col-xs-12' id='user-password' placeholder="Password">
				<div id='password-error' class='col-xs-12 container'></div>
			</div>
		</div> 
		<div class='submit-button-wrapper col-md-4 col-xs-12 wrapper'>
			<button class='col-xs-10 col-xs-push-1' id='login-button'>LogIn</button> 
		</div>		
	</div>
</div>

<script
  	src="https://code.jquery.com/jquery-3.1.1.js"
  	integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
	crossorigin="anonymous">
</script>
<script src='js/jquery-3.1.1.js'></script>
<script src='js/bootstrap.js'></script>
<script src="js/login.js"></script>


</body>
</html>