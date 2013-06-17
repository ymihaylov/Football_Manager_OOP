<?php
require 'Database.php';

class Authenticator extends Database {
	protected $username;
	protected $password;
	

	public function __construct($username, $password)
	{	
		parent::__construct();
		$this->username = $this->connection->real_escape_string($username);
		$this->password = $this->connection->real_escape_string(md5($password));
	}

	public function login()
	{
		if(empty($this->username) || empty($this->password))
		{
			return array("logged" => false, "username" => $this->username, 
				"message" => "You dont fill all fields - by PHP");
		}
		else 
		{
			$currentUser = $this->check_credentials();
			if($currentUser)
			{
				return array("logged" => true, "username" => $this->username, 
				"message" => "You are logged in!");
			}
			return array("registred" => false, "username" => $this->username, 
				"message" => "There is some problem with logging");	
		}
	}

	private function check_credentials()
	{
		$query = "SELECT `username` 
				FROM `fb_users` 
				WHERE `username` = '$this->username'
				AND `password` = '$this->password'
				LIMIT 1";
		$result = $this->connection->query($query);
		
		if($result->num_rows === 1)
		{
			$logged_user = $result->fetch_assoc();
			return $logged_user['username'];
		}

		return false;
	}
}