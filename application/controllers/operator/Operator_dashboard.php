<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operator_dashboard extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	public function index()
	{
		$CI =& get_instance();
		if(!$this->auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'operator/Operator_dashboard/login', TRUE, 302);
		}else{
			$CI->auth->check_operator_auth();
			$data['title'] = "Operator Home";
			$content = $this->parser->parse('operator_view/operator_home',$data,true);
			$this->template->full_operator_html_view($content);
		}
	}
	public function login()
	{	
		if ($this->auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'admin/Operator_dashboard', TRUE, 302);
		}
		$data['title'] = "Operator Login Area";
        $content = $this->parser->parse('operator_view/operator_login_form',$data,true);
		$this->template->full_operator_html_view($content);
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

		if ( $username == '' || $password == '' || $this->auth->login($username, $password) === FALSE )
		{
			$error = 'Wrong user name or password';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'operator/Operator_dashboard/login', TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url().'operator/Operator_dashboard', TRUE, 302);
        }
	}
	public function logout()
	{	
		if ($this->auth->logout())
		$this->output->set_header("Location: ".base_url().'operator/Operator_dashboard/login', TRUE, 302);
	
	}
}