<?

include("config.php");	// Including config.php file
include("includes/db_config.php");	// Including database connection
		
	mysql_select_db($database);	// select database
	
	session_start();	//session starts here
	
	if(isset($_POST['user_login'])=='user_login')	// user_login is the hidden variable value from Login form
	{
		 extract($_POST);	
		 $ip = $_SERVER['REMOTE_ADDR'];	//gets the ip address of the remote system.
		
		
		
		/* =========================Code for remember me field=========================== */
		
		$_SESSION['user_id']=$user_id;
		$_SESSION['password']=$password;
		
		if (isset($_POST['remember'])){

			setcookie("cookname", $_SESSION['user_id'], time()+3600, "/");
			
			setcookie("cookpass", $_SESSION['password'], time()+3600, "/");
		
		}
		
		
		
		
		/* ====================== code for checking the valid user ======================= */ 
		
		 date_default_timezone_set('Asia/Calcutta');
		 $last_login = date('y-m-d H:i:s');	//getting the last login time
		 $login = mysql_query("SELECT * FROM loginattempts WHERE IP = '".$ip."'");
	     $data = mysql_fetch_array($login);
		
		 $user = mysql_query("select * from devise_user_details where user_name = '".$user_id."' and user_password='".$password."'");
		 $row= mysql_num_rows($user);
		 
		 //gets the current time
		 $current_time= mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("y"));
		 $currenttime= date("Y-m-d H:i:s",$current_time); 
							
		 // if the user exists
		 if($row>0)	
		 {
		 		//lock the user if the current time is less than blocked time.
				if($currenttime < $data['blocked_time']){
					@header('Location:index.php?action=locked');
					
				}
			
				else{	 
					
					//if the time expires, update the blocked time to NULL.
					$null_blocked_time="UPDATE 
									loginattempts 
								SET 
									blocked_time=NULL
									
								WHERE 
									IP ='". $ip."'";
					
					mysql_query($null_blocked_time);
					
					
				
					$result = mysql_fetch_array($user);	
					$_SESSION['userid']=$result['user_id'];
					
					//works if ENABLE_SIGNINTIME_SIGNINCOUNT in config.php is enable
					if(ENABLE_SIGNINTIME_SIGNINCOUNT){
					
						signinCount($user_id);	//function call to store signin count and last login time in database.
						
					}
					 
					 
					 
					//if there are no rows in the loginattempts table
					if(mysql_num_rows($login) == 0){
						
						$success_attempt= "insert into loginattempts(IP,Attempts,LastLogin)values('$ip',0,'$last_login')";
						mysql_query($success_attempt);
						
					}
					
					//else update the attempts to '0' on successfull login.
					else{
						$success= "UPDATE 
										loginattempts 
								   SET
										Attempts = 0,
										IP='".$ip."',
										LastLogin='".$last_login."'
										
								  WHERE 
										IP ='". $ip."'";
								  
						mysql_query($success);
					}
					
					
					//redirects the user to user_page.php on successfull login.
					@header('Location:user_page.php');
				}
			
		 }
		
		//if the user does not exist!
		else	
		{
				//if there are no rows in the loginattempts table
				if(mysql_num_rows($login) == 0){
				
					$fail_attempt= "insert into loginattempts(IP,Attempts,LastLogin)values('$ip',1,'$last_login')";
					mysql_query($fail_attempt);
					
				}
				
				//else increment the failure attempts in Attempts column
				else{
					
					$fail= "UPDATE 
								loginattempts 
							SET 
								Attempts = Attempts+1,
								IP='".$ip."',
								LastLogin='".$last_login."'
								
							WHERE 
								IP ='". $ip."'";
								
					mysql_query($fail);
				}
				
				//Retreiving the Attempts from loginattempts table
				$attempts=mysql_query("select Attempts from loginattempts where IP='". $ip."'");
			
				$attempts_failed= mysql_fetch_array($attempts);
			
				//works if ENABLE_LOCKABLE in config.php is enable
				if(ENABLE_LOCKABLE){
					
					if($attempts_failed['Attempts'] > 3) {
						//Setting the unblocking time after 2minutes.
						$unlocking_time = mktime(date("H"),date("i")+2,date("s"),date("m"),date("d"),date("Y"));
						$unlock_time=date("y-m-d H:i:s", $unlocking_time);
						
						$blocked_time="UPDATE 
										loginattempts 
									SET 
										blocked_time='".$unlock_time."'
										
									WHERE 
										IP ='". $ip."'";
						
						$res=mysql_query($blocked_time);				       
					}
				}
			
				// redirect to login page if the user is not a valid user.
				@header('Location:index.php?action=failure');
		
		} 
	}	
	
	
	// code for token authentication
	if(isset($_POST['token_submit']) && ($_POST['token_submit'])== "Login with Token"){
		extract($_POST);
		$valid_token=mysql_query("select * from devise_user_details where token='".$token."'");
		
		// if the user exists
		if(mysql_num_rows($valid_token) > 0){
		
			$user_data= mysql_fetch_array($valid_token);
			$_SESSION['user_id'] = $user_data['user_name'];
			$_SESSION['password'] = $user_data['user_password'];
			
			//works if ENABLE_SIGNINTIME_SIGNINCOUNT in config.php is enable
			if(ENABLE_SIGNINTIME_SIGNINCOUNT){
				signinCount($_SESSION['user_id']);	//function call 
			}
			
			@header('Location:user_page.php');
			
		}
		
		// if the user does not exist
		else{
			@header('Location:index.php?action=token_fail');
		}
		
	}
	
	
	//function to calculate the signin count and last login time.
	function signinCount($user_id){
		date_default_timezone_set('Asia/Calcutta');			
		$signin_time= date('y-m-d H:i:s');
		
		$signin= "UPDATE 
							devise_user_details 
					   SET
							signin_count = signin_count+1,
							signin_time = '".$signin_time."' 
							
					   WHERE 
							user_name ='". $user_id."'";
		mysql_query($signin);
	}
	
	
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Custom PHP Devise</title>

		<!-- ==================== CSS file ==================== -->
        <link rel="stylesheet" href="includes/css/style.css" />
		
		<!-- ======================= Script files ========================= -->
        <script src="includes/js/jquery.js"></script>
        <script type="text/javascript" src="includes/js/jquery.validate.js"></script> 
        <script src="includes/js/bootstrap-alert.js"></script>
        
        <script type="text/javascript"> 
		
			$(document).ready(function() { 
				  
				   <? if(!ENABLE_TOKEN_AUTHENTICATION){ ?>
						$('#main').width("300");
						$('.loginform').width("300");
						$('#login_head').width("322");
				   <? } ?>
			   
			}); 
			
	  	</script> 



</head>

<body style="background:#F7FAFC;">
    
    <div id="main">
        <!-- ================ Error Messages =================== -->

			 <?
               if($_GET['action']=='failure')
               {
               ?>
               	<div class="alert alert-error">
                	<a class="close" data-dismiss="alert" href="#">&times;</a>
                    <b>Please give correct username and password</b>
                </div>
             <? } 
             
               if($_GET['action']=='locked')
               {
               ?>
               	 <div class="alert alert-error">
                 	<a class="close" data-dismiss="alert" href="#">&times;</a>
                    <b>You have been locked. Please try after 2 minutes.</b>
                 </div>
             <? } ?>
              
             <!-- ========== Executed when the account is deleted =============== -->
			<? if($_GET['action']=='deleted'){ ?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                  <h4>Your Account has been deleted successfully</h4>
                </div>
             <? } ?>
                 
        <!-- ============================= User Login Form =============================== -->
              
        <div id="login_head">
           <h1> Login </h1>
        </div>
                  
        <div class="loginform">
        
        	<div id="form_left">
            
                  <form action="index.php" method="post" id="login_form" name="login_form" >
                  
                       <input type="hidden" name="user_login" id="user_login" value="user_login">
                       
                       <!-- ======= Field for UserName ====== -->
                       <p>
                          <label>username</label>
                          <input type="text" id="user_id" name="user_id" value="<? echo $_COOKIE['cookname']; ?>" />
                       </p>
                       
                        <!-- ======= Field for Password ====== -->
                       <p>
                          <label>password</label>
                          <input type="password" name="password" id="password" value="<? echo $_COOKIE['cookpass']; ?>" />
                       </p>
                       
                       <p class="links">
                       		
						  <? if(ENABLE_REMEMBER){ ?>
                            
                           	 <!-- ======= Field for Remeber me ====== -->
                             <p class="check">
                                <input type="checkbox" id="remember" name="remember" />
                              	<label class="checkbox">Remember Me</label>
                           	 </p>
                                 
                          <? }  ?>
                            
                          <p class="signup">
                            
                             <!-- ======= Sign Up Link====== -->
                              
							 <? if(ENABLE_SIGNUP){ ?>
                             
                                 <a href="user_registration.php">Signup</a><br />
                             <? } 
														  
							 ?>
                                  
                             <!-- ======= Forgot Password Link ====== -->
                             <? if(ENABLE_FORGOT_PASSWORD){ ?>
                                  <a href="forgot_password.php">Forgot Password</a>
                             <? } ?>
                                  
                          </p>
                            
                        </p>
                        
                       <!-- ======= Login Button ====== -->
                       <div class="button">
                          <input type="submit" value="Login" class="btn"/>
                       </div>
                                            
              	</form>
                  
          </div><!-- End of #form_left div -->
          
          
          <!-- ==================Code for token authentication====================== -->
          
          <? if(ENABLE_TOKEN_AUTHENTICATION){ ?>
          
         	 <div id="form_right" >
             
                <form action="index.php" method="post" id="token_auth" name="token_auth" >
                    <p>
                        <label>Do you want to Login using your access token?</label>
                        <?
                           if($_GET['action']=='token_fail')	// if the entered token is incorrect!
                           {
                           ?>
                                <b>Enter a valid Token</b><br />
                        <?  } ?>
                        
                        <label>Enter your Access Token</label>
                        <input type="password" name="token" id="token"/>
                    </p>
                    
                    <p>
                        <input type="submit" value="Login with Token" name="token_submit" id="token_submit" class="btn"/>
                    </p>
                </form>
                
              </div>
              
           <? } ?>
        
            
      	 </div><!-- End of login form div -->
               
  	 </div><!-- End of main div -->
   
</body>
</html>


