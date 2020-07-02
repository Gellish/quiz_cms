<!-- All question list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('question_list')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Cquestion/question_search_by_class_id',array('class' => 'well form-inline','id' => 'course_add' ))?>
		<div class="form-group">
			<label for="class_name"><?php echo display('select_course')?>: </label>
			<select name="class_id" id="class_id" class="retrieveCourseName form-control" required>
				<option value=""><?php echo display('please_select')?></option>
					{course_list}
				<option value="{class_id}">{course_name}</option>
					{/course_list}
			</select>
		</div>
		<div class="form-group">
			<label for="keyword"> <?php echo display('select_chapter')?>: </label> 
			<select name="chapter_id" id="chapter_id" class="retrieveChapterName form-control" required>
				<option><?php echo display('please_select')?></option>
			</select>
			<button type="submit" class="btn btn-primary"><?php echo display('search')?></button>
		</div>
	<?php echo form_close()?>
</div>
<?php
if(!empty($question_list)){
?>
<table class="table table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th><center><?php echo display('question')?></center></th>
			<th><center><?php echo display('chapter_name')?></center></th>
			<th><center><?php echo display('course_name')?></center></th>
			<th><center><?php echo display('class_name')?></center></th>
			<th><center><?php echo display('action')?></center></th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($question_list as $value){ 
	
	?>
		<tr>
			<td><?php echo $value['sl']; ?></td>
			<td><?php print_r(strip_tags(htmlspecialchars_decode( character_limiter($value['question_detals'], 80))));?></td>
			<td><?php echo $value['chapter_name']; ?></td>
			<td><?php echo $value['course_name']; ?></td>
			<td><?php echo $value['class_name']; ?></td>
			<td>
				<center>
					<?php echo form_open()?>
					
						<a href="#<?php echo $value['question_id']?>" class="AjaxModal btn btn-success" title="<?php echo display('option')?>" data-toggle="modal" data-target="#newModal"><?php echo display('option')?></a>

						<a href="<?php echo base_url().'admin/Cquestion/add_single_option_form/'.$value['question_id']; ?>" class="btn btn-sm btn-info" title="<?php echo display('add_another_option')?>"><i title="<?php echo display('add_another_option')?>" class="fa fa-plus-circle" aria-hidden="true"></i></a>

						<a href="<?php echo base_url().'admin/Cquestion/question_edit_form/'.$value['question_id']; ?>" class="btn btn-sm btn-warning"  title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

						<a href="" class="deleteQuestion btn btn-sm btn-danger" name="<?php echo $value['question_id']; ?>" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

						<input type="hidden" value="<?php echo base_url()?>" name="" id="baseUrl" >
						<?php echo form_close()?>
				</center>
			</td>
		</tr>
	<?php 
		}
	?>
	</tbody>
</table>
<?php
	}else{
	?>
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:18px;color: red"><?php echo display('data_not_found')?>
		</div>
	</div>
	<?php
	}
?>
<!-- Modal body load from ajax start-->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo display('question_details')?></h4></div>
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
          'url': '<?php echo base_url('admin/Cquestion/view_question_option')?>' ,
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

<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
<!-- All question list end -->