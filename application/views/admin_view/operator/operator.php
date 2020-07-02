<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('operator_list')?></div>
</div>

<?php
if ($operator_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('sl')?></center></th>
						<th><center><?php echo display('operator_name')?></center></th>
						<th><center><?php echo display('operator_email')?></center></th>
						<th><center><?php echo display('assign_course')?></center></th>
						<th><center><?php echo display('image')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>

				{operator_list}
					<tr>
						<td>{sl}</td>
						<td>{user_name}</td>
						<td>{email}</td>
						<td>{course_name}</td>
						<td class="text-center" style="width: 60px"><img src="{image}" alt="" height="50" width="50"></td>
						<td>
							<center>
								<?php echo form_open()?>
									<a href="" class="OprtrStsChng {btn_class}" name="{user_id}" title="{status}"><i class="{class}"></i></a>

									<a href="<?php echo base_url().'admin/Coperator/operator_edit_form/{user_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

									<a href="" class="deleteOperator btn btn-sm btn-danger" name="{user_id}" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

									<input type="hidden" name="" id="baseUrl" value="<?php echo base_url()?>">
								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/operator_list}
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