<?php
require_once '../connect.php';
require_once '../classes/Head.php';

$head = new Head($pdo);
/*
if (!$head->isLoggedIn ()) {
	$head->login ($_SESSION['user_name'], $_SESSION['user_pass']);
}
*/
function convertArraytoString ($array1d, $sign) {
	return implode($sign,$array1d);
}

function convertStringToArray($string, $sign) {
	return explode($sign,$string);
}


$function = $_POST['function_name'];
//$function = 'assignTask';

switch ($function) {

	case 'isLoggedIn':
		$head->isLoggedIn (); //return type => boolean
			break;

	case 'getUserType':
		$head->getUserType (); //return type => string
			break;

	case 'getUserName':
		$head->getUserName(); //return type => string
		break;

	case 'getFreeSubHeads':
		print_r(convertArraytoString($head->getFreeSubHeads (), ",")); //return type => array
		break;

	case 'getBusySubHeads':
		print_r(convertArraytoString($head->getBusySubHeads (), ",")); //return type => array
		break;

	case 'updateSubHeadsLists':
		$head->updateSubHeads ();
		$head->getFreeSubHeads (); //return type => array
		$head->getBusySubHeads (); //return type => array
		break;

	case 'logout':
		$head->logout (); //return type => boolean
		break;

	case 'getAssignedTask':
		$subhead = $_POST['subhead'];
		$view_task = $head->viewAssignedTask($subhead);
		//print_r($view_task);
		//$array = convertArraytoString($view_task);
		$str = '';

		$str = $str . '' . $view_task['task']['title'] . '||' . $view_task['task']['description'] . '||' . $view_task['head'];

		$len = count($view_task['team']);

		for ($x = 0; $x < $len; $x++) {
			$str = $str . '||' .$view_task['team'][$x];
		}
		echo ($str);
		break;

	case 'editTask':
		$subhead = $_POST['subhead'];
		$new_title = $_POST['new_title'];
		$new_body = $_POST['new_body'];
		$head->editAssignedTask ($subhead, $new_title, $new_title); // return type => boolean
		break;

	case 'deleteTask':
		$subhead = $_POST['subhead'];
		$head->deleteAssignedTask ($subhead); // return type => boolean
		break;

	case 'assignTask':
		$head = $_SESSION['user_name'];
		$subhead_string = $_POST['subhead_string'];
		$subhead_array = convertStringToArray($subhead_string, ",");
		$task_title = $_POST['task_title'];
		$task_body = $_POST['task_body'];
		$head->assignTask ($head, $subhead_array, $task_title, $task_body); // return type => boolean
		break;

	default: break;
}

