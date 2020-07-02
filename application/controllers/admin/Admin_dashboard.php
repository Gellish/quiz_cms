<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_dashboard extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	public function index()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Admin_homes');
		if(!$this->auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'admin/Admin_dashboard/login', TRUE, 302);
		}else{
		$CI->auth->check_admin_auth();
		$get_students = $this->Admin_homes->get_all_students();
		$get_teachers = $this->Admin_homes->get_all_teachers();
		$get_questions = $this->Admin_homes->get_all_questions();
		$get_modeltest = $this->Admin_homes->get_all_modeltest();
		$get_all_class = $this->Admin_homes->get_all_class();
		$get_all_course = $this->Admin_homes->get_all_course();
		$get_all_operator = $this->Admin_homes->get_all_operator();
		$get_all_chapter = $this->Admin_homes->get_all_chapter();
		$get_all_language = $this->Admin_homes->get_all_language();
		$data = array(
			'title' => 'Admin Home', 
			'total_students' => $get_students,
			'total_teachers' => $get_teachers,
			'total_questions' => $get_questions,
			'total_modeltest' => $get_modeltest,
			'get_all_class' => $get_all_class,
			'get_all_course' => $get_all_course,
			'get_all_operator' => $get_all_operator,
			'get_all_chapter' => $get_all_chapter,
			'get_all_language' => $get_all_language['0']['language'],
			);
		$content = $this->parser->parse('admin_view/admin_home',$data,true);
		$this->template->full_admin_html_view($content);
		}
	}
 
	//Admin Dashboard login
	public function login()
	{	
		if ($this->auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'admin/Admin_dashboard', TRUE, 302);
		}
		$data['title'] = "Admin Login Area";
        $content = $this->parser->parse('admin_view/admin_login_form',$data,true);
		$this->template->full_admin_html_view($content);
	}
	/*
	* Valid User Check...
	*/
	public function do_login()
	{	
		//$this->load->model('Users');
		$error = '';
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ( $username == '' || $password == '' || $this->auth->admin_login( $username,$password ) === FALSE )
		{
			$error = 'Wrong user name or password';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'admin/Admin_dashboard/login', TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url().'admin/Admin_dashboard', TRUE, 302);
        }
	}
	//Logout
	public function logout()
	{	
		if ($this->auth->logout())
		$this->output->set_header("Location: ".base_url().'admin/Admin_dashboard/login', TRUE, 302);
	}
}