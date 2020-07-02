<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cclass extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'class';
    }
	/*
	//* Retrieve Class List to view on the admin end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lclass');
		$CI->load->model('admin/Classes');

        $content = $CI->lclass->class_list();
        $sub_menu = array(
				array('label'=> display('manage_class'), 'url' => 'admin/Cclass', 'class' =>'active'),
				array('label'=> display('add_class'), 'url' => 'admin/Cclass/add_class_form'),
				array('label'=> display('request_class'), 'url' => 'admin/Cclass/request_class_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Form for add Class Name
	*/
	public function add_class_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lclass');
		
		$data = array( 
			'title' => 'Add class',
			'info' => ''
			);
        $content = $this->parser->parse('admin_view/class/add_class_form',$data,true);
        $sub_menu = array(
				array('label'=>  display('manage_class'), 'url' => 'admin/Cclass'),
				array('label'=>  display('add_class'), 'url' => 'admin/Cclass/add_class_form','class' =>'active'),
				array('label'=>  display('request_class'), 'url' => 'admin/Cclass/request_class_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Insert Class Name To Data Base
	*/
	public function insert_class()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lclass');
		
		$data=array(
			'class_id' 		=> null,
			'class_name' 	=> $this->input->post('className'),
			'status' 		=> 1
		);

		$CI->lclass->insert_class($data);
		$this->session->set_userdata(array('message'=> display('successfully_insert')));
		if(isset($_POST['add-class'])){
			redirect(base_url('admin/Cclass'));
			exit;
		}elseif(isset($_POST['add-class-another'])){
			redirect(base_url('admin/Cclass/add_class_form'));
			exit;
		}
	}
	/*
	** Class Edit Form
	*/
	public function class_edit_form()
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();

		$CI->load->model('admin/Classes');		
		$class_id=$this->input->post('id');
		$class_list = $CI->Classes->retrieve_class_editdata($class_id);

		foreach ($class_list as $class):endforeach;

		$form = '';

		$form .= form_open('admin/Cclass/update_class',array('id' => 'class_add'));

		$form .="<div class=\"row\">
				<div class=\"col-sm-12\">
					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('class_name').":</label>
						<div class=\"col-sm-7\">
							<input type=\"text\" name=\"className\" id=\"className\" value='".$class['class_name']."' class=\"required form-control\" required>
							<input type=\"hidden\" name=\"class_id\" id=\"class_id\" value='".$class['class_id']."' required>
						</div>
					</div>
					<div class=\"form-group row text-right\">
					<div class=\"name_field\"></div>
						<div class=\"col-sm-7\">
							<button type=\"submit\" class=\"btn btn-primary\" name=\"add-course\">".display('save_changes')."</button>
						</div>
					</div>
				</div>
			</div>";
		$form .= form_close();
		echo $form;
	}

	/*
	** Class Update
	*/
	public function update_class()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Classes');
		
		$class_id = $this->input->post('class_id');
		$data=array(
			'class_name' => $this->input->post('className'),
		);
		$CI->Classes->update_class($class_id,$data);
		$this->session->set_userdata(array('message'=> display('successfully_update')));
		redirect(base_url('admin/Cclass'));
	}
	//Delate Class
	public function change_className_status()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Classes');
		
		$class_id =  $_POST['class_id'];	
		$status = $CI->Classes->change_className_status($class_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}

	public function request_class_list()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lclass');
		$CI->load->model('admin/Classes');

		
        $content = $CI->lclass->requested_class_list();
        $sub_menu = array(
				array('label'=> display('manage_class'), 'url' => 'admin/Cclass'),
				array('label'=> display('add_class'), 'url' => 'admin/Cclass/add_class_form'),
				array('label'=> display('request_class'), 'url' => 'admin/Cclass/request_class_list','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	public function approve_teacher_requested_class()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Classes');
		
		$class_id =  $_POST['class_id'];	
		$status = $CI->Classes->approve_requested_class($class_id);
		$this->session->set_userdata(array('message'=>display('successfully_approved_requested_class')));

		echo $status;
	}
	
	public function deny_teacher_requested_class()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Classes');
		
		$class_id =  $_POST['class_id'];	
		$status = $CI->Classes->delete_requested_class($class_id);
		$this->session->set_userdata(array('message'=>display('successfully_deleted_requested_class')));
		echo $status;
	}
}