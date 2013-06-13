<?php 
require_once "../Modules/Registrator.php";
require_once "../Modules/Database.php";

$db = Database::getInstance();
$reg = new Registrator($db, $_POST['username'], $_POST['password'], $_POST['password-retype']);
header('Content-type: application/json');
echo json_encode($reg->validate());
