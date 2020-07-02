<!-- Add new register start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('new_register_teacher')?></div>
</div>

<?php
if ($tutor_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('teacher_name')?></th>
						<th><?php echo display('teacher_email')?></th>
						<th><?php echo display('mobile_no')?></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{tutor_list}
					<tr>
						<td>{sl}</td>
						<td>{user_name}</td>
						<td>{email}</td>
						<td>{mobile_no}</td>
						<td>
							<center>
								<?php echo form_open()?>
									<a href="" class="approvedTeacher btn btn-sm btn-info" name="{user_id}" title="<?php echo display('approved')?>"><?php echo display('approved')?></a>

									<a href="" class="notNowApproved btn btn-sm btn-warning" name="{user_id}" title="<?php echo display('not_now')?>">Not now</a>

									<a href="" class="deleteTutor btn btn-sm btn-danger" name="{user_id}" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>
									
									<input type="hidden" name="" id="baseUrl" value="<?php echo base_url()?>">

								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/tutor_list}
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
<!-- Add new register end -->