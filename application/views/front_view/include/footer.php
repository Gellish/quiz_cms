<?php
$CI =& get_instance();
$CI->load->model('front/Common_exams');
$get_web_setting = $CI->Common_exams->get_web_setting();
?>
<!-- Footer Start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="footer_text">
                    <?php if (isset($get_web_setting[0]['copyright'])) echo $get_web_setting[0]['copyright']?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="footer_text text-right">
                    
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->