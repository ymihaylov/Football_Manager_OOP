<?php
if (isset($_POST["data"])) {
	require_once '../Model/Players.php';
	$player_info_json = $_POST["data"];
	$player_info_array = json_decode($player_info_json, true);

	if($player_info_array !== null){ 
        $player_id = $player_info_array["player_id"];
    }

    $players = new Players;
    header('Content-type: application/json');
    
    try 
    {
    	$players->delete_player_by_id($player_id);
    	$array_response = array("deleted" => true, "message" => "Delete player successfull");
    	echo json_encode($array_response);	
    }
    catch (Exception $e) 
    {
    	$array_response = array("deleted" => false, "message" => $e->getMessage());
    	echo json_encode($array_response);
    }
}