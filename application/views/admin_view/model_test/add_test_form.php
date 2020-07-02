<!-- Add model test start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('add_model_test')?>
	</div>
</div>
<div class="row-fluid">
	<?php echo form_open('admin/Cmodel_test/insert_model_test',array('class' =>'well form-horizontal','id' => 'course_add','enctype' => 'multipart/form-data'))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('model_test_name')?></label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="model_test_name" id="model_test_name" required placeholder="<?php echo display('model_test_name')?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?></label>
				  	<div class="col-sm-7">
				   		<select name="class_id" id="class_id" class="selectModelTestClass form-control" required>
							<option value=""><?php echo display('please_select')?></option> 
							{class_list}
							<option value="{class_id}">{class_name}</option>  
							{/class_list}
						</select>
						<input type="hidden" name="baseUrl" value="<?php echo base_url()?>" id="baseUrl">
				  	</div>
				</div>

				<div class="form-group row selectClass">
					<label for="example-text-input" class="col-sm-3 col-form-label">&nbsp;</label>
				  	<div class="col-sm-9">
				   		<div id="wait_load" ></div>
						<div class="retrieveSubjectName"></div>
				  	</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('time_duration')?></label>
				  	<div class="col-sm-7">
				   		<select name="dura_hour" id="dura_hour" class="form-control">
				   			<option value="00" selected="selected"><?php echo display('select_hour')?></option>
							<option value="00"><?php echo display('00_hour')?></option>
							<option value="01"><?php echo display('01_hour')?></option>
							<option value="02"><?php echo display('02_hour')?></option>
							<option value="03"><?php echo display('03_hour')?></option>
							<option value="04"><?php echo display('04_hour')?></option>
							<option value="05"><?php echo display('05_hour')?></option>
							<option value="06"><?php echo display('06_hour')?></option>
							<option value="07"><?php echo display('07_hour')?></option>
							<option value="08"><?php echo display('08_hour')?></option>
							<option value="09"><?php echo display('09_hour')?></option>
							<option value="10"><?php echo display('10_hour')?></option>
							<option value="11"><?php echo display('11_hour')?></option>
							<option value="12"><?php echo display('12_hour')?></option>
						</select>
						<select name="dura_min" id="dura_min" class="form-control">
							<option value="00" selected="selected"><?php echo display('select_minutes')?></option>
							<option value="00"><?php echo display('00_minutes')?></option>  
							<option value="05"><?php echo display('05_minutes')?></option>  
							<option value="10"><?php echo display('10_minutes')?></option>  
							<option value="15"><?php echo display('15_minutes')?></option>  
							<option value="20"><?php echo display('20_minutes')?></option>  
							<option value="30"><?php echo display('30_minutes')?></option>  
							<option value="35"><?php echo display('35_minutes')?></option>  
							<option value="40"><?php echo display('40_minutes')?></option>  
							<option value="45"><?php echo display('45_minutes')?></option>  
							<option value="50"><?php echo display('50_minutes')?></option>  
							<option value="55"><?php echo display('55_minutes')?></option>  
							<option value="58"><?php echo display('58_minutes')?></option>
						</select>
				  	</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('model_test_details')?></label>
					<div class="col-sm-7">
						<textarea name="test_details" required class="form-control mytextarea"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('select_image') ?></label>
				  	<div class="col-sm-9">
				   		<input type="file" id="image" name="image">
				   		<p>Image size : (Width:652px,Height:435px)</p>
				  	</div>
				</div>
				<div class="form-group row">
				    <div class="col-sm-11">
				        <input type="submit" class="btn btn-primary" value="<?php echo display('add_model_test')?>" name="add-chapter">
				    </div>
			    </div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Add model test end -->