<?php 
if (isset($_POST["data"])) {
	require_once '../Model/Teams.php';
	$team_info_json = $_POST["data"];
	$team_info_array = json_decode($team_info_json, true);
    if($team_info_array !== null){ 
        $team_id = $team_info_array["team_id"];
    }

    $team = new Teams;
    header('Content-type: application/json');
    try 
    {
    	$team->delete_team_by_id($team_id);
    	$array_response = array("deleted" => true, "message" => "Delete team successfull");
    	echo json_encode($array_response);	
    }
    catch (Exception $e) 
    {
    	$array_response = array("deleted" => false, "message" => $e->getMessage());
    	echo json_encode($array_response);
    }
}