<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('google_config')?></div>
</div>

<?php
if ($google_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('id')?></center></th>
						<th><center><?php echo display('google_client_id')?></center></th>
						<th><center><?php echo display('google_secret_id')?></center></th>
						<th><center><?php echo display('google_api_key')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{google_list}
					<tr>
						<td><center>{google_id}</center></td>
						<td><center>{google_client_id}</center></td>
						<td><center>{google_secret_id}</center></td>
						<td><center>{google_api_key}</center></td>
						<td>
							<center>
							<?php echo form_open()?>

								<a href="<?php echo base_url().'admin/Cgoogle/google_edit_form/{google_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/google_list}
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