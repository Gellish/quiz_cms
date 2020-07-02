<!-- Edit Company start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_google')?></div>
</div>
<?php echo form_open('admin/Cgoogle/update_google',array('class' =>'well form-horizonta' ,'id' =>  'operator_edit' ))?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label for="google_client_id" class="col-sm-4 col-form-label"><?php echo display('google_client_id')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="google_client_id" id="google_client_id" value="{google_client_id}" class="form-control" required >
				</div>
			</div>
			<div class="form-group row">
				<label for="google_secret_id" class="col-sm-4 col-form-label"><?php echo display('google_secret_id')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="google_secret_id" id="google_secret_id" value="{google_secret_id}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="google_api_key" class="col-sm-4 col-form-label"><?php echo display('google_api_key')?> :</label>
				<div class="col-sm-7">
					<input type="google_api_key" name="google_api_key" id="google_api_key" value="{google_api_key}" class="form-control" required>
				</div>
			</div>

			<div class="form-group row">
			    <div class="col-sm-11">
			    	<div class="name_field"></div>
			    	<input type="hidden" name="google_id" id="google_id" value="{google_id}" required>
			        <button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
			    </div>
		    </div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit Company end -->