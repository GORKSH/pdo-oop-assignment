<?php

class User {

	protected $db;
	protected $free_subheads;
	protected $busy_subheads;

	function __construct ($DB_conn) {
		$this->db = $DB_conn;
		$this->free_subheads = $this->seperateSubHeads ()['free'];
		$this->busy_subheads = $this->seperateSubHeads ()['busy'];
	}

	public function login ($credentials, $password) {

		try {

			$stmt = $this->db->prepare("SELECT * FROM `users` WHERE `user_name`=:uname OR `user_email`=:umail");
			$stmt->execute (array (':uname' => $credentials, ':umail' => $credentials));

			if ($stmt->rowCount () == 1) {

				$userRow = $stmt->fetchObject ();

				if ($password == $userRow->user_pass) {

					$_SESSION['user_name'] = $userRow->user_name;
					$_SESSION['user_email'] = $userRow->user_email;
					$_SESSION['user_pass'] = $userRow->user_pass;

					if ($userRow->user_type == 2) { //subhead

						$_SESSION['user_session'] = 'subhead';
						$_SESSION['user_state'] = $userRow->user_state; //active(1)/free(-1)
						$_SESSION['task_id'] = $userRow->task_id;
					} else if ($userRow->user_type == 1) {

						$_SESSION['user_session'] = 'head';
					}

					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} catch (PDOException $error) {
			echo $error->getMessage ();
		}
	}

	public function isLoggedIn () {
		if (isset ($_SESSION['user_session'])) {
			//echo 'in';
			return true;
		}
		//echo 'out';
		return false;
	}

	public function redirect ($url) {
		header ("Location: ". $url);
	}

	public function getUserType () {
		return ($_SESSION['user_session']);
	}

	public function getUserName () {
		return ($_SESSION['user_name']);
	}

	public function logout () {
		session_destroy ();
		return true;
	}

	public function getFreeSubHeads () {
		return $this->free_subheads;
	}

	public function getBusySubHeads () {
		return $this->busy_subheads;
	}

	private function seperateSubHeads() {
		try {
			
			$stmt = $this->db->prepare ('SELECT * FROM `users` WHERE `user_type`=:utype');
			$stmt-> execute (array (':utype'=>'2'));
			
			$free = array();
			$busy = array();

			$rows = $stmt->rowCount();
			
			while ($rows-- > 0) {
				$userRow = $stmt->fetchObject();
				if ($userRow->user_state == '1')
					array_push($free, $userRow->user_name);
				else 
					array_push($busy, $userRow->user_name);
			}
		} catch (PDOException $e) {
			echo $e->getMessage(); 
		}
		return (array ('free' => $free, 'busy' => $busy));
	}

	public function updateSubHeads () {
		$array = $this->seperateSubHeads();
		$this->free_subheads = $array['free'];
		$this->busy_subheads = $array['busy'];
	}

	private function getTaskID ($subhead) {
		$stmt = $this->db->prepare ('SELECT * FROM `users` WHERE `user_name`=:uname');
		$stmt-> execute (array (':uname'=>$subhead));

		$userRow = $stmt->fetchObject ();
		return $userRow->task_id;
	}

	private function getTaskInfo ($taskId) {
		$stmt = $this->db->prepare ('SELECT * FROM `tasks` WHERE `task_id` = :tId');
		$stmt-> execute (array (':tId' => $taskId));
		$taskRow = $stmt->fetchObject ();
		
		return $taskRow;
	}

	private function getTaskTeam ($subhead, $taskId, $task_type) {
		$result = array();
		if($task_type == 'group') {
			$stmt = $this->db->prepare ('SELECT `assigned_to`, `assigned_by` FROM `assignments` 
										WHERE `assignment_id`=:tId AND NOT `assigned_to` = :shname AND `current_status`=:cstatus');
			$stmt-> execute (array ('tId' => $taskId, "cstatus" => 1, 'shname' => $subhead));

			$rows = $stmt->rowCount ();
			$team = array ();

			$assignmentRow = $stmt->fetchObject ();
			array_push($team, $assignmentRow->assigned_to);
			$head = $assignmentRow->assigned_by;
			while (--$rows > 0) {
				$assignmentRow = $stmt->fetchObject ();
				array_push($team, $assignmentRow->assigned_to);
			}
			$result['team'] = $team;
			$result['head'] = $head;

		} else if ($task_type == 'single') {
			$stmt = $this->db->prepare ('SELECT `assigned_to`, `assigned_by` FROM `assignments` 
										WHERE `assignment_id`=:tId AND `assigned_to`=:shname');
			$stmt-> execute (array ('tId' => $taskId, 'shname' => $subhead));

			$rows = $stmt->rowCount ();
			$team = array ();

			$assignmentRow = $stmt->fetchObject ();
			$head = $assignmentRow->assigned_by;
			
			$result = array();
			$result['team'] = $team;
			$result['head'] = $head;
		}
		return $result;	
	} 

	public function viewAssignedTask ($subhead) {
		$result = array();
	
		$task_id = $this->getTaskID ($subhead);
		$result['task_id'] = $task_id;

		$task = $this->getTaskInfo ($task_id);
		$task_title = $task->task_title;
		$task_body = $task->task_description;
		$result['task'] = array('title' => $task_title, 'description' => $task_body);

		$task_type = $task->task_type;
		
		$team = $this->getTaskTeam ($subhead, $task_id, $task_type);
		
		$result['team'] = $team['team'];

		$result['head'] = $team['head'];

		return $result;

	}

}