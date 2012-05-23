// JavaScript Document

$(document).ready(function(){
				$('.delet').click(function(){
					if(confirm("Do you want to delete your account"))
						return true;
					else
						return false;
				});
			
				
				 $("#update_form").validate({ 	// validating form1
						rules: {
							firstname: {
								required: true,
								minlength: 2
							},
							lastname: {
								required: true,
								minlength: 2
							},
							email: {
								required: true,
								email: true
							}
							
						},
						messages: {
							
							firstname: {
								required: "Please enter firstname",
								minlength: "Your firstname must consist of at least 2 characters"
							},
							
							lastname: {
								required: "Please enter lastname",
							},
							email: {
								required: "Please enter email",
								email: "Please enter a valid email address"
							}
							
						}
						 
						
				 }); 
			
				
				
});