<?

include("includes/db_config.php");	// Including database connection
include("config.php");

            mysql_select_db($database);
		
			// insert a record	
			if(isset($_POST['reg_form'])=='reg_form')
			{	
			
			
				extract($_POST);
				
				$ip = $_SERVER['REMOTE_ADDR'];
				
				// if the email already exists in the database , it returns failure else inserts the record.
				$verify_email= mysql_query("select * from devise_user_details where user_email = '".$email."'");
				$email_rows= mysql_num_rows($verify_email);
				
				if($email_rows>0)
				{
					@header('Location:user_registration.php?action=failure');
				}
								 				 
				else	
				{
						//generating the token randomly based on the password
						
						$char = strtoupper(substr(str_shuffle($password), 0, 3));
						$token = rand(1, 8) . $char . rand(1,8);
						
						// inserting the user details into database.
						
						$sql_2="insert into devise_user_details(user_firstname,user_lastname,user_name,user_email,user_password,user_ipaddress,token)
					values('$firstname','$lastname','$username','$email','$password','$ip','$token')";  
					
						mysql_query($sql_2);
						
						
						// sends confirmation mail to rhe user after successfull registration
						if(ENABLE_CONFIRM_MAIL)
						{	
							$sendTo = $email;
							$subject = "Registration Confirmation";
							$message = "\nDear " . $username;
							$message .= "\nThank you for registering. Your log in information is as follows:";
							$message .= "\nUsername: " . $username;
							$message .= "\nPassword: " . $password;
							$message .= "\nYou can directly access your account using a single Access Token";
							$message .= "\nYour Access Token is: " . $token;
							$message .= "\n\n\n This is an auto generated mail. Don't reply to this mail.";
							$from = "notification@yahoo.com";
							$headers = "From:". $from;
							$bool=mail($sendTo,$subject,$message,$headers);
							if($bool)
							{
								 @header('Location:user_registration.php?action=success');
							}
							else
							{
								@header('Location:user_registration.php');
							}
						}
						
						@header('Location:user_registration.php?action=success');
										
					
					
				}
				
				
		}
			
		
?>            


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
<head> 
	<title>User Details </title> 
 </head>
 
 <body>
 </body>
 </html>
    
