<?php
require_once('../interface/iUser.php');
require_once('../database/Database.php');
class User extends Database implements iUser {

	public function loginUser($un, $pwd)
	{
		$sql = "SELECT *
				FROM user 
				WHERE user_account = ?
				AND user_password = ?;
		";
		return $this->getRow($sql, [$un, $pwd]);
	}

}
$user = new User();