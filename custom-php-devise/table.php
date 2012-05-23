<?php
	include("includes/db_config.php");	// including the database


	mysql_select_db($database);	// selecting the database
 


	/*
		// Table for storing the registered user details
		 $devise_user_details = "CREATE TABLE `devise_user_details` (
									`user_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
									`user_firstname` VARCHAR( 30 ) NOT NULL,
									`user_lastname` VARCHAR( 30 ) NOT NULL,
									`user_name` VARCHAR( 30 ) NOT NULL,
									`user_email` VARCHAR( 30 ) NOT NULL,
									`user_password` VARCHAR( 30 ) NOT NULL,
									'user_ipaddress' varchar(20) DEFAULT NULL,
									'signin_count' int(11) DEFAULT 0,
									'signin_time' datetime DEFAULT NULL,
									'token' varchar(50) DEFAULT NULL
								)";
	 
		mysql_query($devise_user_details) or die(mysql_error());
		
		
		
		//Table for storing the failure login attempts
		$loginattempts = "CREATE TABLE `loginattempts` (
									`IP` varchar(20),
									`Attempts` int(11),
									`LastLogin` DATETIME,
									`blocked_time` DATETIME default NULL
								)";
	 
		mysql_query($loginattempts) or die(mysql_error());
		
	*/
	 
?>












