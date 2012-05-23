<?php
		$server = "localhost";
		$username = "root"; // "root" ;
		$password = ""; // password if any
		$database = "custom_php_devise"; // where you want your table to save 
		
		//connecting to database
		
		$connection = mysql_connect($server, $username, $password) or die(mysql_error());
		$select = mysql_select_db($database) or die(mysql_error());		// selecting database
		
	
?>