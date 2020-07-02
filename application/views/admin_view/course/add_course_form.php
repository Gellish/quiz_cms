<!--Add Course start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_course')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Ccourse/insert_course',array('class' => 'well form-horizontal', 'id' => 'course_add','enctype'=>'multipart/form-data'))?>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="classname" class="col-sm-3 col-form-label"><?php echo display('class_name')?> * :</label>
					<div class="col-sm-7">
						<select class="form-control" name="class_id" required="" id="classname">
						<option selected="selected" value=""><?php echo display('please_select')?></option> 
						{class_list}
					  	<option value="{class_id}">{class_name}</option>
					  	{/class_list}
					</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="courseName" class="col-sm-3 col-form-label"><?php echo display('course_name')?>:</label>
					<div class="col-sm-7">
						<input type="text" name="courseName" id="courseName" class="required form-control" required placeholder="<?php echo display('enter_course')?>">
					</div>
				</div>	
				<div class="form-group row">
					<label for="is_new" class="col-sm-3 col-form-label"><?php echo display('is_new')?></label>
					<div class="col-sm-7">
						<input type="checkbox" name="is_new" id="is_new" value="1" class="text-right" required="">
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('course_details')?></label>
					<div class="col-sm-7">
						<textarea name="course_details" required class="form-control mytextarea"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="image" class="col-sm-3 col-form-label"><?php echo display('select_image')?>:</label>
					<div class="col-sm-7">
						<input type="file" id="image" name="image">
						<p>Image size : (Width:652px,Height:435px)</p>
					</div>
				</div>	
				<div class="form-group row">
					<div class="col-sm-7">
						<button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save')?></button>
						<button type="submit" class="btn btn-warning" name="add-course-another" ><?php echo display('save_another')?></button>
					</div>
				</div>
			</div>
		</div>		
	<?php echo form_close()?>
</div>
<!--Add Course end -->