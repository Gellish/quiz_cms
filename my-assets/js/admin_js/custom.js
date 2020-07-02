// All Custom ajax statr here
$(document).ready(function(){
 	"use strict";
	//Retrieve Course name For using when insert Chapter name
	$('body').on('change','.selectClassName',function(event){
	 	event.preventDefault();
		var class_id=$(this).val();
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cchapter/retrieve_course",
			data: {class_id:class_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(html)
			{
				$(".retrieveCourseName").html(html);
			} 
		});
	});

	//Retrieve Course name For using whenever we'll insert Questions
	$('body').on('change','.retrieveCourseName',function(event){
	 	event.preventDefault();
		var course_id=$(this).val();
		var csrf_test_name=  $("[name=csrf_test_name]").val();

		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cquestion/retrieve_chapter",
			data: {course_id:course_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(html)
			{
				$(".retrieveChapterName").html(html);
			} 
		});
	});

	//Class Status change by ajax
	$('body').on('click','.clsStsChange',function(event){
	 	event.preventDefault();
		var class_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cclass/change_className_status",
				data: {class_id:class_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//User Status change by ajax
	$('body').on('click','.UserStsChg',function(event){
	 	event.preventDefault();
		var user_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cstudent/user_status_change",
				data: {user_id:user_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});


	//Course status change
	$('body').on('click','.crsStsCng',function(event){
	 	event.preventDefault();	
		var course_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Ccourse/change_courseName_status",
				data: {course_id:course_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Chapter status change
	$('body').on('click','.chpStsCng',function(event){
	  	event.preventDefault();
		var chapter_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cchapter/change_chapterName_status",
				data: {chapter_id:chapter_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Delete User
	$('body').on('click','.userDelete',function(event){
	  	event.preventDefault();
		var user_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cstudent/student_delete",
				data: {user_id:user_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Delete Advertise
	$('body').on('click','.deleteAdvertise',function(event){
	  	event.preventDefault();
		var add_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cadvertisement/delete_advertisement",
				data: {add_id:add_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Delete Questions
	$('body').on('click','.deleteQuestion',function(event){
	  	event.preventDefault();
		var question_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cquestion/delete_question",
				data: {question_id:question_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Adds Status Change
	$('body').on('click','.addStsChange',function(event){
	  	event.preventDefault(); 
		var add_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cadvertisement/ads_status_change",
			data: {add_id:add_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Operator Status Change
	$('body').on('click','.OprtrStsChng',function(event){
	  	event.preventDefault(); 
		var operator_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Coperator/oprator_status_change",
			data: {operator_id:operator_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Delete Operator 
	$('body').on('click','.deleteOperator',function(event){
	  	event.preventDefault(); 
		var operator_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Coperator/operator_delete",
			data: {operator_id:operator_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
		}
	});

	//Tutor Status Change
	$('body').on('click','.TutorStsChng',function(event){
	  	event.preventDefault(); 
		var tutor_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Ctutor/tutor_status_change",
			data: {tutor_id:tutor_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Not Approved Tutor 
	$('body').on('click','.notNowApproved',function(event){
	  	event.preventDefault(); 
		var tutor_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure,Want to Delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Ctutor/notNow_approved_teacher",
				data: {tutor_id:tutor_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Approved Tutor 
	$('body').on('click','.approvedTeacher',function(event){
	  	event.preventDefault(); 
		var tutor_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure,Want to Approve ?");	
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Ctutor/approved_teacher",
			data: {tutor_id:tutor_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
		}
	});

	//Delete Teacher
	$('body').on('click','.deleteTutor',function(event){
	  	event.preventDefault(); 
		var tutor_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Ctutor/tutor_delete",
			data: {tutor_id:tutor_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
		}
	});

	// APPROVE TEACHER REQUESTED CLASS
	$('body').on('click','.approveRequesClass',function(event){
	  	event.preventDefault(); 	
		var class_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cclass/approve_teacher_requested_class",
			data: {class_id:class_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});	
	});
	
	//Delete Request Class
	$('body').on('click','.deleteRequestClass',function(event){
	  	event.preventDefault(); 	
		var class_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cclass/deny_teacher_requested_class",
				data: {class_id:class_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});
	
	// APPROVE TEACHER REQUESTED COURES
	$('body').on('click','.approveRequesCoures',function(event){
	  	event.preventDefault(); 
		var course_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Ccourse/approve_teacher_requested_coures",
			data: {course_id:course_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});	
	});
	
	// DENY TEACHER REQUESTED COURES
	$('body').on('click','.deleteRequestCoures',function(event){
	  	event.preventDefault(); 
		var course_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to deny ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Ccourse/deny_teacher_requested_coures",
				data: {course_id:course_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});
	
	// APPROVE TEACHER REQUESTED chapter
	$('body').on('click','.approveRequesChapter',function(event){
	  	event.preventDefault(); 
		var chapter_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cchapter/approve_teacher_requested_chapter",
			data: {chapter_id:chapter_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});	
	});
	
	// DENY TEACHER REQUESTED COURES
	$('body').on('click','.deleteRequestChapter',function(event){
	  	event.preventDefault(); 
		var chapter_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to deny ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cchapter/deny_teacher_requested_chapter",
				data: {chapter_id:chapter_id,csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});
	
	//Retrieve Course name For using when insert Chapter name
 	$('body').on('change','.selectModelTestClass',function(event){
	  	event.preventDefault(); 
		var class_id=$(this).val();
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"admin/Cmodel_test/retrieve_subject_name",
			data: {class_id:class_id,csrf_test_name:csrf_test_name},
			cache: false,
			beforeSend: function(){
				$('#wait_load').show();
			},
			complete: function(){
				$('#wait_load').hide();
			},
			success: function(html)
			{
				$(".retrieveSubjectName").html(html);
			} 
		});
	});


	// DELETE MODEL TEST
	$('body').on('click','.deleteModelTest',function(event){
		event.preventDefault(); 
		var model_test_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"admin/Cmodel_test/delete_model_test",
				data: {model_test_id:model_test_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Text Editor
	tinymce.init({
	    selector: '.mytextarea',
	    menubar: false,
	});

	//DataTable Js
	$("#dataTableExample2").DataTable({ dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], buttons: [ {extend: 'copy', className: 'btn-sm'}, {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'print', className: 'btn-sm'} ] });
});