$(document).ready(function(){    
	
	//Form Validation (Add Class)
	$("#class_add").validate({  
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();        }
		}           
	});

	//Form Validation (Add Course)
	$("#course_add").validate({  
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();        }
		}           
	});
	
	//Form Validation (Add Operator)
	$("#add_operator").validate({  
		rules:{
			operatorName:"required",
			operatorEmail:{required:true,email: true},
			password:{required:true,minlength: 6},
			con_pass:{required:true,equalTo: "#password"}
		},
		messages:{
			operatorName:"Enter Operator Full Name",
			operatorEmail:{
			required:"Enter your email address",
			email:"Enter valid email address"},
			password:{
			required:"Enter your password",
			minlength:"Password must be minimum 6 characters"},
			con_pass:{
			required:"Enter confirm password",
			equalTo:"Password and Confirm Password Doesn't match"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();        }
		}           
	});
	//Form Validation (Add Tutor)
	$("#add_tutor").validate({  
		rules:{
			tutorName:"required",
			tutorEmail:{required:true,email: true},
			password:{required:true,minlength: 6},
			con_pass:{required:true,equalTo: "#password"}
		},
		messages:{
			tutorName:"Enter Tutor Full Name",
			tutorEmail:{
			required:"Enter Tutor email address",
			email:"Enter valid email address"},
			password:{
			required:"Enter Tutor password",
			minlength:"Password must be minimum 6 characters"},
			con_pass:{
			required:"Enter confirm password",
			equalTo:"Password and Confirm Password Doesn't match"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();        }
		}           
	});
	//Form Validation (Edit Operator)
	$("#operator_edit").validate({  
		rules:{
			password:{required:false,minlength: 6},
			con_pass:{required:false,equalTo: "#password"}
		},
		messages:{
			password:{
			required:"Enter Operator password",
			minlength:"Password must be minimum 6 characters"},
			con_pass:{
			required:"Enter confirm password",
			equalTo:"Password and Confirm Password Doesn't match"}
		},
		invalidHandler: function(form, validator) { 
		var errors = validator.numberOfInvalids();
		if (errors) {  
			var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
			$("div.error span").html(message); 
			$("div.error").show();        
		} else {
		$("div.error").hide();        }
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