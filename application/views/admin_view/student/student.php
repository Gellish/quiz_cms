<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('student_list')?></div>
</div>

<?php
if ($student_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('sl')?></center></th>
						<th><center><?php echo display('student_name')?></center></th>
						<th><center><?php echo display('email')?></center></th>
						<th><center><?php echo display('mobile_no')?></center></th>
						<th><center><?php echo display('image')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{student_list}
					<tr>
						<td><center>{sl}</center></td>
						<td><center>{user_name}</center></td>
						<td><center>{email}</center></td>
						<td><center>{mobile_no}</center></td>
						<td class="text-center" style="width: 60px"><img src="{image}" alt="" height="50" width="50"></td>
						<td>
							<center>
							<?php echo form_open()?>

								<a href="" class="UserStsChg {btn_class}" title="{status}" name="{user_id}"><i title="{status}" class="{class}"></i></a>
								
								<a href="<?php echo base_url().'admin/Cstudent/student_edit_form/{user_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>"><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<a href="" class="userDelete btn btn-sm btn-danger" name="{user_id}" title="<?php echo display('delete')?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

								<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/student_list}
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
}else{?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('data_not_found')?>
	</div>
</div>
<?php
}
?>
<!-- Opertator list end -->