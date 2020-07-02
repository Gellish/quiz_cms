<!-- Right profile and logout start -->
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown<?php if ($active == 'user_profile') echo ' active'; ?>">
	  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{email}<span class="caret"></span></a>
	  	<ul class="dropdown-menu">
	    	<li <?php if ($active == 'user_profile') echo 'class="active"'; ?>><a href="<?php echo base_url('admin/User_profile'); ?>"><?php echo display('profile_setting') ?></a></li>
			<li><a href="{logout}" ><?php echo display('logout') ?></a></li>
	  	</ul>
	</li>
</ul>
<!-- Right profile and logout end -->