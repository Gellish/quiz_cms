<!-- Tutor list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;">
	<?php 
	if ($this->uri->segment(3) == "inactive_tutor_list") {
		echo display('inactive_teacher');
	}else{
		echo display('active_teacher');
	}
	?>
	</div>
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
						<th><?php echo display('image')?></th>
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
						<td class="text-center" style="width: 60px"><img src="{image}" alt="" height="50" width="50"></td>
						<td>
							<center>
								<?php echo form_open()?>
									<a href="" class="TutorStsChng {btn_class}" title ="{status}" name="{user_id}"><i class="{class}"></i></a>

									<a href="<?php echo base_url().'admin/Ctutor/tutor_edit_form/{user_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>"><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

									<a href="" class="deleteTutor btn btn-sm btn-danger" name="{user_id}" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

									<input type="hidden" value="<?php echo base_url()?>" id="baseUrl">
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
<!-- Tutor list end -->
