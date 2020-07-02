<!--All chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('chapter_list')?></div>
</div>

<?php
if ($chapter_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('chapter_name')?></th>
						<th><?php echo display('course_name')?></th>
						<th><?php echo display('class_name')?></th>
						<th><?php echo display('action')?></th>
					</tr>
				</thead>
				<tbody>
				{chapter_list}
					<tr>
						<td>{chapter_id}</td>
						<td>{chapter_name}</td>
						<td>{course_name}</td>
						<td>{class_name}</td>
						<td>
							<center>

								<a href="<?php echo base_url().'operator/Ochapter/chapter_edit_form/{chapter_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit')?>"><i title="<?php echo display('edit')?>" class="glyphicon glyphicon-edit"></i></a>

							</center>
						</td>
					</tr>
				{/chapter_list}
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
<!-- Chapter list end -->