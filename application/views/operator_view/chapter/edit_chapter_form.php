<!--Add chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_chapter')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('operator/Ochapter/update_chapter',array('class' => 'well form-horizontal', 'id' => 'course_add'))?>
    	<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('course_name')?></label>
					<div class="col-sm-7">
						<select name="course_id" id="course_id" class="selectClassName form-control">
							{course_list}
							<option value="{course_id}">{course_name}</option>
							{/course_list}
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('chapter_name')?></label>
					<div class="col-sm-7">
						<textarea name="chapterName" rows="4" class="form-control mytextarea">{chapter_name}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('status')?></label>
					<div class="col-sm-7">
						<input type="text" name="chapterSts" value="{status}" required class="form-control">
					</div>
					<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
					<input type="hidden" value="{chapter_id}" name="chapter_id" id="chapter_id" >
				</div>
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" value="<?php echo display('save_changes')?>" name="add-chapter">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!--Add chapter list end -->