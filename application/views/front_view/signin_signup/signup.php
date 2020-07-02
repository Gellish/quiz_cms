<!-- Registration form start --> 
<div class="login-wrapper">
    <div class="container-center lg">
        <div class="view-header">
            <div class="header-icon">
                <i class="page-header-icon fa fa-sign-in"></i>
            </div>
            <div class="header-title">
                <h3><?php echo display('register')?></h3>
                <small><p><?php echo display('enter_login_info')?></p></small>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <?php echo form_open_multipart('front/Signup/submit_user_registration',array('id' => 'userRegistration'))?>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="full_name"><?php echo display('full_name')?></label>
                            <input type="text" id="full_name" class="form-control" name="full_name" placeholder="<?php echo display('full_name')?>" required="">
                            <span class="help-block small"><?php echo display('unique_username')?></span>
                        </div>
                         <div class="form-group col-lg-6">
                            <label for="password"><?php echo display('password')?></label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="<?php echo display('password')?>" required="">
                            <span class="help-block small"><?php echo display('strong_password')?></span>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label for="username"><?php echo display('email')?></label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="<?php echo display('email')?>" required="">
                            <span class="help-block small"><?php echo display('unique_email')?></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="con_pass"><?php echo display('password')?></label>
                            <input type="password" id="con_pass" class="form-control" name="con_pass" placeholder="Enter repeat password" required="">
                            <span class="help-block small"><?php echo display('reset_password')?></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="mobile"><?php echo display('mobile')?></label>
                            <input type="text" id="mobile" class="form-control" name="mobile" placeholder="<?php echo display('mobile')?>" required="">
                            <span class="help-block small"><?php echo display('unique_mobile')?></span>
                        </div>
                         <div class="form-group col-lg-6">
                            <label for="image"><?php echo display('image')?></label>
                            <input type="file" id="image" class="form-control" name="image">
                            <span class="help-block small"><?php echo display('unique_image')?></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="user_type"><?php echo display('user_type')?> </label>
                            <div class="radio radio-success">
                                <input name="user_type" id="radio1" value="student" checked="" type="radio">
                                <label for="radio1"><?php echo display('student')?> </label>
                            </div>
                            <div class="radio radio-success">
                                <input name="user_type" id="radio2" value="teacher" type="radio">
                                <label for="radio2"> <?php echo display('teacher')?></label>
                            </div>
                            <input type="hidden" id="baseUrl" value="<?php echo base_url()?>" name="">
                        </div>


                    </div>
                    <a class="btn btn-primary" href="<?php echo base_url('login')?>"><?php echo display('login')?></a>
                    <button type="submit" class="btn btn-warning"><?php echo display('register')?></button>
                    <b style="color:green;margin-left: 20px;"><?php echo $this->session->userdata('message')?></b>
                <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>
<!-- Registration form end -->