<!-- Model Test Page start -->
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
                <div class="teacher">
                    <h3 class="m-t-0"><?php echo display('search_result')?></h3>
                    <div class="row">
                    <?php 
                        if($course_list != null) {
                    ?>
                    {course_list}
                        <div class="col-md-4 col-sm-6">
                            <img src="{image}" alt="" class="" height="177px" width="100%">
                            <div class="description">
                                <h3>{course_name}</h3>
                                <a href="<?php echo base_url('course_exam/{course_id}')?>"><?php echo display('exam_now')?><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    {/course_list}
                    <?php
                        }else{
                            echo "<div class=\"col-md-4 col-sm-6\">";
                                echo "<p>".display('no_data_found')."</p>";
                            echo "</div>";
                        }
                    ?>
                    </div>
                    <div class="row text-center">
                        {links}
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
<!-- Model Test Page end -->