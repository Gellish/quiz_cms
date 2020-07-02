<!-- Request for class start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_for_chapter')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('tutor/Trequest/submit_chapter_request',array('class' => 'well form-verticle', 'id' => 'tutor_question_from'))?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?>: </label>
					<div class="col-sm-7">
						<select name="class_id" id="class_id" class="selectClassName form-control required" >
							<option value=""><?php echo display('please_select')?></option> 
							{class_list}
								<option value="{class_id}">{class_name}</option>  
							{/class_list}
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('course_name')?>: </label>
					<div class="col-sm-7">
						<select name="course_id" class="form-control required retrieveCourseName" id="course_id" >
							<option value=""><?php echo display('course_name')?></option> 
						</select> 
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('chapter_name')?>: </label>
					<div class="col-sm-7">
						<input type="text" name="chapter_name" id="chapter_name" class="form-control required" placeholder="<?php echo display('chapter_name')?>">
					</div>
					<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
				</div>
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<input type="submit" class="btn btn-primary" value="<?php echo display('send_request')?>" name="request-chapter">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Request for class end -->