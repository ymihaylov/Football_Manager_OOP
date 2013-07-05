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

	private function set_avatar($player_id, $avatar_name) 
	{
		parent::updateById(self::TABLE_NAME, $player_id, array("player_avatar_url" => $avatar_name));
	}

	public function update_player($post, $file)
	{
		// Uploading file
		var_dump($file['file-to-upload']);
		if (isset($file['file-to-upload']) AND $file['file-to-upload']['name'] !== '')
		{
			if ($file['file-to-upload']['error'] > 0) {
			
			    die("Error: " . $file['file-to-upload']['error'] . "<br />");
			} 
			else 
			{
			    // array of valid extensions
			    $valid_extensions = array('.jpg', '.jpeg', '.gif', '.png');
				
				// get extension of the uploaded file
			    $file_extension = strrchr($file['file-to-upload']['name'], ".");

			    if (in_array($file_extension, $valid_extensions)) 
			    {
			     	$newName = $post['player-id'].$file_extension;
			    	$destination = '../uploads/' . $newName;

			    	if (move_uploaded_file($file['file-to-upload']['tmp_name'], $destination)) 
			        {
			           $this->set_avatar($post['player-id'], $newName);
			        }
			    } 
			    else 
			    {
			        return false;
			    }
			}
		}

		$array_for_update = array(
			"player_firstname" => $post['player-firstname'],
			"player_lastname" => $post['player-lastname'],
			"player_height" => $post['player-height'],
			"player_number" => $post['player-number'],
			"player_playingposition" => $post['player-playingposition']
		);

		parent::updateById(self::TABLE_NAME, $post['player-id'], $array_for_update);
		return true;
	}

	public function format_player_birthday($mysql_date)
	{
		return date("d F Y", strtotime($mysql_date));
	}
}