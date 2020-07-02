<!-- Admin header start -->
<div class="navbar navbar-inverse">
  	<div class="navbar-inner">
		<div class="container">
		  	<div class="navbar-header">
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			    </button>
		       	<a class="navbar-brand" href="<?php echo base_url('operator/Operator_dashboard'); ?>">{company_info}{company_name}{/company_info}</a>
	    	</div>
	  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				{mainmenu}
				{logindata}
	  		</div><!--/.nav-collapse -->
		</div>
  	</div>
</div>
<!-- Admin header end -->
