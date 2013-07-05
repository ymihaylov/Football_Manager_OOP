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
	if (isset($_GET['team-id']))
	{
		$players_array = $player_obj->get_players_by_team_id($_GET['team-id']);
	}
	else 
	{
		$players_array = $player_obj->get_all_players();	
	}
	
	if ( ! empty($players_array))
	{	
		// Get team names by id
		foreach ($players_array as $key => $player) 
		{
			$ids[] = $player['team_id'];
		}
		
		// Array wich contains ids of teams as key and team names as value
		$teams_names_array = $team_obj->get_team_names_by_ids($ids);
	
		// Print players in html list
		foreach ($players_array as $key => $player) 
		{
			if ( ! $player['player_avatar_url']) 
			{
				$player_avatar_url = 'imgs/default-avatar.png';
			}
			else 
			{
				$player_avatar_url = 'uploads/'.$player['player_avatar_url'];	
			}
?>
	<li data-id="<?= $player['id'] ?>">
		<div class="photo-name-container">
			<img src="<?= $player_avatar_url ?>" width="128" height="128" alt="player-avatar" />
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
			<a class="edit-player-btn" href="edit-player.php?player-id=<?= $player['id']; ?>">Edit</a>
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