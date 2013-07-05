<?php 
require_once '../Model/Team.php';
require_once '../Model/Teams.php';
header('Content-type: application/json');
$array = json_decode(stripslashes($_POST['data']));
$team_obj = new Teams;
$success_update = TRUE;
$array_response = array();
foreach($array as $team)
{
	try 
	{
		$team_obj->update($team);
	}
	catch (Exception $e)
	{
		$success_update = FALSE;
		$array_response = array("updated" => false, "team_name" => $team->team_name,
							"message" => $e->getMessage());	
		break;					
	}
}

if($success_update)
{
	$array_response = array("updated" => true, "message" => "Update teams succesfully");
}
echo json_encode($array_response);	

