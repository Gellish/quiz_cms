<!-- Home page form start -->
<div class="well" style="margin-top: 10px;">
    <div style="font-size:25px;font-weight:bold;"><?php echo display('admin_dashboard') ?></div>
</div>
<div class="row-fluid well">
    <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-user-circle" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Cstudent')?>">
                            <?php echo display('total_students')?>
                        </a>
                        </span> 
                        <span class="slight"></span></h2>
                        <div class="sparkline3 text-center">
                            <h3>{total_students}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-users" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Ctutor')?>">
                        <?php echo display('total_teachers')?>
                        </a>
                        </span> <span class="slight"></span></h2>
                        <div class="sparkline3 text-center">
                            <h3>{total_teachers}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Cquestion')?>">
                        <?php echo display('total_questions')?>
                        </a>
                        </span> <span class="slight"></span></h2>
                        <div class="sparkline3 text-center">
                            <h3>{total_questions}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Cmodel_test')?>">
                        <?php echo display('total_modeltest')?>
                        </a>
                        </span><span class="slight"></span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{total_modeltest}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Ccourse')?>">
                        <?php echo display('total_courses')?>
                        </a>
                        </span><span class="slight">
                            
                        </span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{get_all_course}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-university" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Cclass')?>">
                        <?php echo display('total_classes')?>
                        </a>
                        </span><span class="slight"></span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{get_all_class}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2> <i class="fa fa-briefcase" aria-hidden="true"></i> <span class="count-number ">
                        <a href="<?php echo base_url('admin/Coperator')?>">
                        <?php echo display('total_opetator')?>
                        </a>
                        </span><span class="slight"></span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{get_all_operator}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-book" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('admin/Cchapter')?>">
                        <?php echo display('total_chapter')?>
                        </a>
                        </span><span class="slight"> </span></h2>
                        <div class="sparkline4">
                            <h3 class="text-center">{get_all_chapter}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-language" aria-hidden="true"></i> <span class="count-number text-center">
                         <a href="<?php echo base_url('Language/change')?>">
                        <?php echo display('language')?>
                        </a>
                        </span><span class="slight"> </span></h2>
                        <div class="sparkline4">
                            <h3 class="text-center"><?php echo ucfirst($get_all_language)?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Home page form end -->

<style type="text/css">
    .panel {
        box-shadow: none;
        overflow: hidden;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .panel-body {
        padding: 15px;
    }
    .statistic-box h2 {
        margin: 0;
        font-weight: 400;
    }
</style>