<?
	include("includes/db_config.php");	// Including database connection
	
	mysql_select_db($database);	//selecting database
	
	
	if(isset($_POST['forgot'])=='forgot')
	{
		 extract($_POST);
		 
		 $user_email = mysql_query("select * from devise_user_details where user_email = '".$email."'");
		 $row= mysql_num_rows($user_email);
		 
		 if($row>0)	// if email exists
		 {
					
			$result= mysql_fetch_array($user_email);	
			
			$sendTo = $email;
			$subject = "Password Information";
			$message = "\nDear " . $result['user_name'];
			$message .= "\nYour account information is:";
			$message .= "\nUsername: " . $result['user_name'];
			$message .= "\nPassword: " . $result['user_password'];
			$message .= "\n\n\n This is an auto generated mail. Don't reply to this mail.";
			$from = "notification@yahoo.com";
			$headers = "From:". $from;
			$verify_mail=mail($sendTo,$subject,$message,$headers);		// sends password to the specified mail id		
			
			if($verify_mail)
				@header('Location:forgot_password.php?action=success');
				
		 }
		else	
		{
			@header('Location:forgot_password.php?action=failure');
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forgot Password</title>
		<!-- ================ CSS files ===================== -->
        <link href="includes/css/style.css" rel="stylesheet">
        
        <!-- ================ Script files ===================== -->
		<script type="text/javascript" src="includes/js/jquery.js"></script>
        <script type="text/javascript" src="includes/js/jquery.validate.js"></script> 
        <script src="includes/js/bootstrap-alert.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#forgot_password").validate({
                        rules: { 
                          email: "required"
                        }
                }); 
            });
        </script>
</head>

<body style="background:#F7FAFC;">
<div id="forgot_main">

	<!-- ================ Header Part ===================== -->
    <div class="navbar">
        <div class="navbar-inner" style="background:#0088CC">
          <div class="container">
            <a class="brand" href="#">Custom-PHP-Devise</a>
            <div class="nav-collapse">
               <ul class="nav pull-right">
                <li><a href="index.php" style="color:white;font-weight:bold;">Login</a></li>
               </ul>
            </div><!-- /.nav-collapse -->
          </div>
        </div><!-- /navbar-inner -->
    </div>
    
    <div class="clear"></div>
    
    <div id="heading">
        <h3>Forgot your password?</h3>
        <hr />
    </div>
   
    <div id="forgot">
    
        <form action="forgot_password.php" id="forgot_password" method="post">
            <input type="hidden" name="forgot" id="forgot" value="forgot" />
            <label> Enter your Email address: </label>
            <input id="email" name="email" type="text" placeholder="Enter your Email" />
            <input type="submit" class="btn" value="Submit" />
        </form>
        
         <?
           if($_GET['action']=='success')
           {?>
                 <div class="alert alert-success" style="width:300px;">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                  <b>Password has been sent to your mail</b>
                </div>
         <?  } 
        
           if($_GET['action']=='failure')
           {?>
                <div class="alert alert-error" style="width:315px;">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                   <b>Please give correct email address</b>
                </div>
         <?  } ?>
         
     </div>
     
     <div id="footer">
     </div>
     
  </div>
    
</body>
</html>
