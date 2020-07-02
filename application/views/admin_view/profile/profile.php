<!-- My profile setting start -->
<div class="bottomHeader"></div>
<div id="myProfile">
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:25px;font-weight:bold;"><?php echo display('general_account_setting')?></div>
	</div>
	<table class="table table-striped table-bordered">
		<tr class="deepBorder">
			<td><?php echo display('full_name')?></td>
			<td>{user_name}</td>
			<td><a href="<?php echo base_url('admin/User_profile/edit_full_name'); ?>" class="btn btn-warning btn-sm"><?php echo display('Edit')?></a></td>
		</tr>
		<tr>
			<td><?php echo display('mobile')?></td>
			<td>{mobile_no}</td>
			<td><a href="<?php echo base_url('admin/User_profile/edit_user_cellno'); ?>" class="btn btn-warning btn-sm"><?php echo display('edit')?></a></td>
		</tr>
		<tr>
			<td><?php echo display('password')?></td>
			<td>---------</td>
			<td><a href="<?php echo base_url('admin/User_profile/change_user_password'); ?>" class="btn btn-warning btn-sm"><?php echo display('Edit')?></a></td>
		</tr>
		<tr>
			<td><?php echo display('email')?></td>
			<td>{email}</td>
			<td></td>
		</tr>
	</table>
</div>
<!-- My profile setting end -->