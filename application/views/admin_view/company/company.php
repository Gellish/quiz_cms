<!-- Opertator list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('company_list')?></div>
</div>

<?php
if ($company_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th><center><?php echo display('sl')?></center></th>
						<th><center><?php echo display('company_name')?></center></th>
						<th><center><?php echo display('company_email')?></center></th>
						<th><center><?php echo display('company_address')?></center></th>
						<th><center><?php echo display('company_mobile')?></center></th>
						<th><center><?php echo display('company_website')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				{company_list}
					<tr>
						<td><center>{sl}</center></td>
						<td><center>{company_name}</center></td>
						<td><center>{email}</center></td>
						<td><center>{address}</center></td>
						<td><center>{mobile}</center></td>
						<td><center>{website}</center></td>
						<td>
							<center>
							<?php echo form_open()?>

								<a href="<?php echo base_url().'admin/Ccompany/company_edit_form/{company_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>" ><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/company_list}
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