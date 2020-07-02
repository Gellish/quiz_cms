<!-- Login page start-->
<div class="login-wrapper">
    <div class="container-center">
        <div class="view-header">
            <div class="header-icon">
                <i class="page-header-icon fa fa-sign-in"></i>
            </div>
            <div class="header-title">
                <h3><?php echo display('login')?></h3>
                <small><p><?php echo display('enter_login_info')?><p></small>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
            <?php echo form_open('front/Signup/do_login',array('id' => 'signInForm', ))?>
                <?php 
                    if ($error=$this->session->userdata('error_message')) {
                ?>
                <div class="form-group">
                    <p class="error text-center"><?php echo $error;?></p>
                </div>
                <?php 
                    }
                ?>
                <div class="form-group">
                    <label class="control-label" for="username"><?php echo display('email')?></label>
                    <input type="email" placeholder="example@gmail.com" title="<?php echo display('email')?>" required value="" name="username" id="username" class="form-control">
                    <span class="help-block small"><?php echo display('unique_email')?></span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <input type="password" title="<?php echo display('password')?>" placeholder="******" required value="" name="password" id="password" class="form-control">
                    <span class="help-block small"><?php echo display('strong_password')?></span>
                </div>
                <div>
                <a class="btn btn-warning" href="<?php echo base_url('signup'); ?>"><?php echo display('register')?></a>
                <button class="btn btn-primary"><?php echo display('login')?></button>
                <a class="btn btn-info" href="<?php echo $this->facebook->login_url(); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i> <?php echo display('facebook')?></a>
                <a class="btn btn-default" href="<?php echo $this->googleplus->loginURL() ?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i> <?php echo display('google')?></a>
                </div>
            <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>
<!-- Login page end -->



