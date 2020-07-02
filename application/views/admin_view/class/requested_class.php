<!-- Class list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_class_list') ?></div>
</div>
<?php 
if(!empty($class_list)){
?>

<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
			<thead>
				<tr>
					<th>#</th>
					<th><?php echo display('class_name') ?></th>
					<th><center><?php echo display('action') ?></center></th>
				</tr>
			</thead>
			<tbody>
			{class_list}
				<tr>
					<td>{sl}</td>
					<td>{class_name}</td>
					<td>
						<center>
						<?php echo form_open()?>
							<a href="#{class_id}" class="AjaxModal btn btn-warning btn-sm" data-toggle="modal" data-target="#newModal"><i title="Edit" class="glyphicon glyphicon-edit"></i></a>

							<button class="approveRequesClass btn btn-sm btn-success" name="{class_id}" title="<?php echo display('approved') ?>"><?php echo display('approved') ?></button>

							<button class="deleteRequestClass btn btn-sm btn-danger" name="{class_id}" title="<?php echo display('deny') ?>"><?php echo display('deny') ?></button>

							<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">

						<?php echo form_close()?>
						</center>
					</td>
				</tr>
			{/class_list}
			</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal page load start-->
<?php $this->load->view('admin_view/layout_modal')?>
<!-- Modal page load end-->
<?php 
}else{?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('dont_found_request_class') ?></div>
</div>
<?php
}
?>
<!-- Class list end -->

