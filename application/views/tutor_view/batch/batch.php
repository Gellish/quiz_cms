<!-- All Batch list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('batch_list')?></div>
</div>


<?php
if ($batch_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
			<thead>
				<tr>
					<th>#</th>
					<th><?php echo display('batch_name')?></th>
					<th><?php echo display('no_of_student')?></th>
					<th><center><?php echo display('action')?></center></th>
				</tr>
			</thead>
			<tbody>
			{batch_list}
				<tr>
					<td>{batch_id}</td>
					<td>{batch_name}</td>
					<td>{no_of_student}</td>
					<td>
						<center>
							<?php echo form_open()?>

								<a href="<?php echo base_url().'tutor/Tbatch/batch_edit_form/{batch_id}'; ?>" class="btn btn-sm btn-warning" title="<?php display('edit')?>"><i title="<?php display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<a href="" class="deleteBatch btn btn-sm btn-danger" name="{batch_id}" title="<?php echo display('delete')?>" ><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

								<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">

							<?php echo form_close()?>
						</center>
					</td>
				</tr>
			{/batch_list}
			</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
}else{?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('no_data_found')?>
	</div>
</div>
<?php
}
?>
<!-- All Batch list end -->