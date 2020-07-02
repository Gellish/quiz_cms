<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo (isset($title)) ? $title :"ONLINE EXAM SYSTEM" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="../assets/ico/favicon.png">

	<!-- Google font lato css-->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Bootstrap min css -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome css -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>my-assets/css/admin_css/admin_template.css" rel="stylesheet">
    <!-- jquery-2.0.0.min.js -->
	<script src="<?php echo base_url();?>my-assets/js/admin_js/jquery-2.0.0.min.js" type="text/javascript"></script>
	<!-- Jquery form validation js -->
	<script src="<?php echo base_url(); ?>my-assets/js/admin_js/jquery.validate.js" type="text/javascript"></script>
	<!-- jquery ui js -->
	<script src="<?php echo base_url(); ?>my-assets/js/admin_js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
	<!-- jQuery ui custon js -->
    <link href="<?php echo base_url(); ?>my-assets/js/admin_js/jquery-ui-1.9.1.custom/css/smoothness/jquery-ui.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- DataTable css -->
    <link href="<?php echo base_url(); ?>my-assets/css/admin_css/dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Tiny_mce js -->
	<script type="text/javascript" src="<?php echo base_url(); ?>my-assets/com_plugin/tinymce/tinymce.min.js"></script>
   
</head>
<body>

	<!-- Mid content start here -->
	<?php $this->load->view('admin_view/include/admin_header')?>
			{msg_content}
		<div class="container">
			{sub_menu}
			{content} 
		</div>
	<?php $this->load->view('admin_view/include/admin_footer')?>
	<!-- Mid content end here -->

</body>
	<!-- Bootstrap min.js -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Custom js -->
	<script src="<?php echo base_url(); ?>my-assets/js/admin_js/custom.js" type="text/javascript"></script>
	<!-- Javascript form validation js -->
	<script src="<?php echo base_url(); ?>my-assets/js/admin_js/all_form_validation.js" type="text/javascript"></script>
	<!-- DataTable js -->
	<script src="<?php echo base_url(); ?>my-assets/js/admin_js/dataTables.min.js" type="text/javascript"></script>
</html>