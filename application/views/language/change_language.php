<!-- Change language start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;">Change Language</div>
</div>
<div class="row-fluid">
	<?php echo form_open('Language/change',array('class' => 'well form-verticle','id' => 'class_add' ))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label">Language name</label>
				  	<div class="col-sm-7">
				  	<?php echo form_dropdown('language',$languages,null,'class=" form-control" required') ?> 
				  	</div>
				</div>
				<div class="form-group row">
				  	<div class="col-sm-7">
				   		<button type="submit" class="btn btn-primary pull-right" name="add-class">Save</button>
				  	</div>
				</div>
			</div>
		</div>
	<?php echo form_close()?>
</div>
<!-- Change language end -->