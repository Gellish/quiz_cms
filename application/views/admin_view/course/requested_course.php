<!-- Requested Course list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_course_list')?></div>
</div>

<?php 
if(!empty($course_list)){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('course_name')?></th>
						<th><?php echo display('class_name')?></th>
						<th><?php echo display('status')?></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{course_list}
					<tr>
						<td>{sl}</td>
						<td>{course_name}</td>
						<td>{class_name}</td>
						<td>{status}</td>
						<td>
							<center>
								<?php echo form_open()?>
									<a href="#{course_id}" class="AjaxModal btn btn-warning btn-sm" data-toggle="modal" data-target="#newModal"><i title="<?php echo display('edit') ?>" class="glyphicon glyphicon-edit"></i></a>

									<a href="" class="approveRequesCoures btn btn-sm btn-info" title="<?php echo display('approved') ?>" name="{course_id}"><?php echo display('approved') ?></a>

									<a href="" class="deleteRequestCoures btn btn-sm btn-danger" title="<?php echo display('deny') ?>" name="{course_id}"><?php echo display('deny') ?></a>

									<input type="hidden" name="" id="baseUrl" value="<?php echo base_url()?>">

								<?php echo form_close()?>

							</center>
						</td>
					</tr>
				{/course_list}
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
}else{?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('dont_found_request_course')?>
	</div>
</div>
<?php
}
?>
<!--Requested Course list end -->

<!-- Modal body load from ajax start-->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo display('edit_course')?></h4></div>
      <div class="modal-body"> 
      	<div id="output"></div>
      </div>
      <div class="modal-footer">
     	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close')?></button>
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
          'url': '<?php echo base_url('admin/Ccourse/course_edit_form')?>' ,
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