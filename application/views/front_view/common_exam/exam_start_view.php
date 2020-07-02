<!-- JS timer -->
<script src="<?php echo base_url(); ?>my-assets/js/frontview_js/exam_timer.js" type="text/javascript"></script>

<!-- Exam start view  page start-->
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
                       <h2><?php echo display('course')?> : {course_name}</h2>
                       <span>
                       		<div id="examInstraction">
								<div id="clockContaner">
									<div class="clockWatch">
									</div>
									<div class="examTimer">
										<span class="timeSec"></span>
										<span class="timeMin"></span>
										<span class="timeHour"></span>
                                        <span><?php echo display('time')?> : </span>
									</div>
								</div>
							</div>
                       </span>
                       <script type="text/javascript">
                            myStopWatchr = new stopWatch({hour},{minute},{second});
                        </script>
                    </div>
                    <?php echo form_open('front/Common_exam/submit_common_exam',array('id' => 'course_add', 'class' => 'form-horizontal'))?>
                        <div class="quiztest well">
                            <h3><?php if(isset($main_question)){echo strip_tags((htmlspecialchars_decode($main_question)));
    							}?></h3>
    						<?php
    						if(empty($question_data)){
    						?>
    						<div id="optionContainer">
                                <?php echo display('no_question_found')?>
    						</div>
    						<div id="examBtnContainer">
    							<input type="submit" id="Finish_Exam" name="btn-submit-finish" value="<?php echo display('finish')?>" class="btnQuesFinish" />
    						</div>
    						<?php
    						}else{
    						?>
    						<?php 
    						$id=0;
    						foreach($question_data as $value){ 
    							if ($value['answer_type']=="radio") {
    						?>
    						<div class="radio radio-success">
                                <input id="radio<?php echo $id?>" value="<?php print_r($value['question_option_id']); ?>" <?php if(isset($value['checked'])){ print_r($value['checked']); } ?> name="option_id[]" type="<?php print_r($value['answer_type']); ?>">
                                <label for="radio<?php echo $id?>"><?php print_r(htmlspecialchars_decode($value['option_details'])); ?></label>
                            </div>
    						<?php
    						}else{
    						?>
    						<div class="checkbox checkbox-success">
    						    <input id="checkbox<?php echo $id?>" type="checkbox" value="<?php print_r($value['question_option_id']); ?>" <?php if(isset($value['checked'])){ print_r($value['checked']); } ?> name="option_id[]" type="<?php print_r($value['answer_type']); ?>">
    						    <label for="checkbox<?php echo $id?>"><?php print_r(htmlspecialchars_decode($value['option_details'])); ?></label>
    						</div>
    						<?php
    						}
    						$id++;
    						}
    						?>
    						<input type="hidden" value="{question_id}" name="hdn_qstn_id">
                           <?php
                       		}
                           ?>
                        </div>
                    
    					<ul class="pager">
                            <?php if($btn_previous == "show"){ ?>
    							<li class="previous">
    								<input type="submit" id="prev_ques" name="btn-submit-previous" value="<?php echo display('previous')?>" class="btn btnQuesPrev" />
    							</li>
    						<?php } if($btn_next == "show"){ ?>
    							<li class="next">
    								<input type="submit" id="next_ques" name="btn-submit-next" value="<?php echo display('next')?>" class="btn btnQuesNext" />
    							</li>
    						<?php }else{ ?>
    							<li class="next">
    								<input type="submit" id="Finish_Exam" name="btn-submit-finish" value="<?php echo display('finish')?>" class="btn btnQuesFinish" />
    							</li>
    						<?php } ?>	
                        </ul>
                    <?php echo form_close()?>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3><?php echo display('related_courses')?></h3>
                        <p><?php echo display('join_our_global_community')?></p>
                    </div>
                    <?php 
                	$i=1;
                	foreach ($related_course_list as $course_list) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="courses">
                            <div class="box">
                                <div class="ovrly">
                                    <img src="<?php echo $course_list['image']?>" class="img-responsive" alt="" />
                                    <div class="after"></div>
                                    <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                </div>
                                <div class="info">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox1" type="checkbox">
                                        <label for="checkbox1"><?php echo $course_list['course_name']?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if ($i==3) break;
                    $i++;
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
</section>
<!-- Exam start view  end-->