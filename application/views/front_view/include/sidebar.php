<!-- Left sidebar start -->
<aside class="col-sm-4 col-md-3">
    <?php 
    $user_name=$this->session->userdata('full_name');
    if ($user_name) {
    ?>
    <div class="user-panel text-center panelbody activities">
        <div class="image">
            <img src="<?php echo $this->session->userdata('image')?>" class="img-circle" alt="User Image">
        </div>
        <div class="info">
            <h3><?php echo display('hi')?>,<?php echo $user_name ?></h3>
        </div>
    </div>
    <?php
        }
    ?> 
    <div class="panelbody popular-quiz">
        <h3><?php echo display('popular_courses');?></h3>
        <ul>
        <?php
            if($popular_course_list){
        ?>
        {popular_course_list}
            <li>
                <img src="{image}" alt="" class="pull-left" height="50px" width="50px">
                <h5><a href="<?php echo base_url('course_exam/{course_id}')?>">{course_name}</a></h5>
            </li>
        {/popular_course_list}
        
        <?php
            }else{
                echo "<p>No Popular Course Found !</p>";
            }
        ?>
        </ul>
    </div>
    <!-- Left Advertise start -->
    <div class="panelbody popular-quiz">
        <?php
            if ($get_sidebar_add) {
        ?>
            {get_sidebar_add}
                {add_code}
            {/get_sidebar_add}
        <?php
            }else{
              echo "<p>No Ads Found !</p>";
            }
        ?>
    </div>
    <!-- Left Advertise end -->
</aside>
<!-- Left sidebar end -->