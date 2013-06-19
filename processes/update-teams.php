<?php 
require_once '../Model/Team.php';
require_once '../Model/Teams.php';
header('Content-type: application/json');
$array = json_decode(stripslashes($_POST['data']));
$team_obj = new Teams;

foreach($array as $team)
{
	$team_obj->update($team);
}
