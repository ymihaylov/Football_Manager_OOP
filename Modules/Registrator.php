<?php

class Registrator {
	
	private $entered_username;
	private $entered_password;
	private $entered_password2;
	protected static $db;

	public function __construct($db, $username, $password, $password2)
	{
		self::$db=$db;
		$this->entered_username = self::$db->connection->real_escape_string($username);
		$this->entered_password = self::$db->connection->real_escape_string(md5($password));
		$this->entered_password2 = self::$db->connection->real_escape_string(md5($password2));
	}

	public function validate() 
	{
		if($this->user_exists())
		{
			return array("registred" => false, "username" => $this->entered_username, 
				"message" => "Username exists");	
		}
		else if($this->entered_username === "" || $this->entered_password === "" || $this->entered_password2 === "")
		{
			return array("registred" => false, "username" => $this->entered_username, 
				"message" => "You dont fill all fields");
		}
		else if($this->entered_password !== $this->entered_password2) 
		{
			return array("registred" => false, "username" => $this->entered_username, 
				"message" => "Passwords dont match");
		}
		else 
		{
			$this->add_user_to_database();
			return array("registred" => true, "username" => $this->entered_username, 
				"message" => "Successful registred user");	
		}

	}

	private function add_user_to_database() 
	{
		$query = "INSERT INTO fb_users(username, password) 
				  VALUES('$this->entered_username', '$this->entered_password')";
		self::$db->connection->query($query);		  
	}  

	private function user_exists() 
	{
		$query = "SELECT username
				  FROM fb_users
				  WHERE username='$this->entered_username'";
		$res = self::$db->connection->query($query);
		$row = $res->fetch_row();
		if($row > 0) 
		{
			return true;
		}
		else
		{
			return false;
		} 
	}
}