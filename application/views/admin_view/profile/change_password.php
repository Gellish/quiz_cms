<!-- Change password start -->
<div id="myProfile">
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:25px;font-weight:bold;"><?php echo display('general_account_setting')?></div>
	</div>
	<table class="table table-striped table-bordered">
		<tr class="deepBorder">
			<td><?php echo display('full_name')?></td>
			<td><center>{user_name}</center></td>
			<td><a href="<?php echo base_url('admin/User_profile/edit_full_name'); ?>" class="btn btn-warning btn-sm"><?php echo display('edit')?></a></td>
		</tr>
		<tr>
			<td><?php echo display('mobile_no')?></td>
			<td><center>{mobile_no}</center></td>
			<td><a href="<?php echo base_url('admin/User_profile/edit_user_cellno'); ?>" class="btn btn-warning btn-sm"><?php echo display('edit')?></a></td>
		</tr>
		<tr class="specTRcolor">
			<td><?php echo display('password')?></td>
			<td>
				<?php echo form_open('admin/User_profile/do_password_change',array('class' => 'form-horizontal','id' => 'change_password' ))?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('current')?></label>
								<div class="col-sm-7">
									<input type="password" name="old_pass" id="old_pass" placeholder="<?php echo display('enter_old_password')?>" class="OnePxBorder required form-control" required >
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('new')?></label>
								<div class="col-sm-7">
									<input type="password" id="new_pass" name="new_pass" placeholder="<?php echo display('enter_new_password')?>" class="OnePxBorder required form-control" required >
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('re_type_new')?></label>
								<div class="col-sm-7">
									<input type="password" id="again_new_pass" name="again_new_pass" placeholder="<?php echo display('enter_new_password')?>" class="OnePxBorder required form-control" required >
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="submit" class="btn btn-default OnePxBorder" value="<?php echo display('save_changes')?>">
									<a href="<?php echo base_url('admin/User_profile'); ?>" class="btn btn-danger OnePxBorder"><?php echo display('cancel')?></a>
								</div>
							</div>
						</div>
					</div>
				<?php echo form_close()?>
			</td>
		</tr>
		<tr>
			<td><?php echo display('email')?></td>
			<td><center>{email}</center></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>
<!-- Change password end -->


	
