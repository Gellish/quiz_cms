<!-- Edit Question form start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_question')?>
	</div>
</div>
<div class="row-fluid">
	<?php echo form_open('operator/Oquestion/question_and_option_update',array('class' => 'well form-horizontal','id' => 'course_add' ))?>


	<div class="row">
		<div class="col-md-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('course_name')?></label>
			  	<div class="col-sm-8">
			   		<select name="course_id" class="form-control retrieveCourseName required" id="class_id" >
						<option value=""><?php echo display('please_select')?></option> 
						{course_list}
							<option value="{course_id}" {selected}>{course_name}</option>  
						{/course_list}
					</select> 
			  	</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('chapter_name')?></label>
			  	<div class="col-sm-8">
			   		<select name="chapter_id" class="form-control retrieveChapterName required" id="class_id" >
						<option value=""><?php echo display('please_select')?></option> 
						{chapter_list}
							<option value="{chapter_id}" {selected}>{chapter_name}</option>  
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
			   		<select name="language" id="language" class="form-control required">
						<option value=""><?php echo display('please_select')?></option> 
						<option value="English" <?php if(isset($language) && $language=="English"){echo 'selected="selected"'; } ?>>English</option>  
						<option value="Bengali" <?php if(isset($language) && $language=="Bengali"){echo 'selected="selected"'; } ?>>Bengali</option>  
					</select>
			  	</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('language')?></label>
			  	<div class="col-sm-8">
			   		<select name="language" id="language" class="form-control required">
						<option value=""><?php echo display('please_select')?></option> 
						<option value="English" <?php if(isset($language) && $language=="English"){echo 'selected="selected"'; } ?>>English</option>  
						<option value="Bengali" <?php if(isset($language) && $language=="Bengali"){echo 'selected="selected"'; } ?>>Bengali</option>  
					</select>
			  	</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('answer_type')?></label>
			  	<div class="col-sm-8">
			   		<select name="answerType" id="answerType" class="form-control required">
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
				<label for="example-text-input" class="col-sm-2 col-form-label"><?php echo display('question_detalils')?></label>
				<div class="col-sm-8">
					<textarea name="questionName" rows="4" class="form-control required mytextarea" >{question_detals}</textarea>
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
				<label for="example-text-input" class="col-sm-4 col-form-label">
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
		<input type="hidden" value="{question_id}" name="question_id">
	 	<div class="form-group row">
		    <div class="col-sm-11">
		        <input type="submit" class="btn btn-primary pull-right" value="<?php echo display('save_changes')?>" name="add-chapter">
		    </div>
	    </div>
    <?php echo form_close()?>
</div>
<!-- Edit Question form end -->