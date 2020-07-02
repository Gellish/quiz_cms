<h3>Create New Exam</h3>
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/course_name.js.php" ></script>
<div class="form-container">
    <form class="form-vertical" action="<?=base_url()?>tutor/Texam/create_questions" id="create_questions" method="post"  name="insert_exam" enctype="multypart/formdata">
		<div class="row-fluid">
			<div class="span5">
            	<div class="control-group">
                    <label class="control-label"><b>Exam Name</b></label>
                    <div class="controls">
                        <input type="text" class="span8" name="exam_name" id="exam_name" placeholder="Exam Name" required />
                    </div>
				</div>
            </div>
			<div class="control-group">
				<label class="control-label"><b>No Of Question</b></label>
				<div class="controls">
					<input type="text" class="span3" name="no_of_question" id="no_of_question" placeholder="No Of Question" required />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><b>Subject Name</b></label>
				<div class="controls">
					<div class="controls">
						<input type="text" name="course_name" class="span4 courseSelection" placeholder='Type Course Name' id="course_name" >
						<input type="hidden" class="course_hidden_value" name="course_id" id="course_id"/>
						<input type="hidden" name="baseUrl" value="<?php echo base_url();?>" id="baseUrl" id="baseUrl"/>
						<div id="loader" style="float:left;display:none;">
							<img src="<?=base_url();?>my-assets/images/loading_icon.gif" height="20" width="25">
						</div>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><b>Chapter Name</b>(Click Press "Ctrl" Key For Multiple Select)</label>
				<div class="controls">
					<div class="controls">
						<select name="chapter_id[]" multiple="multiple" class="select_feedback span4">
						</select>
					</div>
				</div>
			</div>
        </div>
        <div class="form-actions">
            <input type="submit" id="add-exam" class="btn btn-primary btn-large" name="add-exam" value="Next Step" />
        </div>
    </form>
</div>
