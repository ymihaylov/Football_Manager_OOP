<?php  

require_once 'Generic_Entity.php';

class Teams extends Generic_Entity {
	const TABLE_NAME = "fb_teams";
	
	public function get_all_teams() {
		$all_teams = parent::getAll(self::TABLE_NAME);
		return $all_teams;
	}

	public function update($team)
	{
		$team_array = array(
			'team_name' => $this->connection->real_escape_string($team->team_name),
			'team_coach' => $this->connection->real_escape_string($team->team_coach),
			'team_sponsor' => $this->connection->real_escape_string($team->team_sponsor));
		try 
		{
			parent::updateById(self::TABLE_NAME, $team->id, $team_array);
		}
		catch (Exception $e) 
		{
			throw $e;
		}
	}

	public function delete_team_by_id($id)
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

	public function create_team($new_team_array) 
	{
		try 
		{
			$id = parent::create(self::TABLE_NAME, $new_team_array);
			return array("created" => true, "id" => $id, "message" => $new_team_array['team_name'] . ' created successfull');
		}
		catch (Exception $e)
		{
			return array("created" => false, "id" => null, "message" => $e->getMessage());
		}

	}
}