<!--Add chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_chapter')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('operator/Ochapter/insert_chapter',array('class' => 'well form-verticle' , )) ?>
    	<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('course_name')?></label>
					<div class="col-sm-7">
						<select name="course_id" id="course_id" class=" form-control required">
							<option><?php echo display('please_select')?></option>
							{course_list}
							<option value="{course_id}">{course_name}</option>
							{/course_list}
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('chapter_name')?></label>
					<div class="col-sm-7">
						<textarea name="chapterName" rows="4" class="form-control mytextarea"></textarea>
					</div>
					<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
				</div>
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" value="<?php echo display('save')?>" name="add-chapter">
						<input type="submit" class="btn btn-default" value="<?php echo display('save_another')?>" name="add-chapter-another">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!--Add chapter list end -->
