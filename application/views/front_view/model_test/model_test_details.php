<!-- Question set create start -->
<section class="main-content">
    <div class="container">
        <div class="row">
            <?php $this->load->view('front_view/include/sidebar')?>
            <main class="col-sm-8 col-md-9">
                <div class="panelbody">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <img src="{model_test_image}" class="" alt="" height="250" width="100%">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="details_text">
                                <h3><?php echo display('model_test_details')?></h3>
                                <?php echo character_limiter($test_details,'550')?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php echo form_open('front/Cmodel_test/model_test_question_set',array('class' =>'form-horizontal' ,'id' => '' ))?>
                            <div class="col-sm-12">
                                <div class="Sub_name_time">
                                    <h3><?php echo display('model_test')?> : {model_test_name}</h3>
                                </div>
                               <div class="table-responsive">
                                <?php
                                if(!empty($subject_data)){ 
                                ?>
                                    <table class="table chapter">
                                        <tbody>
                                            <tr>
                                                <td><div class="chapter-title"><?php echo display('subject_name')?></div></td>
                                                <td><div class="chapter-title"><?php echo display('no_of_question')?></div></td>
                                            </tr>
                                            {subject_data}
                                            <tr>
                                                <td>{course_name}</td>
                                                <input type="hidden" name="course_id[]" value="{course_id}">
                                                <td>{no_of_ques}</td>
                                                <input type="hidden" name="no_of_ques[]" value="{no_of_ques}">
                                            </tr>
                                            {/subject_data}
                                            <tr>
                                                <td><div class="chapter-title"><?php echo display('total_question')?></div></td>
                                                <td><div class="chapter-title">{total_ques}</div> </td>
                                                <input type="hidden" name="qstn_limit" value="{total_ques}">
                                                <input type="hidden" name="model_test_id" value="{model_test_id}">
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="test-hints">
                                    <h3><?php echo display('instructions')?>:</h3>
                                    <p>1.<?php echo display('instruction_1')?></p>
                                    <p>2.<?php echo display('instruction_2')?></p>
                                    <p>3.<?php echo display('instruction_3')?></p>
                                    <h3><?php echo display('count_your_score')?></h3>
                                    <p><?php echo display('count_your_score_details')?></p>
                                <?php
                                if ($subject_data[0]['no_of_ques'] != 0) {
                                ?>
                                    <button type="submit" class="btn theme-btn" id="add-exam" name="add-exam"><?php echo display('start_an_exam')?></button>
                                <?php
                                }else{
                                    echo "<p style=\"color:red\">".display('no_question_found')."</p>";
                                }
                                ?>
                                </div>
                            </div>
                       <?php echo form_close()?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
    if ($related_model_list) {
    ?>
    <div class="related_course">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3><?php echo display('model_test_list')?></h3>
                    <p><?php echo display('join_our_global_community')?></p>
                </div>
                {related_model_list}
                <div class="col-sm-3">
                    <div class="courses">
                        <div class="box">
                            <div class="ovrly">
                                <a href="<?php echo base_url('model_test_exam/{model_test_id}')?>">
                                    <img src="{image}" class="img-responsive" alt="" />
                                    <div class="after"></div>
                                    <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                </a>
                            </div>
                            <div class="info">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox8" type="checkbox">
                                    <label for="checkbox8">{model_test_name}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/related_model_list}
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</section>
<!-- Question set create end -->

<!-- Select all subject  -->
<script type="text/javascript">
    $("#selectall").click(function () {
    var checkAll = $("#selectall").prop('checked');
        if (checkAll) {
            $(".case").prop("checked", true);
        } else {
            $(".case").prop("checked", false);
        }
    });
</script> 



