<!-- Edit Question form start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_question')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Cquestion/question_and_option_update',array('class' => 'well form-horizontal','id' => 'course_add'))?>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('class_name')?></label>
			  	<div class="col-sm-8">
			   		<select name="class_id" id="class_id" class="selectClassName form-control" required>
						<option value=""><?php echo display('please_select')?></option> 
						{class_list}
							<option value="{class_id}" {selected}>{class_name}</option>  
						{/class_list}
					</select>
			  	</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('course_name')?></label>
			  	<div class="col-sm-8">
			   		<select name="course_id" id="class_id" class="retrieveCourseName form-control" required>
						<option value=""><?php echo display('please_select')?></option> 
					</select>
			  	</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('chapter_name')?></label>
			  	<div class="col-sm-8">
			   		<select name="chapter_id" id="chapter_id" class="retrieveChapterName form-control" required>
					</select>
			  	</div>
			  	<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
			</div>
		</div>
	</div>

	<div class="row">
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
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('answer_type')?></label>
			  	<div class="col-sm-8">
			   		<select name="answerType" id="answerType" class="form-control" required>
						<option value=""><?php echo display('please_select')?></option> 
						<option value="radio" <?php if(isset($answer_type) && $answer_type=="radio"){echo 'selected="selected"'; } ?>>Radio</option>  
						<option value="checkbox" <?php if(isset($answer_type) && $answer_type=="checkbox"){echo 'selected="selected"'; } ?>>Checkbox</option>
					</select>
			  	</div>
			  	<input type="hidden" value="{question_id}" name="question_id" id="question_id" >
			</div> 
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-2 col-form-label"><?php echo display('question_details')?></label>
				<div class="col-sm-9">
					<textarea name="questionName" rows="4" required class="form-control mytextarea">{question_detals}</textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<?php
		$serial=1;
		foreach ($option_list as $option) {
		?>
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label">
				<?php echo display('Option_'.$serial) ?></label>
				<div class="col-sm-9">
					<textarea name="ques_option[]" required class="mytextarea"><?php echo $option['option_details']?></textarea>
					<label class="checkbox-inline"> 
						<input type="checkbox" value="<?php echo $option['question_option_id']?>" <?php if (isset($option['checked'])){ echo $option['checked'];}?>  name="answer_id[]" id="answer_id"><?php echo display('is_answer')?>
					</label>
					<input type="hidden" value="<?php echo $option['question_option_id']?>" name="option_id[]">
				</div>
			</div>
		</div>
		<?php
		$serial++;
		}
		 ?>
	</div>

	<div class="row">
		<input type="hidden" value="{question_id}" name="question_id">
	 	<div class="form-group row">
		    <div class="col-sm-11">
		        <button type="submit" class="btn btn-primary pull-right" name="add-chapter"><?php echo display('save_changes')?>
		        </button>
		    </div>
	    </div>
	</div>
    <?php echo form_close()?>
</div>
<!-- Edit Question form end -->