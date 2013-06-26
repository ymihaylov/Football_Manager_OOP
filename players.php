<?php  
	require_once 'Modules/Session.php';
	Session::start();
	Session::check_for_logged_user();
	
	$this_page = "players";
	require_once("html-snippets/header-html.php");
	require_once("html-snippets/greetings.php");
	require_once("html-snippets/main-menu.php");
?>
<h2 class="title-text">Players</h2>
<ul id="players-list">
	<li>
		<div class="photo-name-container">
			<img src="imgs/default-avatar.png" alt="player-avatar" />
			<div class="player-name">Vasko Cherveq</div>
		</div>
		<div class="player-info-container">
			<div><span>Birthday:</span> 07 August 1992</div>
			<div><span>Height:</span> 169</div>
			<div><span>Playing position:</span> Vratar</div>
			<div><span>Team:</span> Despark</div>
			<div><span>Number:</span> 15</div>
		</div>
		
		<div class="player-btns-container">
			<a class="edit-player-btn" href="#">Edit</a>
			<a class="delete-player-btn " href="#">Delete</a>
		</div>
	</li>
	

</ul>

<?php  
require_once 'html-snippets/footer.php';