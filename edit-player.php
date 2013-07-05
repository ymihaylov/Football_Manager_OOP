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
	$player_obj = new Players;
	$player_data = $player_obj->get_player_by_id($_GET['player-id']);

	if ( ! $player_data['player_avatar_url']) 
	{
		$player_avatar_url = 'imgs/default-avatar.png';
	}
	else 
	{
		$player_avatar_url = 'uploads/'.$player_data['player_avatar_url'];	
	}
?>
<h2 class="title-text">Player: <?= $player_data['player_firstname']; ?></h2>
<div id="edit-player-container">
	<form id="update-player-form" enctype="multipart/form-data" method="POST" action="/processes/edit-player-process.php">
		<input type="hidden" name="player-id" value="<?= $_GET['player-id'] ?>" />
		<div id="photo-upload-container">
			<img src="<?= $player_avatar_url ?>" width="128" height="128" alt="player-avatar" />
		    <label for="file-to-upload">Select new image to Upload</label>
			<input type="file" name="file-to-upload" id="file-to-upload" />
		</div>
		<div id="fields-container">
			<div class="textinput-container">
				<label for="player-firstname">Firstname:</label>
				<input type="text" id="player-firstname" name="player-firstname" value="<?= $player_data['player_firstname'] ?>" />
			</div>

			<div class="textinput-container">
				<label for="">Lastname:</label>
				<input type="text" name="player-lastname" value="<?= $player_data['player_lastname']; ?>"/>
			</div>
			
			<div class="textinput-container">
				<label for="">Birthday:</label>
				<input type="date" name="player-birthday" value="<?= $player_data['player_birthday']; ?>" />
			</div>

			<div class="textinput-container">
				<label for="">Height:</label>
				<input type="text" name="player-height" value="<?= $player_data['player_height']; ?>" />
			</div>


			<div class="textinput-container">
				<label for="">Team:</label>
				<select>
				  <option value="volvo">Volvo</option>
				  <option value="saab">Saab</option>
				  <option value="mercedes">Mercedes</option>
				  <option value="audi">Audi</option>
				</select>
			</div>

			<div class="textinput-container">
				<label for="">Number:</label>
				<input name="player-number" type="number" value="<?= $player_data['player_number']; ?>" />
			</div>

			<div class="textinput-container">
				<label for="">Playing Position:</label>
				<input type="text" name="player-playingposition" value="<?= $player_data['player_playingposition']; ?>" />
			</div>
		</div>
		<input id="submit-form-btn" type="submit" />
	</form>
</div>
<?php  
require_once 'html-snippets/footer.php';