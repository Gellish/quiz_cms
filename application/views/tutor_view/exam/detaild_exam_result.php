<div class="well">
	<div style="font-size:20px;font-weight:bold;margin-bottom:5px;">Student Detaild Result</div>
	Name : <b>{student_name}</b> <br/>
	Mobile : <b>{student_mobile}</b> <br/>
</div>
	<?php if(!empty($detail_exam_result)){
		foreach($detail_exam_result as $index=>$value){
	?>
		<div style="text-align:center;font-size:17px;color:#005580;margin:5px;">
			<?php print_r(htmlspecialchars_decode($value['question_detals'])); ?>
		</div>
		<table class="table table-hover table-condensed table-striped table-bordered">
			<thead>
				<tr>			
					<th><center>Correct Answer</center> </th>
					<th><center>Student Answer</center> </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<center>
						<?php
							foreach($value['system_option_details'] as $correct_answer){
								echo htmlspecialchars_decode($correct_answer); 
							}
						?>
						</center> 
					</td>
					<td>
						<center>
						<?php
							foreach($value['user_option_details'] as $user_answer){
								echo htmlspecialchars_decode($user_answer) ; 
							}
						?>
						</center> 
					</td>
				</tr>
			</tbody>
		</table>
	<?php
		}
		
	}
	?>

