<style type="text/css">
    .search-inner {
        background: #353b65 url("<?php echo $back_image?>") no-repeat scroll center top;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: auto;
        min-height: 336px;
        min-height: 400px;
        padding: 35px 0;
        position: relative;
    }
</style>
<!-- Home Page Start -->
<div class="search-inner">
    <div class="search-area container">
        <h3 class="search-title"><?php echo display('have_any_query');?></h3>
        <p class="search-tag-line"><?php echo display('what_are_you_looking_for');?></p>
        <?php echo form_open('front/Common_exam/search_course',array('class' => 'search-form clearfix' ))?>
            <input type="text" title="<?php echo display('what_you_search');?>" placeholder="<?php echo display('types_your_term_here');?>" class="search-term search_keyord " name="search_value">
            <input type="submit" value="<?php echo display('search');?>" class="search-btn srch_button" data-loading-text="Loading...">
            <input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
        <?php echo form_close()?>
    </div>
</div>
<section class="main-content">
    <div class="container">
        <div class="row">
           	<?php $this->load->view('front_view/include/sidebar')?>
            <main class="col-sm-8 col-md-9">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title">
                            <h3><?php echo display('all_courses')?></h3>
                        </div>
                    </div>
                    <div id="owl-subject" class="owl-carousel owl-theme hide-old">
                        <?php
                            if ($course_list) {
                        ?>
                        {course_list}
                        <div class="item">
                            <div class="courses">
                                <div class="box">
                                    <div class="ovrly">
                                    <a href="<?php echo base_url('course_exam/{course_id}')?>">
                                        <img src="{image}" class="img-responsive" alt="" />
                                        <div class="after"></div>
                                        <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                    </a>
                                    </div>
                                    <div class="info">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox{course_id}" type="checkbox">
                                            <label for="checkbox{course_id}">{course_name}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {/course_list}
                        <?php
                            }else{
                            ?>
                             <div class="item">
                                <div class="courses">
                                    <?php
                                        echo "<p>No Course Found !</p>";
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title">
                            <h3><?php echo display('model_test')?></h3>
                        </div>
                    </div>
                    <div id="owl-test" class="owl-carousel owl-theme">
                        <?php
                            if ($model_test_list) {
                        ?>
                        {model_test_list}
                        <div class="item">
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
                                            <input id="checkbox_{model_test_id}" type="checkbox">
                                            <label for="checkbox_{model_test_id}">{model_test_name}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {/model_test_list}
                        <?php
                            }else{
                            ?>
                             <div class="item">
                                <div class="courses">
                                    <?php
                                        echo "<p>No Model Test Found !</p>";
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title">
                            <h3><?php echo display('new_added_courses')?></h3>
                        </div>
                    </div>
                    <div id="owl-add" class="owl-carousel owl-theme">
                        <?php
                            if ($newly_course_list) {
                        ?>
                        {newly_course_list}
                        <div class="item">
                            <div class="courses">
                                <div class="box">
                                    <div class="ovrly">
                                    <a href="<?php echo base_url('course_exam/{course_id}')?>">
                                        <img src="{image}" class="img-responsive" alt="" />
                                        <div class="after"></div>
                                        <img src="<?php echo base_url()?>assets/images/icon1.png" class="c-logo" alt="" />
                                    </a>
                                    </div>
                                    <div class="info">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox__{course_id}" type="checkbox">
                                            <label for="checkbox__{course_id}">{course_name}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       {/newly_course_list}
                        <?php
                            }else{
                            ?>
                             <div class="item">
                                <div class="courses">
                                    <?php
                                        echo "<p>No New Course Found !</p>";
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="add">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p>
                        <a href="<?php echo $first_url?>" target="_blank">
                            <img src="<?php echo $first_image?>" alt="" class="img-responsive">
                        </a>
                    </p>
                </div>
                <div class="col-sm-4">
                    <p>
                        <a href="<?php echo $second_url?>" target="_blank">
                            <img src="<?php echo $second_image?>" alt="" class="img-responsive">
                        </a>
                    </p>
                </div>
                <div class="col-sm-4">
                      <p>
                        <a href="<?php echo $third_url?>" target="_blank">
                            <img src="<?php echo $third_image?>" alt="" class="img-responsive">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Page End -->