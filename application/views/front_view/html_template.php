<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <?php
        $CI =& get_instance();
        $CI->load->model('front/Common_exams');
        $favicon = $CI->Common_exams->get_favicon();
        $fav_image=$favicon[0]['favicon'];
        ?>
        <link rel="shortcut icon" href="<?php echo (isset($fav_image)) ? $fav_image :"ONLINE EXAM SYSTEM" ?>">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo (isset($title)) ? $title :"ONLINE EXAM SYSTEM" ?></title>
        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i" rel="stylesheet"> 
        <!-- Bootstrap css -->
        <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- font awesome css -->
        <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Important Owl stylesheet -->
        <link href="<?php echo base_url()?>assets/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <!-- Default Theme -->
        <link href="<?php echo base_url()?>assets/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <!-- Owl Transitions  -->
        <link href="<?php echo base_url()?>assets/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css"/>
        <!-- Style css -->
        <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->
        <script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
        <!-- jquary validate js -->
        <script src="<?php echo base_url(); ?>my-assets/js/admin_js/jquery.validate.js" type="text/javascript"></script>
        <!-- all form validate js -->
        <script src="<?php echo base_url(); ?>my-assets/js/frontview_js/all_form_validation.js" type="text/javascript"></script>
        <!-- Custom js -->
        <script src="<?php echo base_url(); ?>my-assets/js/frontview_js/custom.js" type="text/javascript"></script>
        <!-- Exam Timer js -->
        <script src="<?php echo base_url(); ?>my-assets/js/frontview_js/exam_timer.js" type="text/javascript"></script>
    </head>
    <body>
        <?php if ($this->uri->segment('1') == 'home') { ?>
            <div class="se-pre-con"></div>
        <?php } ?>

        <!-- Mid Content start -->
        <?php 
            $url=$this->uri->segment(1); 
            if ($url != "login" && $url != "signup"){
            $this->load->view('front_view/include/header');
        }?>
            {message}
            {content}
        <?php
        if ($url != "login" && $url != "signup" ) {
            $this->load->view('front_view/include/footer');
        }?>
        <!-- Mid Content end -->

        <script>
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");
            });
        </script>

        <!-- owl carousel js -->
        <script src="<?php echo base_url()?>assets/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
        <!-- cutom js -->
        <script src="<?php echo base_url()?>assets/js/custom.js" type="text/javascript"></script>
    </body>
</html>