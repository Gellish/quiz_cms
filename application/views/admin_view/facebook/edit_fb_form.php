<!-- Edit Facebook start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_fb_config')?></div>
</div>
<?php echo form_open('admin/Cfacebook/update_fb',array('class' =>'well form-horizonta' ,'id' =>  'operator_edit' ))?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label for="fb_app_id" class="col-sm-4 col-form-label"><?php echo display('fb_app_id')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="fb_app_id" id="fb_app_id" value="{fb_app_id}" class="form-control" required >
				</div>
			</div>
			<div class="form-group row">
				<label for="fb_app_secret" class="col-sm-4 col-form-label"><?php echo display('fb_app_secret')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="fb_app_secret" id="fb_app_secret" value="{fb_app_secret}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-11">
			    	<div class="name_field"></div>
			    	<input type="hidden" name="facebook_id" id="facebook_id" value="{facebook_id}" required>
			        <button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
			    </div>
		    </div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit Facebook end -->