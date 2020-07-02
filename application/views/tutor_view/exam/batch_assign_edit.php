<!-- Assign Exam in Batch start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('exam_assign_in_batch_edit')?></div>
</div>
<div class="row-fluid">
	<div>
		<?php echo form_open('tutor/Texam/assign_update',array('class' => 'well form-verticle', 'id' => 'tutor_question_from'))?>
			<div class="row">
				<div class="col-sm-6">

					<div class="form-group row">
						<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('select_batch')?>:</label>
						<div class="col-sm-7">
							<select name="batch_id" class="form-control" id="batch_id" required>
								<option value=""><?php echo display('please_select')?></option> 
								{batch_list}
								<option value="{batch_id}" {selected}>{batch_name}
								</option>
								{/batch_list}
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('please_select')?>:</label>
						<div class="col-sm-7">
							<select name="exam_id" id="exam_id" class="form-control" required>
								<option value=""><?php echo display('please_select')?></option> 
								{exam_list}
								<option value="{exam_id}" {selected}>{exam_name}</option>  
								{/exam_list}
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-7">
							<input type="hidden" value="{batch_assign_id}" name="batch_assign_id" id="batch_assign_id" class="form-control">
							<button type="submit" class="btn btn-primary" name="add-assign"><?php echo display('save_changes')?></button>
						</div>
					</div>
				</div>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Assign Exam in Batch start -->