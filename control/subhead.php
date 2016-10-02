<?php
require_once '../connect.php';
require_once '../classes/SubHead.php';

$subhead = new SubHead($pdo);

function convertArraytoString ($array1d, $sign) {
	return implode($sign,$array1d);
}

function convertStringToArray($string, $sign) {
	return explode($sign,$string);
}


$function = $_POST['function_name'];

switch ($function) {

	case 'isLoggedIn':
		$subhead->isLoggedIn (); //return type => boolean
			break;

	case 'getUserType':
		$subhead->getUserType (); //return type => string
			break;

	case 'getSubHeadState':
		echo $subhead->getUserState (); //return type => string
			break;

	case 'getSubHeadName':
		echo $subhead->getUserName(); //return type => string
		break;

	case 'getFreeSubHeads':
		print_r(convertArraytoString($subhead->getFreeSubHeads (), ',')); //return type => array
		break;

	case 'getBusySubHeads':
		print_r(convertArraytoString($subhead->getBusySubHeads (), ',')); //return type => array
		break;

	case 'updateSubHeadsLists':
		$subhead->updateSubHeads ();
			$subhead->getFreeSubHeads (); //return type => array
			$subhead->getBusySubHeads (); //return type => array
		break;

	case 'logout':
		$subhead->logout (); //return type => boolean
		break;

	case 'getAssignedTask':
		$subhead = $_POST['subhead'];
		if($subhead == 'SUBHEAD') 
			$subhead->viewAssignedTask($_SESSION['user_name']);
		else 
			$subhead->viewAssignedTask($subhead);

		break;

	default: break;
}

