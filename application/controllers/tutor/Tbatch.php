<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Tbatch extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'batch';
    }
	// Retrieve batch List to view on the tutor end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltbatch');
	
        $content = $CI->ltbatch->batch_list();	
        $sub_menu = array(
				array('label'=> display('manage_batch'), 'url' => 'tutor/Tbatch','class' =>'active'),
				array('label'=> display('add_batch'), 'url' => 'tutor/Tbatch/add_batch_form')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	//Form for add Batch Name
	public function add_batch_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltbatch');
		
		$data = array( 
			'title' => 'Add Batch',
			'info' => '',
			);
        $content = $this->parser->parse('tutor_view/batch/add_batch_form',$data,true);
        $sub_menu = array(
				array('label'=> display('manage_batch'), 'url' => 'tutor/Tbatch'),
				array('label'=> display('add_batch'), 'url' => 'tutor/Tbatch/add_batch_form','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Insert Batch Name To Data Base
	public function insert_batch()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltbatch');
		$tutor_id = $CI->session->userdata('user_id');
		
		$data=array(
			'batch_id' 		=> null,
			'tutor_id' 		=> $tutor_id,
			'batch_name' 	=> $this->input->post('batchName'),
			'status' 		=> 1
		);
		$CI->ltbatch->insert_batch($data);
		$this->session->set_userdata(array('message'=> display('successfully_insert')));
		if(isset($_POST['add-batch'])){
			redirect(base_url('tutor/Tbatch'));
			exit;
		}elseif(isset($_POST['add-batch-another'])){
			redirect(base_url('tutor/Tbatch/add_batch_form'));
			exit;
		}
	}
	// Batch Edit Form
	public function batch_edit_form($batch_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltbatch');
		
        $content = $CI->ltbatch->batch_edit_data($batch_id);
		$sub_menu = array(
				array('label'=> display('manage_batch'), 'url' => 'tutor/Tbatch'),
				array('label'=> display('add_batch'), 'url' => 'tutor/Tbatch/add_batch_form'),
				array('label'=> display('edit_batch'), 'url' => 'tutor/Tbatch/add_batch_form','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Batch Update
	public function update_batch()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Batches');
		
		$batch_id = $this->input->post('batchId');
		$data=array(
			'batch_name' => $this->input->post('batchName')
		);
		$CI->Batches->update_batch($batch_id,$data);

		$this->session->set_userdata(array('message'=> display('successfully_update')));

		redirect(base_url('tutor/Tbatch'));
	}
	//Delate batch
	public function delete_batchName()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Batches');
		
		$batch_id =  $_POST['batch_id'];	
		$status = $CI->Batches->delete_batch_name($batch_id);
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
		return true;
	}
}