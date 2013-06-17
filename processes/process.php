<?php 
require_once '../Modules/Registrator.php';
require_once '../Modules/Database.php';

$db = Database::getInstance();
$reg = new Registrator($db, $_POST['username'], $_POST['password'], $_POST['password-retype']);

$returned_array = $reg->validate();
if($returned_array['registred']) 
{
	require_once '../Modules/Session.php';
	Session::start();
	Session::set('logged', true);
	Session::set('username', $returned_array['username']);
}

header('Content-type: application/json');
echo json_encode($returned_array);
