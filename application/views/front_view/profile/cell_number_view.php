<!-- User cell phone view start -->
<section class="main-content quiztest-content">
    <div class="container">
        <div class="row">
            <?php if ($get_top_add) { ?>
            <div class="col-sm-12">
                <div class="adds">
                    {get_top_add}
                        {add_code}
                    {/get_top_add} 
                </div>
            </div>
            <?php } $this->load->view('front_view/include/sidebar')?>
            <main class="col-sm-8 col-md-9">
                <div class="panelbody">
                    <h3><?php echo display('general_account_setting')?></h3>
                    <div class="table-responsive">
                        <table class="table chapter">
                            <tbody>
	                        	<tr>
	                        		<td><?php echo display('full_name')?></td>
									<td><center>{user_name}</center></td>
									<td><a href="<?php echo base_url('profile/edit_full_name'); ?>"><button type="submit" class="btn theme-btn"><?php echo display('edit')?> </button></a></td>
	                        	</tr>
                            	<tr>
	                            	<td><?php echo display('mobile_no')?></td>
									<td>
                                        <?php echo form_open('front/User_profile/do_user_cellno_edit',array('class' => 'form-horizontal','id' => 'user_cellno_edit' ))?>

                                            <div class="form-group">
                                                <label class="control-label" for="mobile_no"><?php echo display('mobile_no')?></label>
                                                <input type="text" title="Mobile No" value="{mobile_no}" name="mobile_no" id="mobile_no" class="form-control required">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="password"><?php echo display('password')?></label>
                                                <input type="password" title="Password" name="password" id="password" class="form-control required" placeholder="<?php echo display('password')?>">
                                                <span class="help-block small"><?php echo display('to_save_this_setting_enter_password')?></span>
                                            </div>

											<div class="controls">
												<input type="submit" class="btn btn-warning OnePxBorder" id="user_info_change" value="<?php echo display('save_changes')?>" >
												<a href="<?php echo base_url(); ?>front/User_profile" class="btn btn-danger OnePxBorder"><?php echo display('cancel')?></a>
											</div>
										<?php echo form_close()?>
									</td>
									<td>&nbsp;</td>
                            	</tr>
                            	<tr>
									<td><?php echo display('password')?></td>
									<td><center>---------</center></td>
									<td><a href="<?php echo base_url('profile/edit_password'); ?>"><button type="submit" class="btn theme-btn"><?php echo display('edit')?></button></a></td>
								</tr>
								<tr>
									<td><?php echo display('email')?></td>
									<td><center>{email}</center></td>
									<td>&nbsp;</td>
								</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Related course list start -->
                <div class="row">
                    <div class="col-sm-12">
                        <h3><?php echo display('related_courses')?></h3>
                        <p><?php echo display('join_our_global_community')?></p>
                    </div>
                    <?php 
                    $i=1;
                    if ($related_course_list) {
                        foreach ($related_course_list as $course_list) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="courses">
                            <div class="box">
                                <div class="ovrly">
                                <a href="<?php echo base_url('course_exam')?>/<?php echo $course_list['course_id']?>">
                                    <img src="<?php echo $course_list['image']?>" class="img-responsive" alt="" />
                                    <div class="after"></div>
                                    <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                </a>
                                </div>
                                <div class="info">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox_<?php echo $i?>" type="checkbox">
                                        <label for="checkbox_<?php echo $i?>"><?php echo $course_list['course_name']?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ($i==3) break;
                        $i++;
                        }
                    }
                    ?>
                </div>
                <!-- Related course list end -->
            </main>
        </div>
    </div>
</section>
<!-- User cell phone view End -->