<!-- Add new teacher start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_new_teacher')?></div>
</div>
<div class="row-fluid">
	<div class="error"> <span></span> </div>
	<?php echo form_open('admin/Ctutor/insert_tutor',array('class' => 'well form-horizontal', 'id' => 'add_tutor','enctype' => 'multipart/form-data'))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('teacher_name')?></label>
					<div class="col-sm-7">
						<input type="text" name="tutorName" id="tutorName" class="form-control"  required placeholder="<?php echo display('teacher_name')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('email')?></label>
					<div class="col-sm-7">
						<input type="email" name="tutorEmail" id="tutorEmail" class="form-control" required placeholder="<?php echo display('email')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('mobile')?></label>
					<div class="col-sm-7">
						<input type="number" name="mobile" id="mobile" required class="form-control" placeholder="<?php echo display('mobile')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('password')?></label>
					<div class="col-sm-7">
						<input type="password" name="password" id="password" required class="form-control" placeholder="<?php echo display('password')?>">
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
						<p>Image size : (Width:652px,Height:435px)</p>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" value="<?php echo display('create')?>" name="add-tutor">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Add new teacher end -->