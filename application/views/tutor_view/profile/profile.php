<!-- General profile setting start -->
<div id="myProfile">
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:25px;font-weight:bold;"><?php echo display('general_account_setting')?></div>
	</div>
	<table class="table table-striped table-bordered">
		<tr class="deepBorder">
			<td><?php echo display('full_name')?></td>
			<td>{user_name}</td>
			<td><a href="<?php echo base_url('tutor/User_profile/edit_full_name'); ?>"><button class="btn btn-warning btn-sm"><?php echo display('edit')?></button></a></td>
		</tr>
		<tr>
			<td><?php echo display('mobile_no')?></td>
			<td>{mobile_no}</td>
			<td><a href="<?php echo base_url('tutor/User_profile/edit_user_cellno'); ?>"><button class="btn btn-warning btn-sm"><?php echo display('edit')?></button></a></td>
		</tr>
		<tr>
			<td><?php echo display('password')?></td>
			<td>---------</td>
			<td><a href="<?php echo base_url('tutor/User_profile/change_user_password'); ?>"><button class="btn btn-warning btn-sm"><?php echo display('edit')?></button></a></td>
		</tr>
		<tr>
			<td><?php echo display('email')?></td>
			<td>{email}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</div>
<!-- General profile setting end -->
