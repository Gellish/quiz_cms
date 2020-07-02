<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmodel_test extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'model_test';
    }
	
	// Retrieve Class List to view on the admin end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lmodel_test');
		$CI->load->model('admin/Model_tests');
	
        $content = $CI->lmodel_test->model_test_list();
        $sub_menu = array(
				array('label'=> display('manage_model_test'), 'url' => 'admin/Cmodel_test', 'class' =>'active'),
				array('label'=> display('add_model_test'), 'url' => 'admin/Cmodel_test/add_model_test_form'),
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
	//Add model test form
	public function add_model_test_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lmodel_test');
		
        $content = $CI->lmodel_test->model_test_add_form();
       
        $sub_menu = array(
				array('label'=> display('manage_model_test'), 'url' => 'admin/Cmodel_test'),
				array('label'=> display('add_model_test'), 'url' => 'admin/Cmodel_test/add_model_test_form','class' =>'active'),
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//
	public function retrieve_subject_name()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Model_tests');
		
		$image_file = "";
		$class_id =  $_POST['class_id'];	
		$course = $CI->Model_tests->retrieve_course($class_id);	
		// echo "<pre>";
		// print_r($course);
		// exit();

		if(!empty($course)){
			echo"<table class='table table-striped table-condensed table-bordered'>".
				"<thead><tr><th class=\"text-center\">".display('course')."</th><th class=\"text-center\">".display('no_of_question')."</th></tr></thead><tbody>";
			
			foreach($course as $row)
			{	
				echo"<tr>".
						"<td><input type='hidden' name='course_id[]' value='$row->course_id' id='no_of_ques' />".$row->course_name."</td>".
						"<td><input type='number' name='no_of_ques[]' max='$row->total_question' min='0' id='no_of_ques' class='form-control' value='$row->total_question'/></td>".
					"</tr>";
			}			
			echo "</tbody></table>";
		}
	}
	//Entry to db
	public function insert_model_test()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lmodel_test');
		
		$subject_id =  $this->input->post('course_id');
		$no_of_ques =  $this->input->post('no_of_ques');

		for ($i=0, $n=count($subject_id); $i < $n; $i++) 
		{
			$subjects = $subject_id[$i];
			$number_ques = $no_of_ques[$i];
				
			if($number_ques != ''){
				$set_array[] = array('subject_id'=>$subjects,'no_of_ques' => $number_ques);
			}
		}

		if ($_FILES['image']['name']) {
			//Chapter chapter add start
			$config['upload_path']          = 'my-assets/images/test_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['max_size']             = '0';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	            redirect(base_url('admin/Cmodel_test'));
	        }
	        else
	        {
	            $image = $this->upload->data();
	            $image_file = base_url().$config['upload_path'].$image['file_name'];
			}
		}
		$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";
		$data=array(
			'model_test_id' 		=> null,
			'model_test_name' 		=> $this->input->post('model_test_name'),
			'model_test_details' 	=> json_encode($set_array,true),
			'class_id' 				=> $this->input->post('class_id'),
			'duration' 				=> $duration,
			'test_details' 			=> strip_tags($this->input->post('test_details'),'<p><a>'),
			'image' 				=> (!empty($image_file)?$image_file:base_url('my-assets/images/course.png')),
			'status' 				=> 1
		);
		$CI->lmodel_test->insert_model_test($data);

		$this->session->set_userdata(array('message'=> display('successfully_insert')));

		redirect(base_url('admin/Cmodel_test'));
		//Chapter chapter add end
	}

	// model_test Edit For
	public function model_test_edit_form($model_test_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lmodel_test');
		if($model_test_id ==""){
			$this->session->set_userdata(array('warning_message'=>"Please select a model test to edit"));
			redirect(base_url('admin/Cmodel_test'));
		}
		
        $content = $CI->lmodel_test->model_test_edit_data($model_test_id);
		$sub_menu = array(
				array('label'=> display('manage_model_test'), 'url' => 'admin/Cmodel_test'),
				array('label'=> display('add_model_test'), 'url' => 'admin/Cmodel_test/add_model_test_form'),
				array('label'=> display('edit_model_test'), 'url' => 'admin/Cmodel_test/cmodel_test','class' =>'active'),
			);
			
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	// Update Model test
	public function update_model_test()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Model_tests');

		//Model test image update start
		if ($_FILES['image']['name']) {
			$config['upload_path']          = 'my-assets/images/test_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['max_size']             = 1024;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 1024;
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	           	redirect(base_url('admin/Cmodel_test'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {

	            	$old_image=$this->input->post('old_image');

					$model_test_id = $this->input->post('model_test_id');	
					$subject_id =  $this->input->post('course_id');
					$no_of_ques =  $this->input->post('no_of_ques');
					$status =  $this->input->post('status');

					for ($i=0, $n=count($subject_id); $i < $n; $i++) 
					{
						$subjects = $subject_id[$i];
						$number_ques = $no_of_ques[$i];
							
						if($number_ques != ''){
							$set_array[] = array('subject_id'=>$subjects,'no_of_ques' => $number_ques);
						}
					}
					
					$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";
					
					$data=array(
						'model_test_name' 		=> $this->input->post('model_test_name'),
						'model_test_details' 	=> json_encode($set_array,true),
						'class_id' 				=> $this->input->post('class_id'),
						'test_details' 			=> strip_tags($this->input->post('test_details'),'<p><a>'),
						'duration' 				=> $duration,
						'image' 	=> base_url()."my-assets/images/test_image/".$image['file_name'],
						'status' 				=> 1
					);
					$CI->Model_tests->update_model_test($model_test_id,$data);
					$this->session->set_userdata(array('message'=> display('successfully_update')));
					redirect(base_url('admin/Cmodel_test'));
	            }
	        }
		}else{
			$model_test_id = $this->input->post('model_test_id');	
			$subject_id =  $this->input->post('course_id');
			$no_of_ques =  $this->input->post('no_of_ques');
			$status =  $this->input->post('status');

			for ($i=0, $n=count($subject_id); $i < $n; $i++) 
			{
				$subjects = $subject_id[$i];
				$number_ques = $no_of_ques[$i];
					
				if($number_ques != ''){
					$set_array[] = array('subject_id'=>$subjects,'no_of_ques' => $number_ques);
				}
			}
			
			$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";
			
			$data=array(
				'model_test_name' 		=> $this->input->post('model_test_name'),
				'model_test_details' 	=> json_encode($set_array,true),
				'class_id' 				=> $this->input->post('class_id'),
				'test_details' 			=> strip_tags($this->input->post('test_details'),'<p><a>'),
				'duration' 				=> $duration,
				'status' 				=> 1
			);
			$CI->Model_tests->update_model_test($model_test_id,$data);
			$this->session->set_userdata(array('message'=> display('successfully_update')));
			redirect(base_url('admin/Cmodel_test'));
		}	
	    //Model test image update end
	}
	//Delate model_test
	public function delete_model_test()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Model_tests');
		
		$model_test_id =  $_POST['model_test_id'];	
		$status = $CI->Model_tests->do_delete_model_test($model_test_id);
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
		echo $status;
	}

}