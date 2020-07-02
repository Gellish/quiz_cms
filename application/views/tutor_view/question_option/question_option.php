<div class="poll_detail_view">
	<div class="poll_header">
		<?php if(isset($question_details)){print_r(htmlspecialchars_decode($question_details));} ?>
	</div>
	<div class="poll_option">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><center>Answer</center></th>
					<th><center>Question Options</center></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if(!empty($option_list)){
				foreach($option_list as $value){ ?>
					<tr>
						<td width="2%">
							<center><input type="checkbox" value="<?php print_r($value['question_option_id']);?>" <?php if(isset($value['checked'])){print_r($value['checked']);} ?> name="answer_id"></center>
						</td>
						<td>
							<center><?php print_r(htmlspecialchars_decode($value['option_details'])); ?></center>
						</td>
					</tr>
			<?php
				}
			}
			?>
			</tbody>
		</table>
	</div>
</div>
