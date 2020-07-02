<!-- Edit model test start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_model_test')?></div>
</div>
<div class="row-fluid">
	<?php list($hour,$minute,$second) = explode(":",$duration); ?>
	<?php echo form_open('admin/Cmodel_test/update_model_test',array('class' => 'well form-horizontal','id' => 'model_test_add_form','enctype' => 'multipart/form-data' ))?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('model_test_name')?></label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="model_test_name" value="{model_test_name}" id="model_test_name" required placeholder="Model test name">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('class_name')?></label>
				  	<div class="col-sm-7">
				   		<select name="class_id" id="class_id" class="selectModelTestClass form-control" required>
							<option value=""><?php echo display('please_select')?></option> 
							{class_list}
							<option value="{class_id}" {selected}>{class_name}</option>  
							{/class_list}
						</select>
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label">&nbsp;</label>
				  	<div class="col-sm-9">
				   		<div id="wait_load" ></div>
						<div class="retrieveSubjectName">
							<table class='table table-striped table-condensed table-bordered'>
								<thead>
									<tr>
										<th><?php echo display('subject')?></th>
										<th><?php echo display('no_of_question')?></th>
									</tr>
								</thead>
								<tbody>
									{subject_data}
									<tr>
										<td>
											<input type="hidden" name="course_id[]" value="{course_id}" id="no_of_ques" />
											{course_name}
										</td>
										<td>
											<input type='number' name='no_of_ques[]' id='no_of_ques' class='form-control' value="{no_of_ques}" max='{no_of_ques}' min='0' required="" /></td>
									</tr>
									{/subject_data}	
								</tbody>
							</table>
						</div>
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('time_duration')?></label>
				  	<div class="col-sm-7">
				   		<select name="dura_hour" id="dura_hour" class="form-control">
							<option value="00" <?php if(isset($hour) && $hour=="00"){echo "selected='selected'";} ?>><?php echo display('00_hour')?></option>
							<option value="01" <?php if(isset($hour) && $hour=="01"){echo "selected='selected'";} ?>><?php echo display('01_hour')?></option>
							<option value="02" <?php if(isset($hour) && $hour=="02"){echo "selected='selected'";} ?>><?php echo display('02_hour')?></option>
							<option value="03" <?php if(isset($hour) && $hour=="03"){echo "selected='selected'";} ?>><?php echo display('03_hour')?></option>
							<option value="04" <?php if(isset($hour) && $hour=="04"){echo "selected='selected'";} ?>><?php echo display('04_hour')?></option>
							<option value="05" <?php if(isset($hour) && $hour=="05"){echo "selected='selected'";} ?>><?php echo display('05_hour')?></option>
							<option value="06" <?php if(isset($hour) && $hour=="06"){echo "selected='selected'";} ?>><?php echo display('06_hour')?></option>
							<option value="07" <?php if(isset($hour) && $hour=="07"){echo "selected='selected'";} ?>><?php echo display('07_hour')?></option>
							<option value="08" <?php if(isset($hour) && $hour=="08"){echo "selected='selected'";} ?>><?php echo display('08_hour')?></option>
							<option value="09" <?php if(isset($hour) && $hour=="09"){echo "selected='selected'";} ?>><?php echo display('09_hour')?></option>
							<option value="10" <?php if(isset($hour) && $hour=="10"){echo "selected='selected'";} ?>><?php echo display('10_hour')?></option>
							<option value="11" <?php if(isset($hour) && $hour=="11"){echo "selected='selected'";} ?>><?php echo display('11_hour')?></option>
							<option value="12" <?php if(isset($hour) && $hour=="12"){echo "selected='selected'";} ?>><?php echo display('12_hour')?></option>
						</select>
						<select name="dura_min" id="dura_min" class="form-control">
							<option value="00" <?php if(isset($minute) && $minute=="00"){echo "selected='selected'";} ?>><?php echo display('00_minutes')?></option>  
							<option value="05" <?php if(isset($minute) && $minute=="05"){echo "selected='selected'";} ?>><?php echo display('05_minutes')?></option>  
							<option value="10" <?php if(isset($minute) && $minute=="10"){echo "selected='selected'";} ?>><?php echo display('10_minutes')?></option>  
							<option value="15" <?php if(isset($minute) && $minute=="15"){echo "selected='selected'";} ?>><?php echo display('15_minutes')?></option>  
							<option value="20" <?php if(isset($minute) && $minute=="20"){echo "selected='selected'";} ?>><?php echo display('20_minutes')?></option>  
							<option value="30" <?php if(isset($minute) && $minute=="30"){echo "selected='selected'";} ?>><?php echo display('30_minutes')?></option>  
							<option value="35" <?php if(isset($minute) && $minute=="35"){echo "selected='selected'";} ?>>35 Min</option>  
							<option value="40" <?php if(isset($minute) && $minute=="40"){echo "selected='selected'";} ?>><?php echo display('40_minutes')?>/option>  
							<option value="45" <?php if(isset($minute) && $minute=="45"){echo "selected='selected'";} ?>><?php echo display('45_minutes')?></option>  
							<option value="50" <?php if(isset($minute) && $minute=="50"){echo "selected='selected'";} ?>><?php echo display('50_minutes')?></option>  
							<option value="55" <?php if(isset($minute) && $minute=="55"){echo "selected='selected'";} ?>><?php echo display('55_minutes')?></option>  
							<option value="58" <?php if(isset($minute) && $minute=="58"){echo "selected='selected'";} ?>><?php echo display('58_minutes')?></option>
						</select>
				  	</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('model_test_details')?></label>
					<div class="col-sm-7">
						<textarea name="test_details" required class="form-control mytextarea">
							{test_details}
						</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('select_image') ?></label>
				  	<div class="col-sm-9">
				   		<input type="file" id="image" name="image">
				  	</div>
				</div>
				<div class="form-group row">
				  	<div class="col-sm-9">
				  		<img class="img img-responsive" src="{image}" height="80" width="80">
				   		<input type="hidden" id="image" name="old_image" value="{image}">
				  	</div>
				</div>
				<div class="form-group row">
				    <div class="col-sm-11">
				    	<input type="hidden" name="model_test_id" value="{model_test_id}">
				        <input type="submit" class="btn btn-primary" value="<?php echo display('save_changes')?>" name="add-chapter">
				    </div>
				    <input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
			    </div>
			</div>
		</div>
    <?php echo form_close()?>
</div>
<!-- Edit model test end -->
