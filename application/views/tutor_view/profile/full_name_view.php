<!-- Cell number view start -->
<div id="myProfile">
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:25px;font-weight:bold;"><?php echo display('general_account_setting')?></div>
	</div>
	<table class="table table-striped table-bordered">
		<tr class="specTRcolor">
			<td><?php echo display('full_name')?></td>
			<td>
				<?php echo form_open('tutor/User_profile/do_user_full_name_edit',array('class' => 'form-horizontal', 'id' => 'user_full_name_edit'))?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('full_name')?></label>
								<div class="col-sm-7">
									<input type="text" name="full_name" id="full_name" value="{user_name}" class="OnePxBorder required form-control" >
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-12">
									<span><?php echo display('to_save_this_setting_enter_password')?></span>
								</div>
							</div>

							<div class="form-group row">
								<label for="example-text-input" class="col-sm-4 col-form-label"><?php echo display('password')?></label>
								<div class="col-sm-7">
									<input type="password" id="password" name="password" placeholder="<?php echo display('password')?>" class="OnePxBorder required form-control" >
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-12">
									<input type="submit" class="btn btn-info OnePxBorder" id="user_info_change" value="<?php echo display('save_changes')?>">
									<a href="<?php echo base_url('tutor/User_profile'); ?>" class="btn btn-danger OnePxBorder"><?php echo display('cancel')?></a>
								</div>
							</div>
						</div>
					</div>
				<?php echo form_close()?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo display('mobile_no')?></td>
			<td><center>{mobile_no}</center></td>
			<td><a href="<?php echo base_url('tutor/User_profile/edit_user_cellno'); ?>"><button type="submit" class="btn btn-warning btn-sm"><?php echo display('edit')?></button></a></td>
		</tr>
		<tr>
			<td><?php echo display('password')?></td>
			<td><center>---------</center></td>
			<td><a href="<?php echo base_url('tutor/User_profile/change_user_password'); ?>"><button type="submit" class="btn btn-warning btn-sm"><?php echo display('edit')?></button></a></td>
		</tr>
		<tr>
			<td><?php echo display('email')?></td>
			<td><center>{email}</center></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</div>
<!-- Cell number view end -->