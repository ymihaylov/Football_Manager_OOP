<?php  
	require_once 'Modules/Session.php';
	Session::start();
	Session::check_for_logged_user();

	require_once("Model/Teams.php");
	require_once("html-snippets/header-html.php");
	require_once("html-snippets/greetings.php");
?>
<ul id="main-menu">
	<li><a href="#" class="current">Teams</a></li>
	<li><a href="#">Players</a></li>
	<li><a href="#">Matches</a></li>
</ul>
<div class="title-text">Teams</div>
<table id="information-table">
	<colgroup>
		<col style="width: 200px" />
		<col style="width: 200px" />
		<col style="width: 200px" />
		<col style="width: 50px" />
		<col style="width: 120px" />
		<col style="width: 70px" />
	</colgroup>
	<thead>
		<tr>
			<td>Team name</td>
			<td>Team coach</td>
			<td>Team sponsor</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<?php 
	$teams = new Teams();
	$all_teams_array = $teams->get_all_teams();
	
	if( ! empty($all_teams_array) )
	{
		foreach ($all_teams_array as $counter => $team) 
		{
			
	?>
		<tr data-id="<?= $team['id']?>" data-edit="false">
			<td class="team-name-cell editable"><?= $team['team_name']; ?></td>
			<td class="team-coach-cell editable"><?= $team['team_coach']; ?></td>
			<td class="team-sponsor-cell editable"><?= $team['team_sponsor']; ?></td>
			<td class="edit-team-cell"><a class="edit-btn" href="#">Edit</a></td>
			<td class="view-players-cell"><a href="#">View players</a></td>
			<td class="delete-cell"><a href="#"><a href="">Delete</a></td>
		</tr>
	<?php
		} 
	}
	?>
</table>
<div id="buttons-container">
	<input id="save-changes-btn" type="button" value="Save changes" />
	<input id="discard-changes-btn" type="button" value="Discard changes" />
</div>	
<div id="update-info-text">Heloo</div>		
<div id="dialog-confirm" title="Empty the recycle bin?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/my_script.js"></script>
<?php  
require_once 'html-snippets/footer.php';
