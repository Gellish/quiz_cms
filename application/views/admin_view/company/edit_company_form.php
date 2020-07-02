<!-- Edit Company start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_company')?></div>
</div>
<?php echo form_open('admin/Ccompany/update_company',array('class' =>'well form-horizonta' ,'id' =>  'operator_edit' ))?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label for="company_name" class="col-sm-4 col-form-label"><?php echo display('company_name')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="company_name" id="company_name" value="{company_name}" class="form-control" required >
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-4 col-form-label"><?php echo display('email')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="email" id="email" value="{email}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="mobile" class="col-sm-4 col-form-label"><?php echo display('company_mobile')?> :</label>
				<div class="col-sm-7">
					<input type="number" name="mobile" id="mobile" value="{mobile}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="address" class="col-sm-4 col-form-label"><?php echo display('company_address')?> :</label>
				<div class="col-sm-7">
					<input type="text" name="address" id="address" class="form-control" required value="{address}">
				</div>
			</div>
	
			<div class="form-group row">
				<label for="website" class="col-sm-4 col-form-label"><?php echo display('company_website')?>:</label>
				<div class="col-sm-7">
					<input type="text" name="website" id="website" class="form-control" required value="{website}">
				</div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-11">
			    	<div class="name_field"></div>
			    	<input type="hidden" name="company_id" id="company_id" value="{company_id}" required>
			        <button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
			    </div>
		    </div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit Company end -->