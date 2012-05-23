<?php
	
	// Destroys the session and redirects to the index.php page
	
	session_start();
	session_destroy();
	@header('Location:index.php');
	
?>