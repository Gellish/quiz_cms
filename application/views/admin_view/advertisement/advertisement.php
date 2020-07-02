<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('advertisement_list')?></div>
</div>

<?php
if ($advertisement_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('id')?></center></th>
						<th><center><?php echo display('add_position')?></center></th>
						<th><center><?php echo display('add_code')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{advertisement_list}
					<tr>
						<td><center>{sl}</center></td>
						<td><center>{add_position}</center></td>
						<td><center>{add_code}</center></td>
						<td>
							<center>
							<?php echo form_open()?>

								<button class="addStsChange {btn_class}" title="{add_status}" name="{add_id}"><i class="{class}"></i></button>

								<a href="<?php echo base_url().'admin/Cadvertisement/advertise_edit_form/{add_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<a href="" class="deleteAdvertise btn btn-sm btn-danger" name="{add_id}" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

								<input type="hidden" value="<?php echo base_url()?>" name="" id="baseUrl" >
								<?php echo form_close()?>

							</center>
						</td>
					</tr>
				{/advertisement_list}
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