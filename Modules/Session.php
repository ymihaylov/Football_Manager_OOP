<?php 
class Session {
	
	private static $session_started = false;
	public static function start()
	{
		if(self::$session_started == false)
		{
			session_start();
			self::$session_started = true;
		}
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if(isset($_SESSION[$key]) AND $_SESSION[$key])
		{
			return $_SESSION[$key];
		}
		return false;
	}
}