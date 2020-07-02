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
			url: $('#baseUrl').val()+"tutor/Tquestion/retrieve_course",
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
			url: $('#baseUrl').val()+"tutor/Tquestion/retrieve_chapter",
			data: {course_id:course_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(html)
			{
				$(".retrieveChapterName").html(html);
			} 
		});

	});

	//Delete batch 
	$('body').on('click','.deleteBatch',function(event){
	 	event.preventDefault();
		var batch_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure to delete ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"tutor/Tbatch/delete_batchName",
				data: {batch_id:batch_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	//Delete Tutor Cretaed Batch Name
	$('body').on('click','.deleteStudent',function(event){
	 	event.preventDefault();
		var student_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("You want to delete Student from this Batch?");	
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"tutor/Tstudent/delete_student_name",
			data: {student_id:student_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				//$(".test").html(datas);
				location.reload();
			} 
		});
		}
	});

	//Delete Tutor Cretaed Exam
	$('body').on('click','.deleteExam',function(event){
	 	event.preventDefault();
		var exam_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("You want to delete this Exam ?");	
		if (x==true){
			$.ajax
		   	({
				type: "POST",
				url: $('#baseUrl').val()+"tutor/Texam/delete_examName",
				data: {exam_id:exam_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

	// Exam return To Active mode form Delete mode
	$('body').on('click','.deleteToActive',function(event){
	 	event.preventDefault();
		var exam_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("You want to active from deleted list ?");	
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: $('#baseUrl').val()+"tutor/Texam/exam_deleteToactive_mode",
			data: {exam_id:exam_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
		}
	});

	// Assigned Batch And Eaxm Delete
	$('body').on('click','.deleteBatchExam',function(event){
	 	event.preventDefault();
		var batch_assign_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("You want to delete this assign and batch ?");	
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: $('#baseUrl').val()+"tutor/Texam/exam_assign_batch_delete",
				data: {batch_assign_id:batch_assign_id,csrf_test_name:csrf_test_name},
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
	    selector: '.mytextarea'
	});
	
	//DataTable Js
	$("#dataTableExample2").DataTable({ dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], buttons: [ {extend: 'copy', className: 'btn-sm'}, {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'print', className: 'btn-sm'} ] });
}); 
