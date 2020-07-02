<!-- Question create last step start -->
<div class="form-container">
	<?php echo  form_open('tutor/texam/insert_selected_question',array('class' => 'form-vertical', 'id' => 'tutor_question_from','enctype' => 'multypart/formdata'))?>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<input type="submit" id="add-exam" class="btn btn-primary btn-large" name="save-exam" value="<?php echo display('create_exam')?>" />
        				<input type="submit" id="add-exam" class="btn btn-info btn-large" name="cancell-exam" value="<?php echo display('cancel')?>" />
					</div>
				</div>
			</div>
		</div>
   <?php echo form_close()?>
</div>
<!-- Question create last step end -->