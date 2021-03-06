<!-- Add question form start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_question')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('operator/Oquestion/insert_question_and_option',array('class' => 'well form-horizontal','id' => 'tutor_question_from' ))?>
		<div class="row">
			
	        <div class="col-sm-4">
	        	<div class="form-group row">
					<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('course_name')?></label>
				  	<div class="col-sm-8">
				   		<select name="course_id" id="course_id" class="form-control" required>
							{course_list}
								<option value="{course_id}">{course_name}</option>  
							{/course_list}
						</select>
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('answer_type')?></label>
				  	<div class="col-sm-8">
				   		<select name="answerType" id="answerType" class="form-control" required>
							<option value="" selected="selected"><?php echo display('please_select')?></option> 
							<option value="radio">Radio</option>  
							<option value="radio">Checkbox</option>  
						</select>
				  	</div>
				</div>
	        </div>
	        <div class="col-sm-4">
	        	<div class="form-group row">
					<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('chapter_name')?></label>
				  	<div class="col-sm-8">
				   		<select name="chapter_id" id="chapter_id" class="form-control" required>
							{chapter_list}
								<option value="{chapter_id}">{chapter_name}</option>  
							{/chapter_list}
						</select>
				  	</div>
				  	<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('language')?></label>
				  	<div class="col-sm-8">
				   		<select name="language" id="language" class="form-control" required>
							<option value="" selected="selected"><?php echo display('please_select')?></option> 
							<option value="English">English</option>  
							<option value="Bengali">Bengali</option>  
						</select>
				  	</div>
				</div>
			</div>

        </div>

        <div class="row">
	        <div class="col-sm-12">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('question')?></label>
					<div class="col-sm-7">
						<textarea name="questionName" rows="4" required class="form-control mytextarea"></textarea>
					</div>
				</div>
	        </div>
        </div>

        <div class="row">
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_1')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="0"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_2')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="1"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_3')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="2"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        </div>

        <div class="row">
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_4')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="3"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_5')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="4"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        	<div class="col-sm-4">
        		<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('option_6')?></label>
					<div class="col-sm-9">
						<textarea name="ques_option[]" required class="form-control mytextarea"></textarea>
						<label class="checkbox-inline"> <input type="checkbox" name="is_answer[]" id="is_answer" value="5"><?php echo display('is_answer')?></label>
					</div>
				</div>
        	</div>
        </div>

    	<div class="form-group row">
			<div class="col-sm-11">
				<input type="submit" class="btn btn-primary pull-right" value="<?php echo display('save_another')?>" name="add-chapter">
			</div>
		</div>
    <?php echo form_close()?>
</div>

