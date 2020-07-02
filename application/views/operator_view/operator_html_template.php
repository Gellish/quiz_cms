<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo (isset($title)) ? $title :"GEFEDU" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">

    <!-- Bootstrap min css -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome css -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Admin template css -->
    <link href="<?php echo base_url(); ?>my-assets/css/admin_css/admin_template.css" media="screen" rel="stylesheet" type="text/css" />
      <!-- jquery-2.0.0.min.js -->
    <script src="<?php echo base_url();?>my-assets/js/admin_js/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- DataTable css -->
    <link href="<?php echo base_url(); ?>my-assets/css/admin_css/dataTables.min.css" rel="stylesheet" type="text/css" />
	
</head>
<body>

    <!-- Mid content customize start -->
    <?php $this->load->view('operator_view/include/operator_header')?>
            {msg_content}
        <div class="container">
            {sub_menu}
            {content} 
        </div>
    <?php $this->load->view('operator_view/include/operator_footer')?>
    <!-- Mid content customize end -->

</body>

    <!-- Bootstrap min.js -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Jquery form validation js -->
    <script src="<?php echo base_url(); ?>my-assets/js/admin_js/jquery.validate.js" type="text/javascript"></script>
    <!-- DataTable js -->
    <script src="<?php echo base_url(); ?>my-assets/js/admin_js/dataTables.min.js" type="text/javascript"></script>
    <!-- Javascript form validation js -->
    <script src="<?php echo base_url(); ?>my-assets/js/tutor_js/all_form_validation.js" type="text/javascript"></script>
    <!-- Tinymsce editor js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>my-assets/com_plugin/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
    //DataTable Js
        $("#dataTableExample2").DataTable({ dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], buttons: [ {extend: 'copy', className: 'btn-sm'}, {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, {extend: 'print', className: 'btn-sm'} ] });

    //Text Editor
    tinymce.init({
        selector: '.mytextarea'
    });
    
    </script>

    
</html>