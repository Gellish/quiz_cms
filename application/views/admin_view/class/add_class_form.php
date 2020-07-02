<!-- Add class start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_class') ?></div>
</div>
<div class="row-fluid">
	<div>
		<?php echo form_open('admin/Cclass/insert_class',array('class' =>'well form-inline' , 'id' => 'class_add'))?>
			<div class="form-group">
				<label for="className"><?php echo display('class_name') ?>:</label>
			    <input type="text" class="form-control" id="className" placeholder="<?php echo display('enter_class') ?>" name="className" required>
				<button type="submit" class="btn btn-primary" name="add-class"><?php echo display('save') ?></button>
				<button type="submit" class="btn btn-warning" name="add-class-another" ><?php echo display('save_another') ?></button>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Add class end -->