<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cchapter extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'chapter';
    }
	/*
	//* Retrieve Class List to view on the admin end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lchapter');
		$CI->load->model('admin/Chapters');
	
        $content = $CI->lchapter->chapter_list();
        $sub_menu = array(
				array('label'=> display('manage_chapter'), 'url' => 'admin/Cchapter', 'class' =>'active'),
				array('label'=> display('add_chapter'), 'url' => 'admin/Cchapter/add_chapter_form'),
				array('label'=> display('requested_chapter'), 'url' => 'admin/Cchapter/requested_chapter_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Form for add Class Name
	*/
	public function add_chapter_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lchapter');
		
        $content = $CI->lchapter->chapter_add_form();
       
         $sub_menu = array(
				array('label'=> display('manage_chapter'), 'url' => 'admin/Cchapter'),
				array('label'=> display('add_chapter'), 'url' => 'admin/Cchapter/add_chapter_form', 'class' =>'active'),
				array('label'=> display('requested_chapter'), 'url' => 'admin/Cchapter/requested_chapter_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Rtrieve course
	*/
	public function retrieve_course()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Chapters');
		
		$class_id =  $_POST['class_id'];	
		$course = $CI->Chapters->retrieve_course($class_id);		
		echo"<option value=''>".display('select_course')."</option>";
		foreach($course as $row)
		{		
		echo "<option value='$row->course_id'set_select('course_id', '$row->course_id') >$row->course_name</option>";
		}
	}
	/*
	//* Insert Course Name To Data Base
	*/
	public function insert_Cchapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lchapter');

		$chapter_file1= "";
		if ($_FILES['image']['name']) {
			//Chapter chapter add start
			$config['upload_path']          = './my-assets/images/chapter_image/';
	        $config['allowed_types']        = '*';
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	            redirect(base_url('admin/Cchapter/add_chapter_form'));
	        }
	        else
	        {
	        	$image =$this->upload->data();
	        	$image_url = base_url()."my-assets/images/chapter_image/".$image['file_name'];
	        }
		}

        //Chapter file add
        if ($_FILES['chapter_file']['name']) {
        	$config['upload_path']          = './my-assets/images/chapter_image/';
	        $config['allowed_types']        = '*';
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
     
	        if ( ! $this->upload->do_upload('chapter_file'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array(display('message')=> 'Image Not Uploaded!'));
	            redirect(base_url('admin/Cchapter/add_chapter_form'));
	        }
	        else
	        {
	        	$chapter_file =$this->upload->data();
	        	$chapter_file1 = base_url()."my-assets/images/chapter_image/".$chapter_file['file_name'];
	        }
        }

        $data=array(
			'chapter_id' 	=> null,
			'course_id' 	=> $this->input->post('course_id'),
			'chapter_name' 	=>  strip_tags($this->input->post('chapterName')),
			'image' 		=> (!empty($image_url)?$image_url:base_url('my-assets/images/course.png')),
			'chapter_file' 	=> $chapter_file1,
			'youtube_url' 	=> $this->input->post('youtube_url'),
			'status' 		=> 1 
		);

		$CI->lchapter->insert_chapter($data);
		$this->session->set_userdata(array('message'=> display('successfully_insert')));
		if(isset($_POST['add-chapter'])){
			redirect(base_url('admin/Cchapter'));
			exit;
		}elseif(isset($_POST['add-chapter-another'])){
			redirect(base_url('admin/Cchapter/add_chapter_form'));
			exit;
		}
        //Chapter chapter add end
	}
	/*
	** Chapter Edit Form
	*/
	public function chapter_edit_form($chapter_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lchapter');
		
        $content = $CI->lchapter->chapter_edit_data($chapter_id);
		$sub_menu = array(
				array('label'=> display('manage_chapter'), 'url' => 'admin/Cchapter'),
				array('label'=> display('add_chapter'), 'url' => 'admin/Cchapter/add_chapter_form'),
				array('label'=> display('edit_chapter'), 'url' => 'admin/Cchapter','class' =>'active'),
				array('label'=> display('requested_chapter'), 'url' => 'admin/Cchapter/requested_chapter_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	** Class Update
	*/
	public function update_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Chapters');
		
		$chapter_file_old=$this->input->post('chapter_file_old');
	   	$old_image=$this->input->post('old_image');

		if ($_FILES['image']['name'] ) {
			//Chapter image update start
			$config['upload_path']          = './my-assets/images/chapter_image/';
	        $config['allowed_types']        = "*";
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	            redirect(base_url('admin/Cchapter'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {
	            	$image_url =  base_url()."my-assets/images/chapter_image/".$image['file_name'];
	            }
	        }
		}

        //Chapter file add
        if ($_FILES['chapter_file']['name']) {

        	$config['upload_path']          = './my-assets/images/chapter_image/';
	        $config['allowed_types']        = "*";
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);


	        if ( ! $this->upload->do_upload('chapter_file'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array(display('message')=> 'Image Not Uploaded!'));
	            redirect(base_url('admin/Cchapter/add_chapter_form'));
	        }
	        else
	        {
	        	if ($chapter_file =$this->upload->data()) {
	            	$chapter_file_url=base_url()."my-assets/images/chapter_image/".$chapter_file['file_name'];
	            }
	        }
        }
      
        $chapter_id = $this->input->post('chapter_id');
		$data=array(
			'course_id' => $this->input->post('course_id'),
			'chapter_name' => $this->input->post('chapterName'),
			'image' 	=>(!empty($image_url)?$image_url:$old_image),
			'chapter_file' 	=> (!empty($chapter_file_url)?$chapter_file_url:$chapter_file_old),
			'youtube_url' 	=> $this->input->post('youtube_url'),
		);
		$result=$CI->Chapters->update_chapter($chapter_id,$data);
		$this->session->set_userdata(array('message'=> display('successfully_update')));
		redirect(base_url('admin/Cchapter'));
	    //Chapter image update end
	}
	//Delate Chapter
	public function change_chapterName_status()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Chapters');
		
		$chapter_id =  $_POST['chapter_id'];	
		$status = $CI->Chapters->change_chapterName_status($chapter_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
	public function requested_chapter_list()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lchapter');
	
        $content = $CI->lchapter->get_requested_chapter_view();
        $sub_menu = array(
				array('label'=> display('manage_chapter'), 'url' => 'admin/Cchapter'),
				array('label'=> display('add_chapter'), 'url' => 'admin/Cchapter/add_chapter_form'),
				array('label'=> display('requested_chapter'), 'url' => 'admin/Cchapter/requested_chapter_list','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
		
	public function approve_teacher_requested_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Chapters');
		
		$chapter_id =  $_POST['chapter_id'];	
		$status = $CI->Chapters->approve_requested_chapter($chapter_id);

		$this->session->set_userdata(array('message'=>display('successfully_approved_requested_chapter')));
		echo $status;
	}
	
	public function deny_teacher_requested_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Chapters');
		
		$chapter_id =  $_POST['chapter_id'];	
		$status = $CI->Chapters->delete_requested_chapter($chapter_id);
		$this->session->set_userdata(array('message'=>display('successfully_deleted_requested_chapter')));
		echo $status;
	}
}