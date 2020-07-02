<!-- All Exam list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('assign_exam_list')?></div>
</div>

<?php
if ($assign_exam_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('exam_name')?></th>
						<th><?php echo display('batch_name')?></th>
						<th><?php echo display('action')?></th>
					</tr>
				</thead>
				<tbody>
				{assign_exam_list}
					<tr>
						<td>{sl}</td>
						<td>{exam_name}</td>
						<td><a href="<?php echo base_url().'tutor/Texam/assign_exam_result/{batch_id}/{exam_id}'; ?>">{batch_name}</a></td>
						<td>
							<center>
								<?php echo form_open()?>
									<a href="<?php echo base_url().'tutor/Texam/exam_assignToBatch_edit/{batch_assign_id}'; ?>" class="btn btn-sm btn-warning">
									<i title="<?php echo display('edit')?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

									<a href="" class="deleteBatchExam btn btn-sm btn-danger" name="{batch_assign_id}" title="<?php echo display('delete')?>"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>

									<input type="hidden"  id="baseUrl" value="<?php echo base_url()?>" name="">
								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/assign_exam_list}
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