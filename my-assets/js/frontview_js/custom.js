// Custom ajax for font end
$(document).ready(function(){ 
 	"use strict";
	//Delete Course Name
	$(".answer_circle").click(function()
	{	
		var examAndQuesId=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var baseUrl=$("#baseUrl").val();
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"front/Common_exam/exam_result_detail_view",
			data: {examAndQuesId:examAndQuesId,csrf_test_name:csrf_test_name},
			cache: false,
			beforeSend: function(){
				$('#loader').show();
			},
			complete: function(data){
				$('#loader').hide();
			},
			success: function(datas)
			{
				//location.reload();
				$("#resultAnalisys").html(datas);
				$(".circleActiveBar").hide();
				$('.'+id).show();
				//alert(datas);
			} 
		});
	});
}); 

$(document).ready(function(){
	$(".clickOn_circle").click(function()
	{	
		var modelTestAndQuesId=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var baseUrl=$("#baseUrl").val();
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"front/Cmodel_test/exam_result_detail_view",
			data: {modelTestAndQuesId:modelTestAndQuesId,csrf_test_name:csrf_test_name},
			cache: false,
			beforeSend: function(){
				$('#loader').show();
			},
			complete: function(){
				$('#loader').hide();
			},
			success: function(datas)
			{
				//location.reload();
				$("#resultAnalisys").html(datas);
				$(".circleActiveBar").hide();
				$('.'+id).show();
				//alert(datas);
			} 
		});
	});
});
// Exam Result Analysis JS
$(document).ready(function(){

	$(".summarizeIcon").click(function()
	{	
		$(".summarizeIcon").hide();
		$(".summarizeResult").slideDown(1500);
		$(".detailsResult").slideUp();
	});
	
	$(".detailsIcon").click(function()
	{
		$(".summarizeIcon").show();
		$(".summarizeResult").slideUp();
		$(".detailsResult").slideDown(1500);
	});
});
// ff9966
// Click on the menu to select exam
$(document).ready(function(){

	$(".courseFilterMenu1").click(function()
	{	
		$(".courseFilterMenu1").addClass("onClickBorderNone");
		$(".courseFilterMenu2").removeClass("onClickBorderNone");
		$(".courseFilterMenu3").removeClass("onClickBorderNone");
		$(".courseFilterMenu4").removeClass("onClickBorderNone");

		$(document).ajaxStart(function(){
			$('.thisClassUseForJs').hide();
			$('#wait_load').show();
		});
		$(document).ajaxComplete(function(){
			$('#wait_load').hide();
		});
		$("#courseContainer").load(baseUrl+"front/Common_exam/get_all_course");
		
	});
	
	$(".courseFilterMenu2").click(function()
	{	
		$(".courseFilterMenu1").removeClass("onClickBorderNone");
		$(".courseFilterMenu2").addClass("onClickBorderNone");
		$(".courseFilterMenu3").removeClass("onClickBorderNone");
		$(".courseFilterMenu4").removeClass("onClickBorderNone");
		
		$(document).ajaxStart(function(){
			$('.thisClassUseForJs').hide();
			$('#wait_load').show();
		});
		$(document).ajaxComplete(function(){
			$('#wait_load').hide();
		});
		$("#courseContainer").load(baseUrl+"front/Cmodel_test/get_model_test");	
		
	});
	
	$(".courseFilterMenu3").click(function()
	{	
		$(".courseFilterMenu1").removeClass("onClickBorderNone");
		$(".courseFilterMenu2").removeClass("onClickBorderNone");
		$(".courseFilterMenu3").addClass("onClickBorderNone");
		$(".courseFilterMenu4").removeClass("onClickBorderNone");
		
		$(document).ajaxStart(function(){
			$('.thisClassUseForJs').hide();
			$('#wait_load').show();
		});
		$(document).ajaxComplete(function(){
			$('#wait_load').hide();
		});
		$("#courseContainer").load(baseUrl+"front/Common_exam/get_newly_added_course");
		
	});
	
	$(".courseFilterMenu4").click(function()
	{	
		$(".courseFilterMenu1").removeClass("onClickBorderNone");
		$(".courseFilterMenu2").removeClass("onClickBorderNone");
		$(".courseFilterMenu3").removeClass("onClickBorderNone");
		$(".courseFilterMenu4").addClass("onClickBorderNone");
		
		$(document).ajaxStart(function(){
			$('.thisClassUseForJs').hide();
			$('#wait_load').show();
		});
		$(document).ajaxComplete(function(){
			$('#wait_load').hide();
		});
		$("#courseContainer").load(baseUrl+"front/Common_exam/get_popular_course");
	});
}); 


// Course search list start
$(document).ready(function(){
	$('body').on('click', '.srch_button', function (){
		var id=$(".search_keyord").val();
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var baseUrl=$("#baseUrl").val();

		if(id.length == 0){
			$("#appendedInputButton").css("border-color","red");
			$("#appendedInputButton").focus();
		}else{	
			$("#appendedInputButton").css("border-color","");
				//alert(id);

			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"front/Common_exam/search_course",
				data: {id:id,csrf_test_name:csrf_test_name},
				cache: false,
				// beforeSend: function(){
				// 	$('.thisClassUseForJs').hide();
				// 	$('#wait_load').show();
				// },
				// complete: function(){
				// 	$('#wait_load').hide();
				// },
				success: function(datas)
				{
					// alert(datas);
					$('.hide-old').hide();
					$('.search_result1').html(datas);
				} 
			});
		}
	});
}); 

// Course search list end
