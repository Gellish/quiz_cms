<div class="form-container">
    <form class="form-vertical" action="<?=base_url()?>tutor/texam/questionIn_sequence" id="create_questions" method="post"  name="insert_exam" enctype="multypart/formdata">
        <legend>Select Questions From Below List</legend>
			<div class="row-fluid">
				<div class="controls">
					<div class="qstnSrcReport">
					{questions_name}
						<input type="checkbox" name="question_id[]" value="{question_id}" id="qstn_src_type" /> &nbsp; {question_detals} </br>
					{/questions_name}
					</div>
					<input type="hidden" name="startLevel" value="{startLevel}" />
				</div>
			</div>
        <div class="form-actions">
            <input type="submit" id="add-exam" class="btn btn-primary btn-large" name="add-exam" value="Next" />
        </div>
    </form>
</div>
