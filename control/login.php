<?php 
require_once '../connect.php';
require_once '../classes/Visitor.php';



$visitor = new Visitor($pdo);

$credentials = $_POST['credentials'];
$password = $_POST['password'];


$visitor->login($credentials, $password);

if(!$visitor->isLoggedIn()) {
	echo 'kick';
	$visitor->logout();
}
else {
	if($visitor->getUserType() == 'head')
		echo 'head';
	else echo 'subhead';
	//$visitor->logout();
}