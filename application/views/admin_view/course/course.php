<!-- Tiny_mce js -->
<script type="text/javascript" src="<?php echo base_url(); ?>my-assets/com_plugin/tinymce/tinymce.min.js"></script>
<!-- Course list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('course_list')?></div>
</div>
<?php
if ($course_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><center><?php echo display('course_name')?></center></th>
						<th><center><?php echo display('class_name')?></center></th>
						<th><center><?php echo display('course_details')?></center></th>
						<th><center><?php echo display('image')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach ($course_list as $course) {
				?>
					<tr>
						<td><?php echo $course['sl']?></td>
						<td><?php echo $course['course_name']?></td>
						<td><?php echo $course['class_name']?></td>
						<td><?php echo character_limiter($course['course_details'],'90')?></td>
						<td class="text-center" style="width: 60px"><img src="<?php echo $course['image']?>" class="img-responsive " alt="" height="80" width="80"></td>
						<td>
							<center>
							<?php echo form_open()?>
								<a href="#<?php echo $course['course_id']?>" class="AjaxModal btn btn-warning btn-sm" data-toggle="modal" data-target="#newModal"><i title="<?php echo display('edit')?>" class="glyphicon glyphicon-edit"></i></a>

								<button class="crsStsCng <?php echo $course['btn_class']?>" title="<?php echo $course['course_status']?>" name="<?php echo $course['course_id']?>"><i title="<?php echo $course['course_status']?>" class="<?php echo $course['class']?>"></i></button>

								<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
							<?php echo form_close()?>
							</center>
						</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
}else{?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('data_not_found')?>
	</div>
</div>
<?php
}
?>
<!-- Course list end -->

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