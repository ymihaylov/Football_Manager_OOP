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
	<tbody>
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
	</tbody>
	<tfoot>
		<tr>
			<td class="team-name-cell editable"><input id="new-team-name" type="text" placeholder="Enter team name..." /></td>
			<td class="team-coach-cell editable"><input id="new-team-coach" type="text" placeholder="Enter team coach..." /></td>
			<td class="team-sponsor-cell editable"><input id="new-team-sponsor" type="text" placeholder="Enter team sponsor..." /></td>
			<td colspan="3"><a href="#"><input id="add-new-team-btn" type="button" value="Add new team" /></td>
		</tr>
	</tfoot>
</table>
<div id="buttons-container">
	<input id="save-changes-btn" type="button" value="Save changes" />
	<input id="discard-changes-btn" type="button" value="Discard changes" />
</div>
	<div id="update-info-text"></div>		

<div id="dialog-confirm" title="Delete this team?">
  <p>This team will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<?php  
require_once 'html-snippets/footer.php';
