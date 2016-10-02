<?php

require_once 'User.php';

class Head extends User {

	function __construct($DB_Conn) {
		parent::__construct($DB_Conn);	
	}

	private function updateTaskTable ($task_title, $task_body, $task_type) {
		try {
			$stmt = $this->db->prepare ('INSERT INTO 
							`tasks`(`task_title`,`task_description`, `task_type`) 
							VALUES(:stitle, :sdecription, :stype)');
			$stmt->execute (array (
								'stitle' => $task_title,
								'sdecription' => $task_body, 'stype' => $task_type
							));

			//get the last id
			$stmt = $this->db->prepare ('SELECT `task_id` FROM `tasks` ORDER BY `task_id` DESC LIMIT 1');
			$stmt ->execute(); 	
			
			$taskRow = $stmt->fetchObject();
			$task_id = $taskRow->task_id;
			return $task_id;
		} catch (PDOException $error) {
			$error->getMessage();
		}
		
	}

	private function updateAssignmetsTable ($head, $subhead_array, $assignment_id, $assignment_type) {
		
		try {

			$len = count ($subhead_array);

			for ($x = 0; $x < $len; $x++) {
				$stmt = $this->db->prepare ('INSERT INTO 
						`assignments`(`assigned_by`,`assigned_to`, `assignment_id`, `assignment_type`, `current_status`) 
						VALUES(:hname, :shname, :tId, :ttype, :cstatus)');
				$stmt->execute (array (
							"hname" => $head,
							"shname" => $subhead_array[$x],
							"tId" => $assignment_id,
							"ttype" => $assignment_type,
							"cstatus" => '1'
						));
			}
			return true;
		} catch (PDOException $error) {
			$error->getMessage();
		}
	}

	private function updateUsersTable ($subhead_array, $task_id) {
		try {
			$len = count ($subhead_array);
			
			for($x = 0; $x < $len; $x++) {
				
				$stmt = $this->db->prepare ('UPDATE `users` 
					SET `user_state`=:ustate, `task_id`=:tId WHERE `user_name`=:shname'); 
				$stmt->execute(array(
					'ustate' => -1,
					'shname' => $subhead_array[$x],
					'tId' => $task_id				
				));
			}
			return true;
		} catch (PDOException $error) {
			$error->getMessage();
		} 
	}

	public function assignTask ($head, $subhead_array, $task_title, $task_body) {

		$task_type = count ($subhead_array) > 1 ? 'group' : 'single'; 
		$task_id = $this->updateTaskTable ($task_title, $task_body, $task_type);
		
		$this->updateAssignmetsTable ($head, $subhead_array , $task_id, $task_type);

	
		$this->updateUsersTable ($subhead_array, $task_id);
		return true;
	}

	private function findTaskId ($subhead) {
		try {
			$stmt = $this->db->prepare ('SELECT * FROM `users` WHERE `user_name` = :uname');
			$stmt ->execute (array ("uname" => $subhead)); 

			$userRow = $stmt->fetchObject ();
			$task_id = $userRow->task_id;
			return $task_id;	
		} catch (PDOException $error) {
			$error->getMessage ();
		}
	}

	private function modifyTaskTable ($task_id ,$task_title, $task_body) {
		
		try {
			$stmt = $this->db->prepare ('UPDATE `tasks` SET `task_title`=:ttitle, `task_description`=:tbody WHERE `task_id`=:tId'); 
			
			$stmt->execute (array (
				'tbody' => $task_body,
				'ttitle' => $task_title,
				'tId' => $task_id				
			));
			return true;
		} catch (PDOException $error) {
			$error->getMessage ();
		}
		
	}

	private function modifyUsersTable ($subhead) {
		try {
			$stmt = $this->db->prepare ('UPDATE `users` SET `user_state`=:ustate, `task_id`=:tId WHERE `user_name`=:uname'); 
			
			$stmt->execute (array (
				'ustate' => 1,
				'tId' => 0,
				"uname" => $subhead		
			));
			//print_r('sdfsd');
			return true;
		} catch (PDOException $error) {
			$error->getMessage ();
		}
	}

	private function modifyAssignementsTable ($subhead, $task_id) {
		try {
			print_r($subhead);
			print_r($task_id);
			$stmt = $this->db->prepare ('UPDATE `assignments` SET `current_status`=:cstatus WHERE `assigned_to`=:shname AND `assignment_id` =:tId'); 
			
			$stmt->execute (array (
				'cstatus' => -1,
				'tId' => $task_id,
				"shname" => $subhead		
			));
			//print_r('sdfsd');
			return true;
		} catch (PDOException $error) {
			$error->getMessage ();
		}
	}

	public function editAssignedTask ($subhead, $new_title, $new_body) {

		$task_id = $this->findTaskId ($subhead);
		$this->modifyTaskTable ($task_id, $new_title, $new_body);
	}

	public function deleteAssignedTask ($subhead) {

		$task_id = $this->findTaskId ($subhead);
		
		$this->modifyUsersTable ($subhead);

		$this->modifyAssignementsTable ($subhead, $task_id);

	}
}