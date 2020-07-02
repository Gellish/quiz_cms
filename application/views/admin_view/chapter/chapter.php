<!-- Chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('chapter_list') ?></div>
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
						<th><center><?php echo display('chapter_name') ?></center></th>
						<th><center><?php echo display('course_name') ?></center></th>
						<th><center><?php echo display('class_name') ?></center></th>
						<th><center><?php echo display('image') ?></center></th>
						<th><center><?php echo display('action') ?></center></th>
					</tr>
				</thead>
				<tbody>
				{chapter_list}
					<tr>
						<td>{sl}</td>
						<td>{chapter_name}</td>
						<td>{course_name}</td>
						<td>{class_name}</td>
						<td class="text-center" style="width: 60px"><img src="{image}" alt="" height="50" width="50"></td>
						<td>
							<center>
								<?php echo form_open()?>

									<a href="<?php echo base_url().'admin/Cchapter/chapter_edit_form/{chapter_id}'; ?>" class="btn btn-sm btn-warning" ><i title="<?php echo display('edit') ?>" class="glyphicon glyphicon-edit"></i></a>

									<a href="" class="chpStsCng {btn_class}" title="{status}" name="{chapter_id}"><i class="{class}"></i></a>
									
									<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
								<?php echo form_close()?>
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
	<div style="font-size:18px;color: red"><?php echo display('data_not_found')?>
	</div>
</div>
<?php
}
?>
<!-- Chapter list end -->