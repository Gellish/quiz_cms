<!-- All question list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('question_list')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('tutor/Tquestion/question_search_by_chapter_id',array('class' => 'well form-inline','id' => 'course_add' ))?>
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
<table class="table table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo display('question')?></th>
			<th><?php echo display('chapter_name')?></th>
			<th><?php echo display('course_name')?></th>
			<th><?php echo display('class_name')?></th>
			<th><center><?php echo display('action')?></center></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if(!empty($question_list)){
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

						<a data-toggle="modal" href="#<?php echo $value['question_id']?>" data-target="#newModal" title=" <?php echo display('option')?>" class="AjaxModal btn btn-sm btn-info" >Options</a>

						<a href="<?php echo base_url().'tutor/Tquestion/add_single_option_form/'.$value['question_id']; ?>" class="btn btn-sm btn-success" title=" <?php echo display('add_another')?>"><i title=" <?php echo display('add_another')?>" class="fa fa-plus-circle" aria-hidden="true"></i></a>

						<a href="<?php echo base_url().'tutor/Tquestion/question_edit_form/'.$value['question_id']; ?>" class="btn btn-sm btn-warning" title=" <?php echo display('edit')?>"><i title=" <?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

						<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">

						
					<?php echo form_close()?>
				</center>
			</td>
		</tr>
		<?php 
		}
	}
	?>
	</tbody>
</table>

<!-- Modal page load start-->
<?php $this->load->view('tutor_view/layout_modal')?>
<!-- Modal page load end-->

<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
<!-- All question list end -->



