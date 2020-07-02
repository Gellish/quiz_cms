$(document).ready(function(){
	//Form Validation (Common Question Set Create)
	$("#question_set").validate({  
		rules:{
			'chapter_id[]': {
                required: true
            },
			no_of_question:{required:true}
		},
		messages:{
			'chapter_id[]': {
                required: "Select Atleast One Chapter"
            },
			no_of_question:{
				required:"Enter Number of Question"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$(".error_message").html(message); 
			$(".error_message").show();        
		} else {
			$(".error_message").hide();        }
		}           
	});
});
// Registration Form validation
 $(document).ready(function(){ 
 
	$("#userRegistration").validate({  
		rules:{
			full_name:{required:true,minlength: 6},
			username:{required:true,email: true,
				remote: {
				  url: $("#baseUrl").val()+"front/Signup/register_email_exists",
				  type: "post",
				  data: {
					email: function(){ return $("#username").val(); }
				  }
				}
			},
			mobile:{required:true,minlength: 10,number: true},
			password:{required:true,minlength: 6},
			con_pass:{required:true,equalTo: "#password"},
			user_type:{required:true}
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "user_type")
			{
			 error.insertAfter("#radioError");
			}else{
				error.insertAfter(element);
			}
		},
		messages:{
			full_name:{
			required:"Enter Your Full Name",
			minlength:"Full name must be minimum 6 characters"},
			username:{
				required:"Enter your email address",
				email:"Enter valid email address",
				remote:"Email already used. Log in to your existing account !"},
			mobile:{
				required:"Enter Your Mobile Number",
				minlength:"Mobile Number must be minimum 10 characters"},
			password:{
				required:"Enter password",
				minlength:"Password must be minimum 6 characters"},
			con_pass:{
				required:"Enter confirm password",
				equalTo:"Password and Confirm Password Doesn't match"},
			user_type:{required:"Select user Type"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();  }
		}           
	});	
}); 
// Signin Form validation
 $(document).ready(function(){ 
 
	$("#signInForm").validate({  
		rules:{
			username:{required:true,email: true},
			password:{required:true}
		},
		messages:{
			username:{
				required:"Enter email address",
				email:"Enter valid email address"},
			password:{required:"Enter password"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();  }
		}           
	});	
}); 

// Change Password
 $(document).ready(function(){ 
 
	$("#change_password").validate({  
		rules:{
			old_pass:{required:true},
			new_pass:{required:true,minlength: 6},
			again_new_pass:{required:true,equalTo: "#new_pass"}
		},
		messages:{
			old_pass:{
				required:"Enter old password"},
			new_pass:{
				required:"Enter new password",
				minlength:"New password must be minimum 6 characters"},
			again_new_pass:{
				required:"Enter confirm new password",
				equalTo:"New password and again new password doesn't match"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();  }
		}           
	});	
});
// User Full Name  Edit
 $(document).ready(function(){ 
 
	$("#user_full_name_edit").validate({  
		rules:{
			full_name:{required:true,minlength: 6},
			password:{required:true}
		},
		messages:{
			full_name:{
			required:"Enter Your Full Name",
			minlength:"Full name must be minimum 6 characters"},
			password:{
				required:"Enter password"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();  }
		}           
	});	
});


// User Phone Number   Edit
 $(document).ready(function(){ 
 
	$("#user_cellno_edit").validate({  
		rules:{
			mobile_no:{required:true,minlength: 10,number: true},
			password:{required:true}
		},
		messages:{
			mobile_no:{
				required:"Enter Your Mobile Number",
				minlength:"Mobile Number must be minimum 10 characters"},
			password:{
				required:"Enter password"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();  }
		}           
	});	
});


// User Account Edit Button disable/enable
 $(document).ready(function(){    
 
	$("input:password[name='password']").keyup(function(){
		var value = $(this).val();
		//alert(value);
		
		if(value!=''){
		  $('#user_info_change').removeAttr('disabled');
		}else if(value==''){
		 $('#user_info_change').attr('disabled','disabled');
		}
	}); 
});
