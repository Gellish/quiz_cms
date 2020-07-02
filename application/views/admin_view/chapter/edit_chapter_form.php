<!-- Chapter list start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_chapter')?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Cchapter/update_chapter',array('class' => 'well form-verticle','id' => 'course_add','enctype' => 'multipart/form-data'))?>
   		<div class="row">
   			<div class="col-md-4">
				<div class="control-group">
					<label for="className"><?php echo display('class_name')?></label>
					<div class="controls">
						<select name="class_id" id="class_id" class="selectClassName form-control" required>
							<option value=""><?php echo display('please_select')?></option> 
							{class_list}
							<option value="{class_id}" {selected}>{class_name}</option>  
							{/class_list}
						</select>
					</div>
				</div>
				<br>
				<div class="control-group">
					<label for="inputEmail"><?php echo display('course_name')?></label>
					<div class="controls">
						<select name="course_id" class="retrieveCourseName form-control" id="class_id" required>
							<option value=""><?php echo display('please_select')?>
							</option> 
							{course_list}
							<option value="{class_id}" {selected}>{course_name}</option> 
							{/course_list}
						</select> 
					</div>
				</div>
				<br>
				<div class="control-group">
					<label class="control-label" for="chapterName"><?php echo display('chapter_name')?></label>
					<div class="controls">
						<textarea name="chapterName" class="form-control" rows="4" required >{chapter_name}</textarea>
					</div>
					<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
					<input type="hidden" value="{chapter_id}" name="chapter_id" id="chapter_id" >
				</div>
				<br>
				<div class="control-group">
					<label for="youtube_url"><?php echo display('youtube_url') ?>:</label>
					<div class="controls">
					<input type="text" class="form-control" value="{youtube_url}" name="youtube_url" id="youtube_url" >
					</div>
				</div>
				<br>
				<div class="control-group">
					<label for="chapter_file"><?php echo display('select_file') ?>:</label>
					<input type="file" id="chapter_file" name="chapter_file">
					<p><b> Upload a file like: chapter.doc or chapter.pdf </b></p>
					<input type="hidden" value="{chapter_file}" name="chapter_file_old">
				</div>
				<br>
				<div class="control-group">
					<label for="course_id"><?php echo display('select_image') ?>:</label>
					<input type="file" id="image" name="image">
				</div>
				<br>
				<div class="control-group">
					<img src="{image}" class="img img-responsive" height="80" width="80">
					<input type="hidden" name="old_image" value="{image}">
				</div>
				<br>
				<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary " value="<?php echo display('save_changes')?>" name="add-chapter">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Chapter list end -->