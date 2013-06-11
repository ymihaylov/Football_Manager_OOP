<?php
class Database {
	protected $database_name = 'FootballManager';
	protected $host = 'localhost';
	protected $username_db = 'yavcho_despark';
	protected $password_db = 'quadro0';

	protected $connection;

	protected static $instance = null;

	protected function __construct()
	{
		$this->connection = new mysqli($this->host, $this->username_db, 
			$this->password_db, $this->database_name);

		if($this->connection->connect_error){
			die('Connect Error (' . $mysqli->connect_errno . ') ' 
								. $mysqli->connect_error);
		}	

		// FIX Cyrillic
		$this->connection->query("SET NAMES UTF8");
	}

	public static function getInstance()
	{
		if(self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
}