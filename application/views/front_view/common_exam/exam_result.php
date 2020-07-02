<!-- Question wise exam result start -->
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
                <div class="summarizeResult" style="display:none;">
                    <?php print_r(htmlspecialchars_decode($summary_result));?>
                </div>

                <div class="panelbody detailsResult">
                    <div class="Sub_name_time">
                        <h2><?php echo display('question_wise_result')?></h2>
                        <a href="#">
                            <span class="summarizeIcon"><?php echo display('view_result_summary')?> <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                        </a>
                    </div>
                    <div class="panel with-nav-tabs panel-default">
                        <?php echo form_open()?>
		                <div class="panel-heading">
	                        <ul class="nav nav-tabs">
                                {final_result_view}
                                    <div class="circleActiveBar {exam_&_ques_id}-{sl}"></div>
	                                <li class="">
                                        <a href="#tab{sl}default" class="answer_circle" name="{exam_&_ques_id}-{sl}" data-toggle="tab">{sl}</a>
                                    </li>
                                    <input type="hidden" id="baseUrl" value="<?php echo base_url()?>">
                                {/final_result_view}
	                        </ul>
		                </div>
                        <?php echo form_close()?>
                        <div id="resultAnalisys"></div>
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
                                <a href="<?php echo base_url('front/Common_exam/chapter_list')?>/<?php echo $course_list['course_id']?>">
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
<style type="text/css">
    .right_ans_tick {
    float: left;
    height: 25px;
    width: 25px;
    margin-right: 5px;
    background-image: url(<?php echo base_url()?>my-assets/images/tick.png);
}
.user_answered_option {
    color: red;
}
</style>
<!--  Question wise exam result start  -->