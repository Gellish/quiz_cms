<!-- Question set create start -->
<section class="main-content">
    <div class="container">
        <div class="row">
            <?php $this->load->view('front_view/include/sidebar')?>
            <main class="col-sm-8 col-md-9">
                <div class="panelbody">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <img src="{course_image}" class="" alt="" height="277" width="100%">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="details_text">
                                <h3><?php echo display('course_details')?></h3>
                                <?php echo character_limiter($course_details,'550')?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php echo form_open('front/Common_exam/create_question_set')?>
                            <div class="col-sm-12">
                                <h3><?php echo display('course_name')?> : {course_name}</h3>
                                <div class="table-responsive">
                                <?php
                                    if(!empty($chapter_list)){
                                ?>
                                    <table class="table chapter">
                                        <tbody>
                                        <input type="hidden" value="<?php echo current_url()?>" name="current_url">
                                        <?php
                                            $id=0;
                                            foreach ($chapter_list as $chapter) {
                                        ?>
                                        <tr>
<td>
    <div class="checkbox checkbox-success">
        <input type="hidden" class="totalQuestion" value="<?php echo $chapter['total_question']?>">
        <input id="checkbox_<?php echo $id?>" type="checkbox" value="<?php print_r($chapter['chapter_id']);?>" name="chapter_id[]" class="case">
        <label for="checkbox_<?php echo $id?>"><?php print_r($chapter['chapter_name']);  ?></label>
    </div>
</td>
                                            <td>
                                                <div class="chapter-title"><?php echo display('questions')?>:<?php echo $chapter['total_question']?></div>
                                            </td>

                                            <td>
                                                <span class="chapter-label"><?php echo display('lesson')?></span>
                                            </td>

                                            <td>
                                            <?php
                                            if ($chapter['youtube_url']) {
                                            ?>
                                                <a href="<?php echo $chapter['youtube_url']?>" class="chapter-link" target="_blank"><i class="fa fa-youtube"></i></a>
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            <td>
                                            <?php
                                                $chapter_list=$chapter['chapter_file'];
                                                $index=explode(".",$chapter_list);
                                                $last_index=end($index);

                                                if ($last_index == 'pdf') {
                                                echo "<a href=".$chapter['chapter_file']." class=\"chapter-link\" target=\"_blank\"><i class=\"fa fa-file-pdf-o\"></i></a>";
                                                }elseif ($last_index == 'doc' || $last_index == 'docx' || $last_index == 'word'){
                                                echo "<a href=".$chapter['chapter_file']." target=\"_blank\" class=\"chapter-link\"><i class=\"fa fa-file-word-o\"></i></a>";
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                            $id++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row q_number">
                                            <label class="col-sm-5 col-md-5" for="spinner"><?php echo display('no_of_question')?>:</label>
                                            <div class="col-sm-7 col-md-7">
                                                <input class="form-control noOfQueField" type="number" id="spinner" min="0" name="no_of_question">
                                                <input type="hidden" value="{course_id}" name="course_id" />
                                            </div>
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
                                            <input type="hidden" name="total_ques" value="<?php echo $total_ques;?>">
                                        <?php
                                        if ($total_ques != 0) {
                                        ?>
                                            <button type="submit" class="btn theme-btn" id="add-exam" name="add-exam"><?php echo display('start_an_exam')?></button>
                                        <?php
                                        }else{
                                            echo "<p style=\"color:red\">".display('no_question_found')."</p>";
                                        }
                                        ?>
                                        <span class="text-right" style="margin-left: 20px;color:red;font-size: 16px;">
                                            <?php echo $this->session->userdata('message')?>
                                        </span>
                                       
                                        </div>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <table class="table chapter">
                                        <tbody>
                                            <tr>
                                                <td><?php echo display('chapter_not_found')?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
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
    if ($related_course_list) {
    ?>
    <div class="related_course">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3><?php echo display('related_courses')?></h3>
                    <p><?php echo display('join_our_global_community')?></p>
                </div>
                {related_course_list}
                <div class="col-sm-3">
                    <div class="courses">
                        <div class="box">
                            <div class="ovrly">
                                 <a href="<?php echo base_url('front/Common_exam/chapter_list/{course_id}')?>">
                                    <img src="{image}" class="img-responsive" alt="" />
                                    <div class="after"></div>
                                    <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                </a>
                            </div>
                            <div class="info">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox8" type="checkbox">
                                    <label for="checkbox8">{course_name}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/related_course_list}
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</section>
<!-- Question set create end -->

<script type="text/javascript">
    //Select all checkbox
    $("#selectall").click(function () {
    var checkAll = $("#selectall").prop('checked');
        if (checkAll) {
            $(".case").prop("checked", true);
        } else {
            $(".case").prop("checked", false);
        }
    });

    //Check box validation
    $('input:checkbox').on('change', function () {
        var sum = 0;
        $('.case').each(function () {
            if (this.checked) 
                sum = sum + parseFloat($(this).prev().val());
        });  
        $('#spinner').val(sum);
        $('#spinner').attr('max',sum);
    });
</script> 