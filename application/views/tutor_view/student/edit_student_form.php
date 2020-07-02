<h2>Edit Batch</h3>
<div class="row-fluid">
	<div>
		<form class="well form-inline" id="batch_add" method="post" action="<?php echo base_url('tutor/Tbatch/update_batch'); ?>">
			<label class="select">Batch Name: </label>
			<input type="text" name="batchName" value="{batch_name}" id="batchName" class="required" required>
			<input type="hidden" name="batchId" value="{batch_id}" id="batchId">
			<button type="submit" class="btn btn-primary" name="add-batch">Save Changes</button>
		</form>
	</div>
</div>