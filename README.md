Custom-PHP-Devise
=================

Custom-PHP-Devise is an inspiration from Rails Devise. This provides login and registration process with flexible authentication and this application is built on core PHP.



1.ABOUT THIS APPLICATION

******************************************

 Custom-PHP-Devise application is a flexible authentication solution built on core PHP.

 It is composed of the following features:


    Database Authenticatable:  validate the authenticity of a user while signing in. 

    Token Authenticatable: signs in a user based on an authentication token (also known as "single access token"). The token can be given both through query string or HTTP   		Basic Authentication.

    Confirmable: sends emails with confirmation instructions and verifies whether an account is already confirmed during sign in.

    Recoverable: resets the user password and sends it to the user email address.

    Registerable: handles signing up users through a registration process, also allowing them to edit and destroy their account.

    Rememberable: manages generating and clearing a token for remembering the user from a saved cookie.

    Trackable: tracks sign in count, timestamps and IP address and stores them  in the database.

    Timeoutable: expires sessions that have no activity in a specified period of time.

    Validatable: provides validations of every field in the form. It's optional and can be customized, so you're able to define your own validations.

    Lockable: locks an account after a specified number of failed sign-in attempts. Can unlock after a specified time period.

    Configuration: There is an ON/OFF functionality for the above all features in config.php file (This is done by commenting and uncommenting the variables). You can use the 	             features which are necessory for you.

   Custom-PHP-Devise is an inspiration from Devise gem built for Rails. Hyperlink for Rails Devise https://github.com/plataformatec/devise


2.INSTALLATION

******************************************

Edit the file db_config.php in the includes folder and update the configuration information (with your host name, db username, db password ) 

To create 'devise_user_details' Table and Login attempts table : Uncomment the below block in the table.php file.


-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------		


3.REQUIREMENTS

******************************************
You must have PHP 5.0 or greater installed.

In php.ini file , uncomment the following for mailing purpose:

	
	; SMTP =  your server name
	; smtp_port = 25


4.WHAT THIS APPLICATION CONTAINS

******************************************

Below is a list of files used in this application:

index.php - This is the file for user login form

user_register.php - This is the file for Registration form with all  JQuery validations.

insert_user.php - In this file, we will insert the registered users into database and also we will send the confirmation mail to the user. You can change the from address as needed.

forgot_password.php - In this file, if the user enters his email address then the user password will be sent to his email.

user_page.php - In this file, User details will be displayed . We can edit and delete the user account.

logout.php - In this file , the session will be destroyed and redirects  to index.php page. 

config.php - In this file, we can have on/off  functionality  for the Custom-PHP-Devise features.

includes/css - this file contains the  StyleSheet used to beautify our application.

includes/images - this file contains all relevant images included in this application.

includes/js - this file contains all js file that is included in the application.




<img style="max-width:100%;" src="https://github.com/lavanya-nyros/Custom-PHP-Devise/raw/master/screenshots/login.JPG
" alt="login" title="login">



<img style="max-width:100%;" src="https://github.com/lavanya-nyros/Custom-PHP-Devise/raw/master/screenshots/profile.JPG
" alt="profile" title="profile">






