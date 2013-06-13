<?php
require_once ('../Modules/Authenticator.php');

$user_credentials = new Authenticator($_POST['username'], $_POST['password']);

if($user_credentials->login())
{
	echo "LoggedIn";
}
else
{
	echo "Login failed";
}