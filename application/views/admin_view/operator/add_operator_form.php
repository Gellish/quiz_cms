<!-- Add operator start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_operator')?></div>
</div>
<div class="well row-fluid">
	<?php echo form_open_multipart('admin/Coperator/insert_operator',array('class' => 'form-horizontal','id' => 'add_operator'))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('assign_course')?></label>
					<div class="col-sm-7">
						<select name="course_id" class="form-control retrieveCourseName" id="class_id" required>
							<option value=""><?php echo display('please_select')?></option> 
							{course_list}
								<option value="{course_id}">{course_name}</option>  
							{/course_list}
						</select> 
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?></label>
				  	<div class="col-sm-7">
				   		<input type="text" name="operatorName" id="operatorName" class="form-control" required placeholder="<?php echo display('class_name')?>">
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('operator_name')?></label>
				  	<div class="col-sm-7">
				   		<input type="text" name="operatorName" id="operatorName" class="form-control" required placeholder="<?php echo display('operator_name')?>">
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('email')?></label>
				  	<div class="col-sm-7">
				   		<input type="Email" name="operatorEmail" id="operatorEmail" class="form-control" required placeholder="<?php echo display('email')?>">
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('mobile')?></label>
				  	<div class="col-sm-7">
				   		<input type="number" name="mobile" id="mobile" class="form-control" required placeholder="<?php echo display('mobile')?>">
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