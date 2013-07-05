<?php 
class Team {
	public $id;
	public $team_name;
	public $team_sponsor;
	public $team_coach;

	public function __construct($id, $team_name, $team_sponsor, $team_coach)
	{
		$this->id = $id;
		$this->team_name = $team_name;
		$this->team_sponsor = $team_sponsor;
		$this->team_coach = $team_coach;
	}
}