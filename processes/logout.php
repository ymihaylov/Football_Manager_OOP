<?php  
require_once '../Modules/Session.php';
Session::start();
Session::set('logged', false);
Session::set('username', '');
header('Location: ../index.php');
die();


