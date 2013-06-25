<?php 
if(isset($_POST["data"])) 
{
	require_once '../Model/Teams.php';
	$new_team_info_json =  $_POST["data"];
	$new_team_info_array = json_decode($new_team_info_json, true);
	
	$team_obj = new Teams;
	header('Content-type: application/json');

	echo json_encode($team_obj->create_team($new_team_info_array));
}