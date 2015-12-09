<?php
class CarMateUser
{
	private $_db = null;

	public function __construct()
	{
		$this->_db = new PDO();
	}

	public function getUserById($user_id)
	{
		$sql = <<<SQL
		select uname as user_name, nickname as nickname from IAM_USER where userid = :user_id
SQL;
		$bind = array(
			'user_id' => $user_id
		)
	}
}