<!-- Add chapter form start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_chapter') ?></div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Cchapter/insert_cchapter',array('class' => 'well form-horizontal','id' => 'course_add','enctype' => 'multipart/form-data' ))?>
    	<div class="row">
			<div class="col-md-4">
				<div class="control-group">
					<label for="className"><?php echo display('class_name') ?>:</label>
					<select name="class_id" id="class_id" class="selectClassName form-control" required>
						<option value=""><?php echo display('please_select') ?></option> 
						{class_list}
							<option value="{class_id}">{class_name}</option>  
						{/class_list}
					</select>
				</div>
				<br>
				<div class="control-group">
					<label for="course_id"><?php echo display('course_name') ?>:</label>
					<select name="course_id" class="form-control retrieveCourseName" id="class_id" required>
						<option value="0"><?php echo display('please_select') ?></option>
					</select> 
				</div>
				<br>
				<div class="control-group">
					<label for="chapterName"><?php echo display('chapter_name') ?>:</label>
					<div class="controls">
						<textarea name="chapterName" class="form-control" rows="4" required ></textarea>
					</div>
					<input type="hidden" value="<?php echo base_url(); ?>" name="baseUrl" id="baseUrl" >
				</div>
				<br>
				<div class="control-group">
					<label for="youtube_url"><?php echo display('youtube_url') ?>:</label>
					<div class="controls">
					<input type="text" class="form-control" placeholder="https://www.youtube.com/" name="youtube_url" id="youtube_url" >
					</div>
				</div>
				<br>
				<div class="control-group">
					<label for="chapter_file"><?php echo display('select_file') ?>:</label>
					<input type="file" id="chapter_file" name="chapter_file">
					<p><b> Upload a file like: chapter.doc or chapter.pdf </b></p>
				</div>
				<br>
				<div class="control-group">
					<label for="course_id"><?php echo display('select_image') ?>:</label>
					<input type="file" id="image" name="image">
					<p>Image size : (Width:652px,Height:435px)</p>
				</div>
				<br>
				<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary" value="<?php echo display('save') ?>" name="add-chapter">
						<input type="submit" class="btn btn-warning" value="<?php echo display('save_another') ?>" name="add-chapter-another">
					</div>
				</div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Add chapter form end -->
