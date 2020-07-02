<!-- Edit Student start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_company')?></div>
</div>
<?php echo form_open('admin/Cstudent/update_student',array('class' =>'well form-horizonta' ,'id' => 'add_operator','enctype' =>'multipart/form-data'  ))?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label for="user_name" class="col-sm-4 col-form-label"><?php echo display('user_name')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="user_name" id="user_name" value="{user_name}" class="form-control" required >
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-4 col-form-label"><?php echo display('email')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="email" id="email" value="{email}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="mobile_no" class="col-sm-4 col-form-label"><?php echo display('mobile_no')?> :</label>
				<div class="col-sm-7">
					<input type="number" name="mobile_no" id="mobile_no" value="{mobile_no}" class="form-control" required>
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
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-7">
				<img src="{image}" class="img img-responsive" height="80" width="80">
					<input type="hidden" name="old_image" value="{image}">
				</div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-11">
			    	<div class="name_field"></div>
			        <button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
			    </div>
			    <input type="hidden" name="user_id" value="{user_id}" class="form-control" required>
		    </div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit Student end -->