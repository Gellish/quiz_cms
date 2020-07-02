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
                       <h2>{course_name}</h2>
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
                    </div>
                    <?php echo form_open('front/Cmodel_test/submit_common_exam',array('class' => 'form-horizontal','id' => 'course_add' ))?>
                        <div class="quiztest well">
                            <h3>
                            <?php 
    						if(isset($main_question)){
    							print_r(htmlspecialchars_decode($main_question));
    						}
    						?>	
    						</h3>
    						<?php
    						if(empty($question_data)){
    						?>
    							<div id="optionContainer">
    								<?php echo display('no_question_found')?>
    							</div>
    							<ul class="pager">
    								<li class="next">
    									<input type="submit" id="Finish_Exam" name="btn-submit-finish" value="<?php echo display('finish')?>" class="btn btnQuesFinish" />
    								</li>
    							</ul>
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
    						<input type="hidden" name="hour" id="hour">
    						<input type="hidden" name="min" id="min">
    						<input type="hidden" name="sec" id="sec">
                           <?php
                       		}
                           ?>
                        </div>
                    	<?php
    					if(!empty($question_data)){
    					?>
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
                        <?php } ?>
                    <?php echo form_close()?>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3><?php echo display('related_model_test')?></h3>
                        <p><?php echo display('join_our_global_community')?></p>
                    </div>
                    <?php 
                	$i=1;
                	foreach ($related_model_list as $model_test_view) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="courses">
                            <div class="box">
                                <div class="ovrly">
                                <a href="<?php echo base_url('model_test_exam')?>/<?php echo $model_test_view['model_test_id']?>">
                                    <img src="<?php echo $model_test_view['image']?>" class="img-responsive" alt="" />
                                    <div class="after"></div>
                                    <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                </a>
                                </div>
                                <div class="info">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox_<?php echo $i?>" type="checkbox">
                                        <label for="checkbox_<?php echo $i?>"><?php echo $model_test_view['model_test_name']?></label>
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
<script type="text/javascript">
	myStopWatchr = new antiClock({hour},{minute},{second});
</script>
<script type="text/javascript">
    function formSubmit(){
		 alert("Your exam time is finish");
		 document.forms["examForm"].submit();
    }
</script>
<!-- Exam start view  end-->