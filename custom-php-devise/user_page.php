<?

		include("config.php");	// Including config.php file
		include("includes/db_config.php");	// Including database connection
				
		mysql_select_db($database);	// select database
				 
		
		//on pageload
		session_start();
		
		if(!isset($_SESSION['userid']) && !isset($_SESSION['user_id']))	// if the user id does not exist!
		{
			@header('Location:index.php');	// redirects to the index page i.e., login page
		}

	 
	  	// deleting a record
		if(isset($_GET['action']) && ($_GET['action'])== "remove")
		{
			$delete_user="DELETE FROM devise_user_details WHERE user_id = ".$_GET['usersid'];
			mysql_query($delete_user);
			@header("location:index.php?action=deleted");
		}
	 
	 	// update a record
		if(isset($_POST['update']) && ($_POST['update'])== "Save Changes"){
			extract($_POST);
			
			 $quey = "UPDATE 
								devise_user_details 
							SET
								user_firstname = '" .$firstname. "',
								user_lastname = '" .$lastname. "',
								user_email = '" .$email. "'
								
							WHERE
								user_id = " .$user_id; 
								
			 mysql_query($quey);
			 
			@header('Location:user_page.php');	
		}
			
			
		 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User page</title>

      	<!-- ================ CSS files ===================== -->
        <link href="includes/css/style.css" rel="stylesheet">
        
		<!-- ================ Script files ===================== -->
		<script type="text/javascript" src="includes/js/jquery.js"></script>
        <script type="text/javascript" src="includes/js/jquery.validate.js"></script>
        <script type="text/javascript" src="includes/js/update_form_validation.js"></script>
		<script type="text/javascript" src="includes/js/jquery.idle-timer.js"></script>
       
		<script type="text/javascript">
			<!-- ========== Code for session expiration =========== -->
			<? if(ENABLE_SESSION_EXPIRATION){ ?>
				(function($){
				  //Session expires after 1 minute of idle time
					var timeout = 60000;
				   
					   $(document).bind("idle.idleTimer", function(){
							alert('Your session has expired. You need to login again');
							window.location.href = 'logout.php';
						});
					
					$.idleTimer(timeout);
					
				})(jQuery);
			<? } ?>
    
    	</script>
       
</head>

<body style="background:#F7FAFC;">
	<div id="main_div">
    
		<!-- ========== Header Part =============== -->
        <div class="navbar">
            <div class="navbar-inner" style="background:#0088CC">
              <div class="container">
                <a class="brand" href="#">Custom-PHP-Devise</a>
                <div class="nav-collapse">
                   <ul class="nav pull-right">
                   
                   <? if($_GET['action']!='deleted'){ ?>
                   		 <li><a href="#" style="color:white;font-weight:bold;">Hi, <? echo $_SESSION['user_id']; ?></a></li>
                    <? } ?>
                    
                    <li><a href="logout.php" style="color:white;font-weight:bold;">logout</a></li>
                   </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
        </div>
	
    
    	<div class="clear"></div>
    
    	<div id="user_content">

    	<!-- ======================== User Profile ========================= -->
    	<? if($_GET['action']!='deleted'){ ?>
        <div id="heading">
            <h2>Your Profile</h2>
            <hr />
        </div>
    
    
    	<!-- ======================= User Details div ======================= -->
        <div id="user_details">
           <?
		   
             //Retreiving the details of the user who is logged in.
			
			$user_details = mysql_query("select * from devise_user_details where user_name = '".$_SESSION['user_id']."' and user_password='".$_SESSION['password']."'");
			
			$row= mysql_num_rows($user_details);
			
			 if($row>0)	// if user exists
			 {
				$result = mysql_fetch_array($user_details); ?>
                
				<? if(ENABLE_EDIT_DELETE){ ?>
                
                     <div class="edit">
                     
                        <? if(!isset($_REQUEST['action']) && ($_REQUEST['action']!=='edit')){ ?>
                     
                            <a href="user_page.php?action=edit&userid=<? echo $result['user_id']; ?>" class="btn btn-info" >
                            <i class="icon-pencil icon-white"></i> Edit Profile</a>
                        
                        <? } ?>
                        
                        <a href="user_page.php?action=remove&usersid=<? echo $result['user_id']; ?>" class="btn btn-danger delet">
                        <i class="icon-trash icon-white"></i> Delete Account</a>
                         
                     </div>
                 <? } ?>
                
                
                <!-- ===============Displaying the user details========================= -->
                
                 <? if(!isset($_REQUEST['action']) && ($_REQUEST['action']!=='edit')){
                 
                 ?>
                     <table>
                      	<tr>
                            <td>First Name: </td><td> <? echo $result['user_firstname']; ?></td>
                        </tr>
                        
                         <tr>
                            <td>Last Name: </td><td> <? echo $result['user_lastname']; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Email: </td><td> <? echo $result['user_email']; ?></td>
                        </tr>
                       
                      </table>
              <? } } ?>
                    

            <!-- ======================== Update Form ========================= -->
              <?
			  
                // executed when the action is edit
				
                if(isset($_REQUEST['action']) && ($_REQUEST['action']=='edit'))
                {
                    $user_id = $_REQUEST['userid']; 
                                    
                        $sql = "SELECT * FROM devise_user_details WHERE user_id = '".$user_id."'"; 
                        $res = mysql_query($sql);
                        while($get_result = mysql_fetch_array($res))
                        {
                         ?>
                        <form id="update_form" name="update_form" method="post" action="" style="margin-top: 30px;">
                    
                            <input type="hidden" name="user_id" value="<? echo $get_result['user_id']; ?>"/> 
                                
                             <p>
                                <label>First Name:</label>
                                <input name="firstname" type="text" id="firstname"  value="<? echo $get_result['user_firstname']; ?>" />
                            </p>
                            
                             <p>
                                <label>Last Name:</label>
                                <input name="lastname" type="text" id="lastname"  value="<? echo $get_result['user_lastname']; ?>" />
                            </p>    
                                                        
                            <p>
                                <label>Email:</label>
                                <input name="email" type="text" id="email"  value="<? echo $get_result['user_email']; ?>" />
                            </p>
                            
                            
                            <p style="margin-right:35px;">
                                <input type="submit" name="update"  id="update" class="btn" value="Save Changes"/>
                            </p>
                        
                        </form>
                    
            <?	}	} ?>
                
        </div><!-- end of user_details div -->
       
        
        <? } ?>
        </div>
        
        <div id="footer">
        </div>

</div><!-- end of main_div -->

</body>
</html>
