<!-- Requested chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('request_chapter_list') ?></div>
</div>
<?php 
if($chapter_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo display('chapter_name') ?></th>
						<th><?php echo display('course_name') ?></th>
						<th><?php echo display('class_name') ?></th>
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
						<td>
							<center>
								<?php form_open()?>
									<a href="<?php echo base_url().'admin/Cchapter/chapter_edit_form/{chapter_id}'; ?>" class="btn btn-sm btn-warning" title="<?php echo display('edit') ?>"><i title="<?php echo display('edit') ?>" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


									<a href="" class="approveRequesChapter btn btn-sm btn-info" title="<?php echo display('approved') ?>" name="{chapter_id}"><?php echo display('approved') ?></a> 

									<a href="" class="deleteRequestChapter btn btn-sm btn-danger" name="{chapter_id}" title="<?php echo display('deny') ?>"><?php echo display('deny') ?></a> 

									<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
								<?php form_close()?>
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
	<div style="font-size:18px;color: red"><?php echo display('dont_found_request_chapter') ?>
	</div>
</div>
<?php
}
?>
<!-- Requested chapter list end -->