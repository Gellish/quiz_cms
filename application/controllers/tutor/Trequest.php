<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trequest extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'request';
    }

	// Form for add Class Name
	public function index()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		
        $datas = array('title' => 'Request for class');			
		$content = $CI->parser->parse('tutor_view/request/request_class_form',$datas,true);
       
        $sub_menu = array(
				array('label'=> display('request_class'), 'url' => 'tutor/Trequest','class' =>'active'),
				array('label'=> display('request_course'), 'url' => 'tutor/Trequest/course_request'),
				array('label'=> display('request_chapter'), 'url' => 'tutor/Trequest/chapter_request')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	public function submit_class_request()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Request');
		
		$data=array(
			'class_id' 	=> null,
			'class_name' 	=> $this->input->post('class_name'),
			'status' 		=> 2
		);
		$CI->Request->insert_class_request($data);
		
		if(isset($_POST['request-class'])){

			$this->session->set_userdata(array('message'=>display('successfully_request_send')));

			redirect(base_url('tutor/Trequest/'));
			exit;
		}
	}
	// Form for add Class Name
	public function course_request()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltrequest');
		
        $content = $CI->ltrequest->course_request_form();
       
        $sub_menu = array(
				array('label'=> display('request_class'), 'url' => 'tutor/Trequest'),
				array('label'=> display('request_course'), 'url' => 'tutor/Trequest/course_request','class' =>'active'),
				array('label'=> display('request_chapter'), 'url' => 'tutor/Trequest/chapter_request')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	public function submit_course_request()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Request');
		
		$data=array(
			'course_id' 	=> null,
			'course_name' 	=> $this->input->post('courseName'),
			'class_id' 		=> $this->input->post('class_id'),
			'is_new' 		=> 1,
			'status' 		=> 2
		);
		$CI->Request->insert_course_request($data);
		
		if(isset($_POST['request-course'])){

			$this->session->set_userdata(array('message'=>display('successfully_request_send')));

			redirect(base_url('tutor/Trequest/course_request'));
			exit;
		}
	}
	
	public function chapter_request()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltrequest');
		
        $content = $CI->ltrequest->chapter_request_form();
       
        $sub_menu = array(
				array('label'=> display('request_class'), 'url' => 'tutor/Trequest'),
				array('label'=> display('request_course'), 'url' => 'tutor/Trequest/course_request'),
				array('label'=> display('request_chapter'), 'url' => 'tutor/Trequest/chapter_request','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	public function submit_chapter_request()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Request');
		
		$data=array(
			'chapter_id' 		=> null,
			'course_id' 		=> $this->input->post('course_id'),
			'chapter_name' 		=> $this->input->post('chapter_name'),
			'status' 			=> 2
		);
		$CI->Request->insert_chapter_request($data);
		
		if(isset($_POST['request-chapter'])){

			$this->session->set_userdata(array('message'=>display('successfully_request_send')));

			redirect(base_url('tutor/Trequest/chapter_request'));
			exit;
		}
	}

}