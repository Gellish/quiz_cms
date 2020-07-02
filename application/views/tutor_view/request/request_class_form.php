<!-- Request for class start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_for_class')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('tutor/Trequest/submit_class_request',array('class' => 'well form-vertical','id' => 'tutor_question_from' ))?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?>: </label>
					<div class="col-sm-7">
						<input type="text" name="class_name" id="class_name" class="form-control" required placeholder="<?php echo display('class_name')?>">
					</div>
				</div>
				<div class="form-group row text-right">
					<div class="col-sm-7">
						<button type="submit" class="btn btn-primary" name="request-class"><?php echo display('send_request')?></button>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close()?>
</div>
<!-- Request for class end -->