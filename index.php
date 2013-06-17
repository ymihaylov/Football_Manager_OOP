<?php 
	require_once 'Modules/Session.php';
	Session::start();
	if(Session::get('logged'))
	{
		header('Location: teams.php');
		die();
	}
	require_once("html-snippets/header-html.php");
?>
		<div id="login-form-container" class="form-container">
			<form id="login-form" action="/processes/login.php" method="POST">
				<input id="username-login" type="text" name="username" placeholder="username" required />
				<input id="password-login" type="password" name="password" placeholder="password" autocomplete="off" required />	
				<div id="login-btns-container" class="btns-container">
					<input id="login-btn" type="submit" name="submit" value="Login" />
					<a id="registration-btn" href="registration.php">Registration</a>
				</div>
				<div id="login-info-text" class="info-text"></div>
			</form>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/my_script.js"></script>
<?php  
require_once 'html-snippets/footer.php';

