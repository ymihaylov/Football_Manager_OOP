<?php
require_once ('../Modules/Authenticator.php');

$user_credentials = new Authenticator($_POST['username'], $_POST['password']);
$user_credentials->login();
header('Content-type: application/json');
echo json_encode($user_credentials->login());