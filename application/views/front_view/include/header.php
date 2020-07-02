<?php
$CI =& get_instance();
$CI->load->model('front/Common_exams');
$get_web_setting = $CI->Common_exams->get_web_setting();
?>
<!-- Navbar start here -->
 <nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url()?>">
            <img src="<?php if (isset($get_web_setting[0]['logo'])) echo $get_web_setting[0]['logo']?>" alt="" class="img-responsive">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php 
	if($this->auth->is_logged()){
	?>
	{logged_info}
	<?php }else{ ?>
		<?php if(!isset($signin) && !isset($signup)){
                $active=$this->uri->segment(1);
        ?>
            <ul class="nav navbar-nav  navbar-right">
                <li class="<?php if ($active == "home") {echo "active";}?>"><a href="<?php echo base_url('home')?>"><?php echo display('home')?></a></li>
                <li class="<?php if ($active == "course") {echo "active";}?>"><a href="<?php echo base_url('course')?>"><?php echo display('start_exam')?></a></li>
                <li class="<?php if ($active == "model_test") {echo "active";}?>"><a href="<?php echo base_url('model_test')?>"><?php echo display('start_model_test')?></a></li>
                <li class=""><a href="<?php echo base_url('login'); ?>" class="btn nav-btn"><?php echo display('login')?></a></li>
                <li><a href="<?php echo base_url('signup'); ?>" class="btn nav-btn"><?php echo display('sign_up')?></a></li>
            </ul>
        <?php 
            } 
        }
        ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<!-- Navbar end here -->



