<?php

$cache_file = "course_name.json";
    header('Content-Type: text/javascript; charset=utf8');
?>
var courseList = <?php echo file_get_contents($cache_file); ?> ; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
        $( ".courseSelection" ).autocomplete(
		{
            source: courseList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".course_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".course_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				var csrf_test_name=  $("[name=csrf_test_name]").val();
				var course_id=ui.item.value;
				$.ajax({
						type: "POST",
						url: $('#baseUrl').val()+"tutor/texam/retrieve_chapter_name",
						data: {course_id:course_id,csrf_test_name:csrf_test_name},
						cache: false,
						beforeSend: function(){
							$('#loader').show();
						},
						complete: function(){
							$('#loader').hide();
						},
						success: function(data)
						{
							$(".select_feedback").html(data);
						} 
					});
				
				$(this).unbind("change");
				return false;
			}
		});
		$( ".courseSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    });


