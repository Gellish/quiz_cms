<!-- All student list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('student_list')?></div>
</div>
<div class="row-fluid">
	<div>
		<?php echo form_open('tutor/Tstudent/student_search_by_batch',array('class' => 'well form-inline'))?>
			<div class="form-group">
				<label for="class_name"><?php echo display('seacrh_by_batch')?>: </label>
				<select name="batch_id" id="batch_id" class="form-control">
					<option value=""><?php echo display('please_select')?></option> 
					{batch_list}
					<option value="{batch_id}">{batch_name}</option>  
					{/batch_list}
				</select> 
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-default"><?php echo display('search')?></button>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<table class="table table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Student Name</th>
			<th>Student Email</th>
			<th>Contact Details</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	{student_list}
		<tr>
			<td>{sl}</td>
			<td>{user_name}</td>
			<td>{email}</td>
			<td>{contact_details}</td>
			<td>
				<center>
					<?php echo form_open();?>
						<a href="" class="deleteStudent" name="{batch_id}-{user_id}"><i title="<?php echo display('delete')?>" class="fa fa-trash-o" aria-hidden="true"></i></a>
						<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
					<?php form_close()?>
				</center>
			</td>
		</tr>
	{/student_list}
	</tbody>
</table>
<div class="test"></div>
<!-- All student list end -->