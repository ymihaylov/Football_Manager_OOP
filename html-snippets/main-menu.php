<?php  
	function set_current_class($ask_page)
	{
		global $this_page;
		if($ask_page === $this_page)
		{
			return "class='current'";
		}
		else 
		{
			return;
		}
	}
?>
<ul id="main-menu">
	<li><a href="teams.php" <?= set_current_class('teams') ?>>Teams</a></li>
	<li><a href="players.php" <?= set_current_class('players') ?>>Players</a></li>
	<li><a href="#" <?= set_current_class('Matches') ?>>Matches</a></li>
</ul>