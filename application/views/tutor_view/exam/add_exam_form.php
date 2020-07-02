<!-- All Exam list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('create_new_exam')?>
	</div>
</div>
<div class="form-container">
	<?php echo form_open('tutor/Texam/create_questions',array('class' =>'well form-vertical' , 'id' => 'tutor_question_from','enctype' => 'multypart/formdata','name' => 'insert_exam'))?>
    	<legend><?php echo display('exam_details')?></legend>
    	<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('exam_name')?></label>
					<div class="col-sm-7">
						 <input type="text" class="form-control" name="exam_name" id="exam_name" placeholder="<?php echo display('exam_name')?>" required />
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('no_of_question')?></label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="no_of_question" id="no_of_question" placeholder="<?php echo display('no_of_question')?>" required />
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('question_source')?></label>
					<div class="col-sm-7">
						<input type="radio" name="qstn_src_type" value="1" id="qstn_src_type" required /> &nbsp;<?php echo display('computer_generate_question_bank')?> </br>
						<input type="radio" name="qstn_src_type" value="2" id="qstn_src_type" required /> &nbsp; <?php echo display('my_question_bank_randomly')?></br>
						<input type="radio" name="qstn_src_type" value="3" id="qstn_src_type" required /> &nbsp; <?php echo display('my_question_bank_sequencially')?> </br>
						<input type="radio" name="qstn_src_type" value="4" id="qstn_src_type" required /> &nbsp;<?php echo display('choose_question_form_question_bank')?> </br>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('subject_name')?></label>
					<div class="col-sm-7">
						<input type="text" name="course_name" class="form-control courseSelection" placeholder='Type Course Name' id="course_name" required="">
						<input type="hidden" class="course_hidden_value" name="course_id" id="course_id"/>
						<input type="hidden" name="baseUrl" value="<?php echo base_url();?>" id="baseUrl" id="baseUrl"/>
						<div id="loader" style="float:left;display:none;">
							<img src="<?=base_url();?>my-assets/images/loading_icon.gif" height="20" width="25">
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-10 col-form-label"><?php echo display('chapter_name')?></b>(<?php echo display('press_Ctrl_key_for_multiple_select')?>)</label>
				  	<div class="col-sm-10">
				   		<select name="chapter_id[]" multiple="multiple" class="select_feedback form-control" required="">
						</select>
				  	</div>
				</div>

				<div class="form-group row">
				    <div class="col-sm-11">
				        <input type="submit" id="add-exam" class="btn btn-primary btn-large" name="add-exam" value="<?php echo display('next_step')?>" />
				    </div>
			    </div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
