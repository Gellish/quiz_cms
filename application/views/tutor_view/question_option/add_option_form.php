<!-- Add question option start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_question_option')?>
	</div>
</div>
<div class="row-fluid">
	<?php echo form_open('tutor/Tquestion/insert_question_single_option',array('class' => 'well form-horizontal', 'id' => 'course_add'))?>
		<div class="row">
		    <div class="col-md-6">
		    	<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('question_details')?></label>
					<div class="col-sm-7">
						<textarea name="optionDetail" rows="4" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('language')?></label>
				  	<div class="col-sm-7">
				   		<select name="language" id="language" class="form-control">
							<option value="" selected="selected"><?php echo display('please_select')?></option> 
							<option value="English">English</option>  
							<option value="Bengali">Bengali</option>  
						</select>
				  	</div>
				</div>
				<div class="form-group row">
			      	<label class="col-sm-3"><?php echo display('is_answer')?></label>
			      	<div class="col-sm-7">
				        <div class="form-check">
				          <label class="form-check-label">
				            <input class="form-check-input" type="checkbox" name="is_answer">
				          </label>
				          <input type="hidden" value="{question_id}" name="question_id">
				        </div>
			      	</div>
			    </div>
				<div class="form-group row">
				    <div class="col-sm-11">
				        <input type="submit" class="btn btn-primary" value="<?php echo display('save')?>" name="add-option">
						<input type="submit" class="btn btn-success" value="<?php echo display('save_another')?>" name="add-option-another">
				    </div>
			    </div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<div class="test"></div>

