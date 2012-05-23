<!DOCTYPE html PUBLIC "-//W3Czz//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
	<html> 
	  <head> 
	  <title>User Registration</title> 
      
      <!-- ======================= CSS file ========================= -->
      <link rel="stylesheet" href="includes/css/style.css" />
      
      <!-- ======================= Script files ========================= -->
	  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
	  <script type="text/javascript" src="includes/js/jquery.validate.js"></script> 
      <script src="includes/js/bootstrap-alert.js"></script>
       
    
 </head> 
 
 
 <body style="background:#F7FAFC;"> 
 <div id="reg_main">
 	
    <!-- ======== Header part ======= -->
   	 <div class="navbar">
        <div class="navbar-inner" style="background:#0088CC">
          <div class="container">
            <a class="brand" href="#">Custom-PHP-Devise</a>
            <div class="nav-collapse">
               <ul class="nav pull-right">
                <li><a href="index.php" style="color:white;font-weight:bold;text-decoration:underline">Login</a></li>
               </ul>
            </div><!-- /.nav-collapse -->
          </div>
        </div><!-- /.navbar-inner -->
     </div><!-- /.navbar -->
    
    
     
     <!-- ===========================Content div starting=========================== -->
     <div id="content">
     
         <div class="registration">
          
            <h3>Create your own account</h3><br />
              
            <form id="registration_form" name="registration_form" method="post" action="insert_user.php" enctype="multipart/form-data" >
             
             
                <!-- hidden type for checking the condition while inserting the data-->
                <input type="hidden" name="reg_form" id="reg_form" value="reg_form" /> 
               
                <!-- ======= FirstName ====== -->
                <p>
                    <label>First Name *</label>
                    <input type="text" name="firstname" placeholder="First Name" />
                </p>
                
                 <!-- ======= LastName ====== -->
                <p>
                    <label>Last Name *</label>
                    <input type="text" name="lastname" placeholder="Last Name" />
                </p>
                
               <!-- ======= UserName ====== -->
                <p>
                    <label>username *</label>
                    <input type="text" name="username" placeholder="username" />
                </p>
               
               
               <!-- ======= Email Address ====== -->
                <p>
					 <?php 
                        if($_GET['action'] == "failure")	// executed when the records are successfully inserted
                        { ?>
                            <h5 style="color:red; float: right;">your email already exists</h5>
                    <?php 	} ?>
                    <label for="email">Email *</label>
                    <input id="email" name="email" type="text" placeholder="Email Address"/>
                    
                </p>
                
                
                
                <!-- ======= Password  ====== -->
                <p>
                    <label for="password">Password *</label>
                    <input id="password" name="password" type="password" placeholder="Password" />
                </p>
                
                 <!-- ======= Confirm Password  ====== -->
                <p>
                
                    <label for="confirm_password">Confirm Password *</label>
                    <input id="confirm_password" name="confirm_password" type="password" placeholder="Repeat Password" />
                
                </p>
                
               
                <!-- Submit button -->
                <div class="reg_button">
                       <input class="submit btn" type="submit" name="submit" value="Create an account" s><br /><br />
                </div>
                  
            </form> 
                
          </div>
          
          
          <!-- =================== Displays message on successfull registration ================= -->
           <div id="right_panel">
              <?php 
					if($_GET['action'] == "success")	// executed when the records are successfully inserted
					{ ?>
                    	<div class="alert alert-success">
                        	<a class="close" data-dismiss="alert" href="#">&times;</a>
						  <h4>You have registered successfully</h4>
                            <p>Your account details are sent to your mail</p>
                            <p>You can Login now</p>
                        </div>
		     <?php 	} ?>
              
           </div>
       
          
        </div><!-- End of Content div -->
        
        <!-- ==footer== -->
        <div id="footer">
        	
        </div>
      
   </div><!-- main div closing -->
 </body>
   
</html> 
