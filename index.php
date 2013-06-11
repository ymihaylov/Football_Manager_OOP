<?php 
	require_once 'Session.php';
	Session::start();
	if(Session::get('logged'))
	{
		header('Location: teams.php');
		die();
	}
	
	require_once 'Authenticator.php';
	require_once("html-snippets/header-html.php");

	if(isset($_POST['submit']))
	{
		$user_credentials = new Authenticator($_POST['username'], $_POST['password']);
	
		if($user_credentials->login())
		{
			Session::set('current-user', $user_credentials->login());
			Session::set('logged', true);
			Session::set('failed-login', false);
			header('Location: teams.php');
		}
		else
		{
			Session::set('failed-login', true);
		}
	}
?>
<body>
	<div id="page-container">
		<h1>Football Manager</h1>
		<div id="login-form-container">
			<form id="login-form" action="" method="post">
				<input type="text" name="username" placeholder="username" required />
				<input type="password" name="password" placeholder="password" autocomplete="off" required />	
				<input type="submit" name="submit" value="Login" />
				<?php if (Session::get('failed-login')===true) 
				{ 
				?>
				<div id="login-failed-text">Wrong username or password!</div>
				<?php 
				} 
				?>
			</form>
		</div>
	</div>
</body>
</html>

