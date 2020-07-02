<!-- User Logged in info  start-->
<?php
$active=$this->uri->segment(1);
?>
<ul class="nav navbar-nav  navbar-right">
	 	<li class="<?php if ($active == "home") {echo "active";}?>"><a href="<?php echo base_url('home')?>"><?php echo display('home')?></a></li>
        <li class="<?php if ($active == "course") {echo "active";}?>"><a href="<?php echo base_url('course')?>"><?php echo display('start_exam')?></a></li>
        <li class="<?php if ($active == "model_test") {echo "active";}?>"><a href="<?php echo base_url('model_test')?>"><?php echo display('start_model_test')?></a></li>
		<li class="dropdown <?php if ($active == "personal_exam_statistics" || $active == "model_test_statistics" || $active == "schedule_exam_statistics" || $active == "profile") {echo "active";}?>">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp; <span><?php echo display('setting');?> </span><b class="caret"></b></a>
		<ul class="dropdown-menu" >
			<li class="<?php if ($active == "personal_exam_statistics") {echo "active";}?>"><a href="<?php echo base_url('personal_exam_statistics')?>" ><?php echo display('personal_exam');?> </a></li>
			<li class="<?php if ($active == "model_test_statistics") {echo "active";}?>"><a href="<?php echo base_url('model_test_statistics') ?>" ><?php echo display('model_tests');?> </a></li>
			<li class="<?php if ($active == "schedule_exam_statistics") {echo "active";}?>"><a href="<?php echo base_url('schedule_exam_statistics')?>" ><?php echo display('assigned_exam');?> </a></li>
			<li class="<?php if ($active == "profile") {echo "active";}?>"><a href="<?php echo base_url('profile'); ?>"><?php echo display('profile_settings');?></a></li>
			<li><a href="{logout_link}" ><?php echo display('logout');?></a></li>
		</ul>
	</li>
	<li class="<?php if ($active == "exam_schedule") {echo "active";}?>"><a href="<?php echo base_url('exam_schedule')?>" ><?php echo display('exam_schedule');?><span class="scheNotfication"> {total_exam_notify} </span></a></li>
</ul>
<!-- User Logged in info  end-->