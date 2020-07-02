<!-- Model test list start  -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('model_test_list')?></div>
</div>
<?php
if ($model_test_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><center><?php echo display('model_test_name')?></center></th>
						<th><center><?php echo display('class_name')?></center></th>
						<th><center><?php echo display('model_test_details')?></center></th>
						<th><center><?php echo display('image')?></center></th>
						<th><center><?php echo display('action')?></center></th>
					</tr>
				</thead>
				<tbody>
				<?php 
				foreach ($model_test_list as $model_test) {
				?>
					<tr>
						<td><?php echo $model_test['sl']?></td>
						<td><?php echo $model_test['model_test_name']?></td>
						<td><?php echo $model_test['class_name']?></td>
						<td><?php echo character_limiter($model_test['test_details'],'90')?></td>
						<td class="text-center" style="width: 60px"><img src="<?php echo $model_test['image']?>" alt="" height="50" width="50"></td>
						<td>
							<center>
							<?php echo form_open()?>
								<a href="<?php echo base_url().'admin/Cmodel_test/model_test_edit_form'; ?>/<?php echo $model_test['model_test_id']?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>"><i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<a href="" class="deleteModelTest btn btn-sm btn-danger" name="<?php echo $model_test['model_test_id']?>" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

								<input type="hidden" name="base_url" id="baseUrl" value="<?php echo base_url()?>">
							<?php echo form_close()?>
							</center>
						</td>
					</tr>
				<?php
				}
				?>
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
<!-- Model test list end -->