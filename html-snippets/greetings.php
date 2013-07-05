<?php  
	require_once 'Modules/Session.php';
	Session::start();
?>
<div class="welcome-text">
	Welcome, <?= Session::get('username');  ?>!
	<a class="logout-link" href="/processes/logout.php">[ Logout ]</a>
</div>