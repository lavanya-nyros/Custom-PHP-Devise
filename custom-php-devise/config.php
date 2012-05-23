<?php 

// This config.php file provides the on/off functionality of the Custom-PHP-Devise features.

// By commenting the following variables , that respective Custom-PHP-Devise feature will be disabled.

// By uncommenting the following variables , that respective Custom-PHP-Devise feature will be enabled.



	$Signup = "require";
	
	$forgot_password = "require";
	
	$remember = "require";
	
	$edit_delete = "require";
	
	$confirm_mail = "require";
	
	$signintime_signincount = "require";
	
	$session_expiration = "require";
	
	$token_authentication = "require";
	
	$lockable = "require";
	
	
	
	
	// Defining the above variables
	
	if($Signup == "require")
		define('ENABLE_SIGNUP',TRUE); 
	else
		define('ENABLE_SIGNUP',FALSE); 
	
	
	if($forgot_password == "require")
		define('ENABLE_FORGOT_PASSWORD',TRUE);
	else
		define('ENABLE_FORGOT_PASSWORD',FALSE);
	
	if($remember == "require")
		define('ENABLE_REMEMBER',TRUE);
	else
		define('ENABLE_REMEMBER',FALSE);
		
	if($edit_delete == "require")
		define('ENABLE_EDIT_DELETE',TRUE);
	else
		define('ENABLE_EDIT_DELETE',FALSE);
		
		
	if($confirm_mail == "require")
		define('ENABLE_CONFIRM_MAIL',TRUE);
	else
		define('ENABLE_CONFIRM_MAIL',FALSE);
		
		
	if($signintime_signincount == "require")
		define('ENABLE_SIGNINTIME_SIGNINCOUNT',TRUE);
	else
		define('ENABLE_SIGNINTIME_SIGNINCOUNT',FALSE);
		
	
	if($session_expiration == "require")
		define('ENABLE_SESSION_EXPIRATION',TRUE);
	else
		define('ENABLE_SESSION_EXPIRATION',FALSE);
		
	
	if($token_authentication == "require")
		define('ENABLE_TOKEN_AUTHENTICATION',TRUE);
	else
		define('ENABLE_TOKEN_AUTHENTICATION',FALSE);
		
	
		
	if($lockable == "require")
		define('ENABLE_LOCKABLE',TRUE);
	else
		define('ENABLE_LOCKABLE',FALSE);

	
	
?>
