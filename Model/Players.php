<?php

require_once 'Generic_Entity.php';

class Players extends Generic_Entity {
	const TABLE_NAME = "fb_players";

	public function get_all_players() 
	{
		$all_players = parent::getAll(self::TABLE_NAME);
		return $all_players;
	}

	public function get_player_by_id($player_id) 
	{
		$properties_array = array(
			"player_firstname", "player_lastname", "player_height",
			"player_playingposition", "player_birthday", "player_number", "player_avatar_url");
		$player_data = parent::get_by_id(self::TABLE_NAME, $player_id, $properties_array);
		return $player_data;
	}

	public function get_players_by_team_id($team_id) 
	{
		$query = "SELECT * 
					FROM `fb_players` 
					WHERE `team_id` = ".$team_id;
		if ($result = $this->connection->query($query)) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$players_array[] = $row; 
			}
			$result->free();
		}

		if ( ! empty($players_array) )
			return $players_array;
	}

	public function delete_player_by_id($id)
	{		
		try
		{
			parent::deleteById(self::TABLE_NAME, $id);
		}
		catch (Exception $e)
		{
			throw $e;	
		}
	}

	public function format_player_birthday($mysql_date)
	{
		return date("d F Y", strtotime($mysql_date));
	}
}