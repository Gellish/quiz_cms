<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Tstudent extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'student';
    }
	// Retrieve student List to view on the tutor end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltstudent');
		$CI->load->model('tutor/Students');

        $content = $CI->ltstudent->student_list();	
        $sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'tutor/Tstudent','class' =>'active'),
				array('label'=> display('add_student'), 'url' => 'tutor/Tstudent/add_student_form')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	//Form for add student Name
	public function add_student_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltstudent');
        $content = $CI->ltstudent->retrieve_batch_list();
        $sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'tutor/Tstudent'),
				array('label'=> display('add_student'), 'url' => 'tutor/Tstudent/add_student_form','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Insert student Name To Data Base
	public function add_student()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Students');
		
		$tutor_id = $CI->session->userdata('user_id');
		$std_email = $this->input->post('student_email');
		$batch_id = $this->input->post('batch_id');
		$result = $CI->Students->student_email_check($std_email);
		if (count($result) == 1)
		{	
			$student_id = $result[0]['user_id'];
			$exist_check = $CI->Students->studenid_check_forThis_batch($batch_id,$student_id);
			if ($exist_check == 1)
			{
				$CI->Students->insert_emailid_inbatch($batch_id,$student_id);

				$this->session->set_userdata(array('message'=>display('successfully_insert')));

				redirect(base_url('tutor/Tstudent'));
				exit;
			}else{
				$this->session->set_userdata(array('error_message'=>display('already_exists_this_batch')));
				redirect(base_url('tutor/Tstudent/add_student_form'));
				exit;
			}

		}else{
			$this->session->set_userdata(array('error_message'=>display('no_student_registered_by_this_id')));
			redirect(base_url('tutor/Tstudent/add_student_form'));
			exit;
		}
	}
	//Student Search By Batch
	public function student_search_by_batch()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltstudent');
        $batch_id = $this->input->post('batch_id');
		
        $content = $CI->ltstudent->student_search_by_batch($batch_id);	
        $sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'tutor/Tstudent','class' =>'active'),
				array('label'=>display('add_student'), 'url' => 'tutor/Tstudent/add_student_form')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	//Delate student
	public function delete_student_name()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Students');		
		$ids =  $_POST['student_id'];
		list($batch_id,$student_id) = explode("-",$ids);
		$CI->Students->delete_student_name($batch_id,$student_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
	}
}