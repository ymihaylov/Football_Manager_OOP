<?php
require_once ('../Modules/Authenticator.php');
require_once ('../Modules/Session.php');

$user_credentials = new Authenticator($_POST['username'], $_POST['password']);
$returned_array = $user_credentials->login();

if($returned_array['logged']) {
	Session::start();
	Session::set('logged', true);
	Session::set('username', $returned_array['username']);
}
header('Content-type: application/json');
echo json_encode($returned_array);