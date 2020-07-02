<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cstudent extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'student';
    }
    //Manage student page load
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lstudent');
	
        $content = $CI->lstudent->student_list();
        $sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'admin/Cstudent', 'class' =>'active'),
				array('label'=> display('add_student'), 'url' => 'admin/Cstudent/add_student')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Add Student Form
	public function add_student()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lstudent');
        $content = $this->lstudent->add_student_form();
        $sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'admin/Cstudent'),
				array('label'=> display('add_student'), 'url' => 'admin/Cstudent/add_student', 'class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	//Insert Student To database
	public function insert_student()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lstudent');
		
		$user_id =$this->generator($length=20);
		//Student add start
		$config['upload_path']          = './my-assets/images/student_image/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['encrypt_name'] 		= TRUE;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
            redirect(base_url('admin/Cstudent'));
        }
        else
        {
            if ($image =$this->upload->data()) {
           
				$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";

				$data1=array(
					'user_id' 		=> $user_id,
					'user_name' 	=> $this->input->post('user_name'),
					'mobile_no' 	=> $this->input->post('mobile_no'),
					'image' 	=> base_url().$config['upload_path'].$image['file_name'],
					'others' 		=> ''
				);

				$data2=array(
					'user_id' 		=> $user_id,
					'email' 	    => $this->input->post('email'),
					'password' 		=> md5('gef_quize'.$this->input->post('password')),
					'user_type' 	    => 'student',
					'redirect_url' 	    => null,
					'status' 		=> 1
				);
				
				$CI->lstudent->insert_student($data1,$data2);
				$this->session->set_userdata(array('message'=> display('successfully_insert')));
				if(isset($_POST['add-operator'])){
					redirect(base_url('admin/Cstudent'));
				}
			}
		}
		//Student add end
	}

	//Student Edit Form
	public function student_edit_form($student_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lstudent');
		
        $content = $CI->lstudent->student_edit_data($student_id);
		$sub_menu = array(
				array('label'=> display('manage_student'), 'url' => 'admin/Cstudent'),
				array('label'=> display('edit_student'), 'url' => 'admin/Cstudent','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update student
	public function update_student()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Student');
		

		//Model test image update start
		if ($_FILES['image']) {
			$config['upload_path']          = './my-assets/images/student_image/';
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
	           redirect(base_url('admin/Cstudent'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {

					$user_id = $this->input->post('user_id');

					$data1=array(
						'user_name' 	=> $this->input->post('user_name'),
						'mobile_no' 	=> $this->input->post('mobile_no'),
						'image' 	=> base_url()."my-assets/images/student_image/".$image['file_name'],
					);

					$password = $this->input->post('password');
					if($password !=''){
						$data2=array(
							'email' 	    => $this->input->post('email'),
							'password' 		=> md5('gef_quize'.$this->input->post('password'))
						);
					}else{
						$data2=array();
					}
				
					$CI->Student->update_student($user_id,$data1,$data2);
					$this->session->set_userdata(array('message'=> display('successfully_update')));
					redirect(base_url('admin/Cstudent'));
	            }
	        }
		}else{
			$user_id = $this->input->post('user_id');

			$data1=array(
				'user_name' 	=> $this->input->post('user_name'),
				'mobile_no' 	=> $this->input->post('mobile_no')
			);

			$password = $this->input->post('password');
			if($password !=''){
				$data2=array(
					'email' 	    => $this->input->post('email'),
					'password' 		=> md5('gef_quize'.$this->input->post('password'))
				);
			}else{
				$data2=array();
			}
		
			$CI->Student->update_student($user_id,$data1,$data2);
			$this->session->set_userdata(array('message'=> display('successfully_update')));
			redirect(base_url('admin/Cstudent'));
		}	
	    //Model test image update end
	}
	//User Staus Change
	public function user_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Student');
		$user_id =  $_POST['user_id'];
		$status = $CI->Student->change_user_status($user_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
	// Student Delete
	public function student_delete()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Student');
		
		$user_id =  $_POST['user_id'];
		$status = $CI->Student->delete_student($user_id);
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
		echo $status;
		
	}

	//ID Generator
	public function generator($lenth)
	{
		$number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
	
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,61);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
		}
		return $con;
	}
}