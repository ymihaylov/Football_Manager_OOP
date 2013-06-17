<?php  
	require_once 'Modules/Session.php';
	Session::start();
	Session::check_for_logged_user();

	require_once("html-snippets/header-html.php");
	require_once("html-snippets/greetings.php");

?>

<?php  
require_once 'html-snippets/footer.php';