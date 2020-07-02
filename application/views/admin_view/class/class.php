<!-- Class form start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('class_list') ?></div>
</div>
<?php if ($class_list) {
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><center><?php echo display('class_name') ?></center></th>
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
									<a href="#{class_id}" class="AjaxModal btn btn-warning btn-sm" data-toggle="modal" data-target="#newModal"><i title="<?php echo display('edit') ?>" class="glyphicon glyphicon-edit"></i></a>

									<button class="clsStsChange {btn_class}" title="{status}" name="{class_id}"><i class="{class}"></i></button>

									<input type="hidden" name="" id="baseUrl" value="<?php echo base_url()?>">
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
<?php 
}else
{ ?>
<div class="well" style="margin-top: 10px;">
	<div style="font-size:18px;color: red"><?php echo display('data_not_found')?>
	</div>
</div>
<?php
}
?>
<!-- Modal page load start-->
<?php $this->load->view('admin_view/layout_modal')?>
<!-- Modal page load end-->
<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
<!-- Class form end -->