<?php  
	require_once 'Modules/Session.php';
	require_once 'Model/Players.php';
	require_once 'Model/Teams.php';
	Session::start();
	Session::check_for_logged_user();
	
	$this_page = "players";
	require_once("html-snippets/header-html.php");
	require_once("html-snippets/greetings.php");
	require_once("html-snippets/main-menu.php");
?>
<h2 class="title-text">Players</h2>
<ul id="players-list">
<?php 
	$player_obj = new Players;
	$team_obj = new Teams;

	$all_players = $player_obj->get_all_players();

	if ( ! empty($all_players))
	{	
		// Get team names by id
		foreach ($all_players as $key => $player) 
		{
			$ids[] = $player['team_id'];
		}
		
		// Array wich contains ids of teams as key and team names as value
		$teams_names_array = $team_obj->get_team_names_by_ids($ids);
	
		// Print players in html list
		foreach ($all_players as $key => $player) 
		{
?>
	<li data-id="<?= $player['id'] ?>">
		<div class="photo-name-container">
			<img src="imgs/default-avatar.png" alt="player-avatar" />
			<div class="player-name"><?= $player["player_firstname"] . ' ' . $player["player_lastname"]; ?></div>
		</div>
		<div class="player-info-container">
			<div><span>Birthday:</span> <?= $player_obj->format_player_birthday($player['player_birthday']) ?></div>
			<div><span>Height:</span> <?= $player["player_height"]; ?></div>
			<div><span>Playing position:</span> <?= $player["player_playingposition"]; ?></div>
			<div><span>Team:</span> <?= $teams_names_array[$player['team_id']] ?></div>
			<div><span>Number:</span> <?= $player["player_number"]; ?></div>
		</div>
		
		<div class="player-btns-container">
			<a class="edit-player-btn" href="#">Edit</a>
			<a class="delete-player-btn" href="#">Delete</a>
		</div>
	</li>			
<?php			
		}	
	}
?>
</ul>
<div id="dialog-confirm" style="font-size: 1.6em;" title="Delete this player?">
  <p>This player will be permanently deleted and cannot be recovered. Are you sure for deleting?</p>
</div>
<?php  
require_once 'html-snippets/footer.php';