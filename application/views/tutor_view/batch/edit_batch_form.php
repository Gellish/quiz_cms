<!-- Edit Batch start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_batch')?></div>
</div>
<div class="row-fluid">
	<div>
	<?php echo form_open('tutor/Tbatch/update_batch',array('class' => 'well form-inline','id' => 'batch_add' ))?>
			<div class="form-group">
				<label for="class_name"><?php echo display('batch_name')?>: </label>
				<input type="text" name="batchName" value="{batch_name}" id="batchName" class="required form-control" required placeholder="<?php echo display('batch_name')?>">
				<input type="hidden" name="batchId" value="{batch_id}" id="batchId">
				<button type="submit" class="btn btn-primary" name="add-batch"><?php echo display('save_changes')?></button>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Edit Batch end -->