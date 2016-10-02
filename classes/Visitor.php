<?php

class Visitor {

	private $db;

	function __construct ($DB_conn) {
		$this->db = $DB_conn;
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
			return true;
		}

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

}
