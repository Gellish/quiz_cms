<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ochapter extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'chapter';
    }

	//Retrieve Class List to view on the operator end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('lochapter');
		$CI->load->model('operator/Chapters');

        $content = $CI->lochapter->chapter_list();
        $sub_menu = array(
				array('label'=> display('manage_chapter'), 'url' => 'operator/Ochapter', 'class' =>'active'),
				array('label'=>  display('add_chapter'), 'url' => 'operator/Ochapter/add_chapter_form')
			);
		$this->template->full_operator_html_view($content,$sub_menu);
	}

	//Form for add Class Name
	public function add_chapter_form()
	{	 
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('lochapter');
		
        $content = $CI->lochapter->chapter_add_form();
       
        $sub_menu = array(
				array('label'=>  display('manage_chapter'), 'url' => 'operator/Ochapter'),
				array('label'=>  display('add_chapter'), 'url' => 'operator/Ochapter/add_chapter_form','class' =>'active')
			);
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	//Insert chapter
	public function insert_chapter()
	{	   
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('lochapter');
		
		$data=array(
			'chapter_id' 	=> null,
			'course_id' 	=> $this->input->post('course_id'),
			'chapter_name' 	=>  strip_tags($this->input->post('chapterName',true)),
			'status' 		=> 1
		);
		$CI->lochapter->insert_chapter($data);
		$CI->session->set_userdata(array('message'=>display('successfully_insert')));
		if(isset($_POST['add-chapter'])){
			redirect('operator/Ochapter/');
			exit;
		}elseif(isset($_POST['add-chapter-another'])){
			redirect('operator/Ochapter/add_chapter_form');
			exit;
		}
	}

	//Chapter Edit Form
	public function chapter_edit_form($chapter_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('lochapter');
		
        $content = $CI->lochapter->chapter_edit_data($chapter_id);
		$sub_menu = array(
				array('label'=>  display('manage_chapter'), 'url' => 'operator/Ochapter'),
				array('label'=>  display('add_chapter'), 'url' => 'operator/Ochapter/add_chapter_form'),
				array('label'=>  display('edit_chapter'), 'url' => 'operator/Ccourse/','class' =>'active')
			);
			
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	
	// Chapter Update
	public function update_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Chapters');
		
		$chapter_id = $this->input->post('chapter_id');
		$data=array(
			'course_id' => $this->input->post('course_id'),
			'chapter_name' => $this->input->post('chapterName'),
			'status' => $this->input->post('chapterSts')
		);
		$CI->Chapters->update_chapter($chapter_id,$data);
		$CI->session->set_userdata(array('message'=>display('successfully_update')));
		redirect(base_url('operator/Ochapter'));
	}
	//Delate Chapter
	public function change_chapterName_status()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Chapters');
		
		$chapter_id =  $_POST['chapter_id'];	
		$status = $CI->Chapters->change_chapterName_status($chapter_id);
		echo $status;
	}
}