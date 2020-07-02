<!-- Add batch start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_batch')?></div>
</div>
<div class="row-fluid">
	<div>
		<?php echo form_open('tutor/Tbatch/insert_batch',array('class' => 'well form-inline','id' => 'tutor_question_from' ))?>
			<div class="form-group">
				<label for="class_name"><?php echo display('batch_name')?>: </label>
				<input type="text" name="batchName" id="batchName" class=" form-control" required placeholder="<?php echo display('batch_name')?>">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="add-batch"><?php echo display('save')?></button>
				<button type="submit" class="btn btn-info" name="add-batch-another" ><?php echo display('save_another')?></button>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Add batch start -->