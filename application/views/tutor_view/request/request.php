<h2>Chapter list</h3>
<div class="row-fluid">
	<div>
		<form class="well form-inline" method="post" action="#">
			<label class="select">Select Class: </label>
			<select name="class_name" id="class_name">
			</select> 
			<label class="text"> Search keyword: </label> 
			<input type="text" name="keyword"> 
			<button type="submit" class="btn">Search</button>
		</form>
	</div>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Chapter Name</th>
			<th>Course Name</th>
			<th>Class Name</th>
			<th>Action</th>
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
					<a href="<?php echo base_url().'tutor/Tchapter/chapter_edit_form/{chapter_id}'; ?>"><i title="Edit" class="icon-edit"></i></a>
				</center>
			</td>
		</tr>
	{/chapter_list}
	</tbody>
</table>
<?=$this->load->view('tutor_view/layout_modal')?>
<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
