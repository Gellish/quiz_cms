<!-- Schedule Exam Statics -->
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
                    <h3><?php echo display('exam_schedule')?></h3>
                    <div class="table-responsive">
                        <table class="table chapter">
                        	<?php	 
							if(!empty($schedule_exam)){
							?>
                        	<thead>
                                <th>#</th>
                                <th><?php echo display('teacher_name')?></th>
                                <th><?php echo display('exam_name')?></th>
                                <th><?php echo display('subject')?></th>
                                <th><?php echo display('assign_date')?></th>
                                <th><?php echo display('participate_exam')?></th>
                        	</thead>
                            <tbody>
                            	{schedule_exam}
								<tr>
									<td>{sl}</td>
									<td>{user_name}</td>
									<td>{exam_name}</td>
									<td>{course_name}</td>
									<td>{assign_date}</td>
									<td>
										<a href="<?php echo base_url('front/user_exam_info/attend_tutor_provided_exam')?>/{exam_id}" style="color:white"><button type="submit" class="btn theme-btn"><?php echo display('exam_now')?></button></a>
									</td>
								</tr>
								{/schedule_exam}
                            </tbody>
	                        <?php
	                    	}else{
	                    		?>
	                    		<tr>
									<td><?php echo display('no_exam_found')?></td>
								</tr>
	                    		<?php
	                    	}
	                        ?>
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
<!-- Schedule Exam Statics -->