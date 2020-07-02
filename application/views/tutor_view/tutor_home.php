<!-- Home page form start -->
<div class="well" style="margin-top: 10px;">
    <div style="font-size:25px;font-weight:bold;"><?php echo display('tutor_dashboard') ?></div>
</div>
<div class="row-fluid well">
    <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-user-circle" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('tutor/Tstudent')?>">
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
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('tutor/Tquestion')?>">
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
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('tutor/Tbatch')?>">
                        <?php echo display('total_batch')?>
                        </a>
                        </span><span class="slight"></span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{total_batch}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="statistic-box text-center">
                        <h2><i class="fa fa-university" aria-hidden="true"></i> <span class="count-number">
                        <a href="<?php echo base_url('tutor/Texam')?>">
                        <?php echo display('total_exam')?>
                        </a>
                        </span><span class="slight"></span></h2>
                        <div class="sparkline4 text-center">
                            <h3>{total_exams}</h3>
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
        font-weight: 200px;
        font-size:25px; 
    }
</style>