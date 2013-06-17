<?php 
require_once("html-snippets/header-html.php");
?>
		<div id="registration-form-container" class="form-container">
			<form id="registration-form" action="/processes/process.php" method="post">
				<input id="username-reg" type="text" name="username" placeholder="username" required />
				<input id="password-reg" type="password" name="password" placeholder="password" autocomplete="off" required />
				<input id="password-retype-reg" type="password" name="password-retype" placeholder="re-type password" autocomplete="off" required />	
				<div id="registration-btns-container" class="btns-container">
					<input id="registrer-btn" type="submit" name="submit" value="Register" />
					<a id="back-to-index-btn" href="index.php">Back to login page</a>
				</div>
				<div id="reg-info-text" class="info-text"></div>
			</form>
		</div>
	</div>
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/my_script.js"></script>
<?php  
require_once 'html-snippets/footer.php';