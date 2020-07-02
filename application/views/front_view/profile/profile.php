<!-- User profile start -->
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
                    <div class="Sub_name_time">
                        <h2><?php echo display('general_account_setting')?></h2>
                        <?php
                            if ($message=$this->session->userdata('message')) {
                        ?>
                        <span class="success_message"><?php echo $message;?></span>
                        <?php
                            }if ($warning_message=$this->session->userdata('warning_message')) {
                        ?>
                        <span class="warning_message"><?php echo $warning_message;?></span>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table chapter">
                            <tbody>
	                        	<tr>
	                        		<td><?php echo display('full_name')?></td>
									<td>{user_name}</td>
									<td>
                                        <a href="<?php echo base_url('profile/edit_full_name'); ?>">
                                            <button type="submit" class="btn theme-btn"><?php echo display('edit')?>
                                            </button>
                                        </a>
                                    </td>
	                        	</tr>
                            	<tr>
	                            	<td><?php echo display('mobile_no')?></td>
									<td>{mobile_no}</td>
									<td><a href="<?php echo base_url('profile/edit_phone_no'); ?>">
                                    <button type="submit" class="btn theme-btn"><?php echo display('edit')?>
                                    </button></a></td>
                            	</tr>
                            	<tr>
									<td><?php echo display('password')?></td>
									<td>---------</td>
									<td><a href="<?php echo base_url('profile/edit_password'); ?>"><button type="submit" class="btn theme-btn"><?php echo display('edit')?></button></a></td>
								</tr>
								<tr>
									<td><?php echo display('email')?></td>
									<td>{email}</td>
									<td>&nbsp;</td>
								</tr>
                            </tbody>
                        </table>
                	<div style="text-align: center"><?php if(isset($links)){echo $links;} ?></div>
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
<!-- User Profile End -->