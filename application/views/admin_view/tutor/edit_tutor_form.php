<!-- Edit teacher start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_teacher')?></div>
</div>
<div class="fieldCover">
	<div class="name_field"></div>
	<div class="error"><span></span></div>
</div>
<?php echo form_open('admin/Ctutor/update_tutor',array('id' => 'operator_edit','class' => 'well form-horizontal','enctype' => 'multipart/form-data'))?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('assign_course')?></label>
				<div class="col-sm-7">
					<select name="course_id" id="course_id" required class="form-control">
						<option value=""><?php echo display('please_select')?></option> 
						{course_list}
						<option value="{course_id}" {selected} >{course_name}</option>			
						{/course_list}
					</select> 
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('teacher_name')?></label>
				<div class="col-sm-7">
					<input type="text" name="tutorName" id="tutorName" value="{tutor_name}" class="form-control" required placeholder="<?php echo display('teacher_name')?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
				<div class="col-sm-7">
					<input type="text" name="tutorEmail" id="tutorEmail" value="{tutor_email}" class="form-control" required placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('mobile')?></label>
				<div class="col-sm-7">
					<input type="text" name="mobile" id="mobile" value="{mobile}" class="form-control" required placeholder="<?php echo display('mobile')?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('password')?></label>
				<div class="col-sm-7">
					<input type="password" name="password" id="password" class="form-control" required placeholder="<?php echo display('password')?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('confirm_password')?></label>
				<div class="col-sm-7">
					<input type="password" name="con_pass" id="con_pass" class="form-control" required placeholder="<?php echo display('confirm_password')?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('select_image')?></label>
				<div class="col-sm-7">
					<input type="file" name="image">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-7">
					<img src="{image}" name="image" class="img img-responsive" height="80" width="80">
					<input type="hidden" name="old_image" value="{image}">
				</div>
			</div>
			<div class="form-group row">
				<div class="name_field"></div>
				<div class="col-sm-7">
					<input type="hidden" name="tutor_id" id="tutor_id" value="{tutor_id}" required>
					<button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit teacher end -->