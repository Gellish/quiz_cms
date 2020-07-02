<!-- Modal body load from ajax start-->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php echo display('edit_question')?></h4></div>
      <div class="modal-body"> 
      	<div id="output"></div>
      </div>
      <div class="modal-footer">
     	<button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo display('close')?></button>
       </div>
    </div>
  </div>
</div>
<!-- Modal body load from ajax end-->

<!-- Modal ajax call start -->
<script type="text/javascript">
    $(".AjaxModal").click(function(){
        var url = $(this).attr("href"); 
        var href = url.split("#");   
        var csrf_test_name=  $("[name=csrf_test_name]").val(); 
        jquery_ajax(href[1],csrf_test_name);
    });

    function jquery_ajax(id,csrf_test_name) { 
        $.ajax({
          'url': '<?php echo base_url('tutor/Tquestion/view_question_option')?>' ,
          'type': 'POST',
          'data': {id: id,csrf_test_name:csrf_test_name},
          'cache': false,
          success: function (data) {
            $('#output').html(data);
          }
          ,error: function (data) {
            alert('failed');
          }
        });
    }
</script>
<!-- Modal ajax call start -->