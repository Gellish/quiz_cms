<!-- Edit class start -->
<div class="fieldCover">
	<div class="name_field"></div>
	<div class="error"><span></span></div>
</div>
<form  id="class_add" method="post" action="<?php echo base_url('admin/Cclass/update_class'); ?>">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label">Class Name :</label>
				<div class="col-sm-7">
					<input type="text" name="className" id="className" value="{class_name}" class="required form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label">Status :</label>
				<div class="col-sm-7">
					<input type="text" name="status" id="status"  value="{status}" class="required form-control" required>
					<input type="hidden" name="class_id" id="class_id" value="{class_id}" required>
				</div>
			</div>
			<div class="form-group row text-right">
			<div class="name_field"></div>
				<div class="col-sm-7">
					<button type="submit" class="btn btn-primary" name="add-course">Save Changes</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Edit class end -->