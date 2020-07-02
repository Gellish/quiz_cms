<!-- Add operator start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_student')?></div>
</div>
<div class="well row-fluid">
	<?php echo form_open('admin/Cstudent/insert_student',array('class' => 'form-horizontal','id' => 'add_operator','enctype' =>'multipart/form-data' ))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="user_name" class="col-sm-4 col-form-label"><?php echo display('student_name')?> :</label>
					<div class="col-sm-7">
						<input type="text" name="user_name" id="user_name" class="form-control" required placeholder="<?php echo display('student_name')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-4 col-form-label"><?php echo display('email')?> :</label>
					<div class="col-sm-7">
						<input type="text" name="email" id="email" class="form-control" required placeholder="<?php echo display('email')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="mobile_no" class="col-sm-4 col-form-label"><?php echo display('mobile_no')?> :</label>
					<div class="col-sm-7">
						<input type="number" name="mobile_no" id="mobile_no" class="form-control" required placeholder="<?php echo display('mobile_no')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="password" class="col-sm-4 col-form-label"><?php echo display('password')?>:</label>
					<div class="col-sm-7">
						<input type="password" name="password" id="password" class="form-control" placeholder="<?php echo display('password')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="confirm_password" class="col-sm-4 col-form-label"><?php echo display('confirm_password')?>:</label>
					<div class="col-sm-7">
						<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="<?php echo display('confirm_password')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('select_image')?></label>
					<div class="col-sm-7">
						<input type="file" name="image">
						<p>Image size : (Width:652px,Height:435px)</p>
					</div>
				</div>
				<div class="form-group row">
				    <div class="col-sm-11">
				        <input type="submit" class="btn btn-primary" value="<?php echo display('create')?>" name="add-operator">
				    </div>
			    </div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Add operator end -->