<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	function __construct() {
      parent::__construct();
    }
    //Dashboard 
	public function index()
	{
		$CI =& get_instance();
		$CI->load->library('front_lib/ldashboard');		
		$content = $CI->ldashboard->get_home_data();	
		$this->template->full_html_view($content);
	}
	//User Sehedule Exam
	public function user_schedule_exam()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/ldashboard');
		$content = $CI->ldashboard->get_schedule_exam();		
		$this->template->full_html_view($content);
	}
	// User exam statutistics
	public function user_exam_statistics()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/ldashboard');
		
		$content = $CI->ldashboard->get_schedule_exam();		
		$this->template->full_html_view($content);
	}
	//Logout
	public function logout()
	{	
		if ($this->auth->logout()){
			$this->output->set_header("Location: ".base_url(), TRUE, 302);
		}
	}
}