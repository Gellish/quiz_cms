<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('facebook_config')?></div>
</div>

<?php
if ($fb_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('id')?></center></th>
						<th><center><?php echo display('fb_app_id')?></center></th>
						<th><center><?php echo display('fb_app_secret')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{fb_list}
					<tr>
						<td><center>{facebook_id}</center></td>
						<td><center>{fb_app_id}</center></td>
						<td><center>{fb_app_secret}</center></td>
						<td>
							<center>
							<?php echo form_open()?>

								<a href="<?php echo base_url().'admin/Cfacebook/fb_edit_form/{facebook_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/fb_list}
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