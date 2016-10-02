<?php 

require_once 'User.php';

class SubHead extends USER {
	
	function __construct($DB_Conn) {
		parent::__construct($DB_Conn);	
	}

	public function getUserState() {
		return $_SESSION['user_state'];
	}

	private function seperateSubHeads() {
		try {
			
			$stmt = $this->db->prepare ('SELECT * FROM `users` WHERE `user_type`=:utype AND NOT `user_name`=:shname');
			$stmt-> execute (array ('utype'=>'2', 'shname' => $_SESSION['user_name']));
			
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
}