<!-- Add student start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_student')?></div>
</div>
<div class="row-fluid">
	<div>
		<?php echo form_open('tutor/Tstudent/add_student',array('class' => 'well form-verticle','id' => 'tutor_question_from' ))?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group row">
						<label for="example-text-input" class="col-sm-3 col-form-label""><?php echo display('select_batch_name')?>: </label>
					  	<div class="col-sm-7">
					   		<select name="batch_id" id="batch_id" class="form-control" required="">
								<option value=""><?php echo display('please_select')?></option> 
								{batch_list}
								<option value="{batch_id}">{batch_name}</option>  
								{/batch_list}
							</select>
					  	</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('student_email')?>: </label> 
					  	<div class="col-sm-7">
					   		<input type="text" name="student_email" id="student_email" class="required form-control" required placeholder="<?php echo display('student_email')?>">
					  	</div>
					</div>
					<div class="form-group row">
					  	<div class="col-sm-7">
					   		<button type="submit" class="btn btn-primary" name="add-student"><?php echo display('add')?></button>
					  	</div>
					</div>
				</div>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Add student end -->