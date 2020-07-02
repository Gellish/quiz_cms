<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ooption extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'option';
    }
	// Retrieve Option List to view on the Admin end
	public function view_question_option($question_id)
	{
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('lqoption');
        $optionList = $CI->lqoption->option_modal_view($question_id);		
        $data = array(
				'option_detail_view' => $optionList
			);
		$CI->parser->parse('operator_view/option/question_option_view',$data);		
	}
	/*
	** Option Edit Form
	*/
	public function option_edit_form($option_id)
	{	
		$CI =& get_instance();
		$CI->load->library('lqoption');
		
        $info = $CI->lqoption->option_edit_data($option_id);
		$data = array(
				'option_edit_page' => $info,
				'title' => 'Option Edit'
			);
		$CI->parser->parse('operator_view/option/option_edit_container',$data);
	}
	/*
	** Option Update
	*/
	public function update_question_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/qoptions');
		
		$option_id = $this->input->post('option_id');
		
		$data=array(
			'question_id' 		=> $this->input->post('question_id'),
			'option_details' 	=> htmlspecialchars($this->input->post('optionDetail')),
			'language' 			=> $this->input->post('language'),
			'option_image' 		=> '',
			'status' 			=> $this->input->post('optionSts')
		);
		$CI->qoptions->update_option($option_id,$data);
		$this->session->set_userdata(array('message'=>"Successfully Updated !"));
		redirect(base_url('operator/Ooption'));
	}
	// Option Update
	public function update_question_Alloption()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/qoptions');
		$CI->qoptions->update_all_option();
		$this->session->set_userdata(array('message'=>"Successfully Updated !"));
		redirect(base_url('operator/oquestion'));
	}
	//Delate Option
	public function delete_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/qoptions');
		
		$option_id =  $_POST['option_id'];			
		$status = $CI->qoptions->option_delete($option_id);
		echo $status;
	}

}