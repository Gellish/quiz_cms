<!-- Exam Delete start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('delete_exam')?>
	</div>
</div>

<?php
if ($exam_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('exam_name')?></th>
						<th><?php echo display('no_of_question')?></th>
						<th><?php echo display('generated_procedure')?></th>
						<th><?php echo display('action')?></th>
					</tr>
				</thead>
				<tbody>
				{exam_list}
					<tr>
						<td>{exam_id}</td>
						<td>{exam_name}</td>
						<td>{number_of_question}</td>
						<td>{generated_procedure}</td>
						<td>
							<center>
								<?php echo form_open()?>

									<a href="" class="deleteToActive btn btn-sm btn-info" title= "<?php echo display('active')?>" name="{exam_id}"><i title= "<?php echo display('active')?>" class="fa fa-check" aria-hidden="true"></i></a>

									<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">

								<?php echo form_close()?>
							</center>
						</td>
					</tr>
				{/exam_list}
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
<!-- Exam Delete end -->