<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tutor_dashboard extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	public function index()
	{
		$CI =& get_instance();
		if(!$this->auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'tutor/Tutor_dashboard/login', TRUE, 302);
		}else{
			$CI->auth->check_tutor_auth();
			$CI->load->model('tutor/Students');
			$CI->load->model('tutor/Questions');
			$CI->load->model('tutor/Batches');
			$CI->load->model('tutor/Exams');
			$total_students = $this->Students->count_student_list();
			$total_questions = $this->Questions->count_question_list();
			$total_batch = $this->Batches->total_batch_count();
			$total_exams = $this->Exams->count_total_exams_items($this->session->userdata('user_id'));
			
			$data = array(
				'title' => 'Teacher Home', 
				'total_students' => $total_students, 
				'total_questions' => $total_questions, 
				'total_batch' => $total_batch, 
				'total_exams' => $total_exams, 
				);
			$content = $this->parser->parse('tutor_view/tutor_home',$data,true);
			$this->template->full_tutor_html_view($content);
		}
	}
	public function login()
	{	
		if ($this->auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'tutor/Tutor_dashboard', TRUE, 302);
		}
		$data['title'] = " Teacher Login Area";
        $content = $this->parser->parse('tutor_view/tutor_login_form',$data,true);
		$this->template->full_tutor_html_view($content);
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
			$this->output->set_header("Location: ".base_url().'tutor/Tutor_dashboard/login', TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url().'tutor/Tutor_dashboard', TRUE, 302);
        }
	}
	public function logout()
	{	
		if ($this->auth->logout())
		$this->output->set_header("Location: ".base_url().'tutor/Tutor_dashboard/login', TRUE, 302);
	
	}
}