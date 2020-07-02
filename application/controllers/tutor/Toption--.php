<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Toption extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'option';
    }
	// Retrieve Option List to view on the tutor end
	public function view_question_option($question_id)
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltoption');
        $optionList = $CI->ltoption->option_modal_view($question_id);
		
        $data = array(
				'quize_detail_view' => $optionList
			);
		$CI->parser->parse('tutor_view/option/question_option_view',$data);		
	}
	// Option Update at a time
	public function update_question_Alloption()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/qoptions');
		$CI->qoptions->update_all_option();
		$this->session->set_userdata(array('message'=>"Successfully Updated !"));
		redirect(base_url('tutor/tquestion'));
	}
	//Delate Option
	public function delete_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/qoptions');
		
		$option_id =  $_POST['option_id'];			
		$status = $CI->qoptions->option_delete($option_id);
		echo $status;
	}

}