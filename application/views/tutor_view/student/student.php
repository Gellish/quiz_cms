<!-- All student list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('all_student')?></div>
</div>

<?php
if ($student_list){
?>
<div class="panel" style="background-color:#f6f6f6">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTableExample2">
				<thead>
						<tr>
							<th>#</th>
							<th><?php echo display('student_name')?></th>
							<th><?php echo display('student_email')?></th>
							<th><?php echo display('contact_no')?></th>
						</tr>
					</thead>
					<tbody>
					{student_list}
						<tr>
							<td>{sl}</td>
							<td>{user_name}</td>
							<td>{email}</td>
							<td>{mobile_no}</td>
						</tr>
					{/student_list}
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