$(document).ready(function(){    
	
	//Form Validation (Question Add And Update)
	$("#tutor_question_from").validate({  
		rules:{
			class_id:"required",
			course_id:"required",
			chapter_id:"required",
			questionName:"required",
			language:"required",
			answerType:"required"
		},
		messages:{
			class_id:"Select Class Name",
			course_id:"Select Course Name",
			chapter_id:"Select Chapeter Name",
			questionName:"Enter Question name",
			language:"Select Language",
			answerType:"Select Anster Type"
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

 $(document).ready(function(){    
	
	//Form Validation (Question Add And Update)
	$("#course_request_form").validate({  
		rules:{
			class_id:"required",
			courseName:"required"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "class_id")
			{
			 error.insertAfter("#error1");
			}else if (element.attr("name") == "courseName")
			{
				error.insertAfter("#error2");
			}
		},
		messages:{
			class_id:"Select Class Name",
			courseName:"Enter Course Name"
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
$(document).ready(function(){    
	
	//Form Validation (Question Add And Update)
	$("#chapter_question_from").validate({  
		rules:{
			class_id:"required",
			course_id:"required",
			chapter_name:"required"
		},
		messages:{
			class_id:"Select Class Name",
			course_id:"Select Course Name",
			chapter_name:"Enter Chapeter Name"
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