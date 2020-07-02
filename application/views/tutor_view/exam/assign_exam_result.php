<div class="well">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('assigned_exam_result')?></div>
</div>
<?php 
	if(!empty($assign_exam_result)){
?>
<table class="table table-hover table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Student Name</th>
			<th>Mobile No.</th>
			<th>Exam Name</th>
			<th>Course Name</th>
			<th>Attend Date</th>
			<th>No. Of Question</th>
			<th>Total Ans</th>
			<th>Duration</th>
			<th>Marks</th>
		</tr>
	</thead>
	<tbody>
	{assign_exam_result}
		<tr>
			<td>{sl}</td>
			<td><a href="<?php echo base_url().'tutor/texam/student_detail_result/{user_id}/{exam_id}'; ?>">{user_name}</a></td>
			<td>{mobile_no}</td>
			<td>{exam_name}</td>
			<td>{course_name}</td>
			<td>{attend_date}</td>
			<td>{number_of_question}</td>
			<td>{total_answered}</td>
			<td>{duration}</td>
			<td>{marks} %</td>
		</tr>
	{/assign_exam_result}
	</tbody>
</table>
<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
<?php 
}else{?>
	<div class="well" style="margin-top: 10px;">
		<div style="font-size:18px;color: red"><?php echo display('no_data_found')?></div>
	</div>
<?php
}
?>