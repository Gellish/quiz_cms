<!-- Request for class start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_for_course')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('tutor/Trequest/submit_course_request',array('class' => 'well form-verticle', 'id' => 'tutor_question_from'))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?> * :</label>
					<div class="col-sm-7">
						<select name="class_id" id="class_id" class="form-control" required="">
							<option selected="selected" value=""><?php echo display('please_select')?></option> 
							{class_list}
								<option value="{class_id}">{class_name}</option>  
							{/class_list}
						</select> 
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('course_name')?>: </label>
					<div class="col-sm-7">
						<input type="text" name="courseName" id="courseName" class="form-control" placeholder="<?php echo display('course_name')?>" required >
					</div>
				</div>
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<button type="submit" class="btn btn-primary" name="request-course"><?php echo display('send_request')?></button>
					</div>
				</div>
			</div>
		</div>
	<?php form_close()?>
</div>
<!-- Request for class end -->