<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ctutor extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'tutor';
    }
	// All Active Tutor List
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		$CI->load->model('admin/Tutors');

		
		$content = $CI->ltutor->get_active_tutor_list();
        $sub_menu = array(
				array('label'=> display('active_teacher'), 'url' => 'admin/Ctutor','class' =>'active'),
				array('label'=> display('new_register_teacher'), 'url' => 'admin/Ctutor/wait_for_approval_list'),
				array('label'=> display('inactive_teacher'), 'url' => 'admin/Ctutor/inactive_tutor_list'),
				array('label'=> display('add_new_teacher'), 'url' => 'admin/Ctutor/add_tutor_form')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
	public function wait_for_approval_list()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		$CI->load->model('admin/Tutors');
		
		$config = array();
		$config["base_url"] = base_url()."admin/Ctutor/wait_for_approval_list";
		$config["total_rows"] = $this->Tutors->count_new_register_tutor();  
		$config["per_page"] = 15;
		$config["uri_segment"] = 4;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
		$content = $CI->ltutor->get_newRegister_tutor_list($limit,$page,$links);
        $sub_menu = array(
				array('label'=> display('active_teacher'), 'url' => 'admin/Ctutor'),
				array('label'=> display('new_register_teacher'), 'url' => 'admin/Ctutor/wait_for_approval_list','class' =>'active'),
				array('label'=> display('inactive_teacher'), 'url' => 'admin/Ctutor/inactive_tutor_list'),
				array('label'=> display('add_new_teacher'), 'url' => 'admin/Ctutor/add_tutor_form')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	public function inactive_tutor_list()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		$CI->load->model('admin/Tutors');
		
		$config = array();

		#Paggination start#
        $config["base_url"] = base_url('admin/Ctutor/inactive_tutor_list');
        $config["total_rows"] = $this->Tutors->count_inactive_tutor();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        #Paggination end#


		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
		$content = $CI->ltutor->get_inactive_tutor_list($limit,$page,$links);
        $sub_menu = array(
				array('label'=> display('active_teacher'), 'url' => 'admin/Ctutor'),
				array('label'=> display('new_register_teacher'), 'url' => 'admin/Ctutor/wait_for_approval_list'),
				array('label'=> display('inactive_teacher'), 'url' => 'admin/Ctutor/inactive_tutor_list','class' =>'active'),
				array('label'=> display('add_new_teacher'), 'url' => 'admin/Ctutor/add_tutor_form')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Form for add Class Name
	public function add_tutor_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		$content = $this->ltutor->add_tutor_form();
		$sub_menu = array(
				array('label'=> display('active_teacher'), 'url' => 'admin/Ctutor'),
				array('label'=> display('new_register_teacher'), 'url' => 'admin/Ctutor/wait_for_approval_list'),
				array('label'=> display('inactive_teacher'), 'url' => 'admin/Ctutor/inactive_tutor_list'),
				array('label'=> display('add_new_teacher'), 'url' => 'admin/Ctutor/add_tutor_form','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	// Insert Class Name To Data Base	
	public function insert_tutor()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		
		$tutor_id =$this->generator($length=20);

		if ($_FILES['image']['name']) {

			//Tutor add start
			$config['upload_path']          = './my-assets/images/teacher_image/';
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
	            redirect(base_url('admin/Ctutor'));
	        }
	        else
	        {
	            $image =$this->upload->data();
	            $image_url = base_url().$config['upload_path'].$image['file_name'];
			   
			}
		}
		$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";

		$data1=array(
			'user_id' 		=> $tutor_id,
			'user_name' 	=> $this->input->post('tutorName'),
			'mobile_no' 	=> $this->input->post('mobile'),
			'image' 		=> (!empty($image_url)?$image_url:base_url('my-assets/images/user.png')),
			'others' 		=> ''
		);
		$data2=array(
			'user_id' 		=> $tutor_id,
			'email' 	    => $this->input->post('tutorEmail'),
			'password' 		=> md5('gef_quize'.$this->input->post('password')),
			'user_type' 	=> 'teacher',
			'redirect_url' 	=> "tutor/tutor_dashboard",
			'activation_code' 	=> '',
			'status' 		=> 1
		);
		
		$CI->ltutor->insert_tutor($data1,$data2);
		
		$this->session->set_userdata(array('message'=> display('successfully_insert')));
		if(isset($_POST['add-tutor'])){
			redirect(base_url('admin/Ctutor'));
			exit;
		}
	}
	//Tutor Edit Form
	public function tutor_edit_form($tutor_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ltutor');
		
        $content = $CI->ltutor->tutor_edit_data($tutor_id);
		$sub_menu = array(
				array('label'=> display('active_teacher'), 'url' => 'admin/Ctutor'),
				array('label'=> display('new_register_teacher'), 'url' => 'admin/Ctutor/wait_for_approval_list'),
				array('label'=> display('inactive_teacher'), 'url' => 'admin/Ctutor/inactive_tutor_list'),
				array('label'=> display('add_new_teacher'), 'url' => 'admin/Ctutor/add_tutor_form'),
				array('label'=> display('edit_teacher'), 'url' => 'admin/Ctutor','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Tutor
	public function update_tutor()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Tutors');


		//Model test image update start
		if ($_FILES['image']['name']) {
			$config['upload_path']          = './my-assets/images/teacher_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	           	redirect(base_url('admin/Ctutor'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {
	            	
					$tutor_id = $this->input->post('tutor_id');
					$data1=array(
						'user_name' 	=> $this->input->post('tutorName'),
						'image' 	=> base_url()."my-assets/images/teacher_image/".$image['file_name'],
					);
					$password = $this->input->post('password');
					if($password !=''){
						$data2=array(
							'email' 	    => $this->input->post('tutorEmail'),
							'password' 		=> md5('gef_quize'.$this->input->post('password'))
						);
					}else{
						$data2=array();
					}
					$data3=array(
						'course_id'  => $this->input->post('course_id')
					);
					$CI->Tutors->update_tutor($tutor_id,$data1,$data2,$data3);
					$this->session->set_userdata(array('message'=> display('successfully_update')));
					redirect(base_url('admin/Ctutor'));
	            }
	        }
		}else{
			$tutor_id = $this->input->post('tutor_id');
			$data1=array(
				'user_name' 	=> $this->input->post('tutorName'),
				
			);
			$password = $this->input->post('password');
			if($password !=''){
				$data2=array(
					'email' 	    => $this->input->post('tutorEmail'),
					'password' 		=> md5('gef_quize'.$this->input->post('password'))
				);
			}else{
				$data2=array();
			}
			$data3=array(
				'course_id'  => $this->input->post('course_id')
			);
			$CI->Tutors->update_tutor($tutor_id,$data1,$data2,$data3);
			$this->session->set_userdata(array('message'=> display('successfully_update')));
			redirect(base_url('admin/Ctutor'));
		}	
	    //Model test image update end
	}
	//Tutor Staus Cahnge
	public function tutor_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Tutors');
		
		$tutor_id =  $_POST['tutor_id'];
		$status = $CI->Tutors->change_tutor_status($tutor_id);
		
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
	// Tutor_delete
	public function tutor_delete()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Tutors');
		
		$tutor_id =  $_POST['tutor_id'];
		$status = $CI->Tutors->delete_tutor($tutor_id);
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
		echo $status;
	}	
	
	// Tutor_delete
	public function approved_teacher()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Tutors');
		
		$tutor_id =  $_POST['tutor_id'];
		$status = $CI->Tutors->go_approved_teacher( $tutor_id );
		echo $status;
		$this->session->set_userdata(array('message'=> display('teacher_successfully_approved')));
	}	
	
	// Not Now Approved Teacher
	public function notNow_approved_teacher()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Tutors');
		
		$tutor_id =  $_POST['tutor_id'];
		$status = $CI->Tutors->go_notApproved_teacher( $tutor_id );
		echo $status;
		$this->session->set_userdata(array('message'=> display('teacher_not_approved')));
	}
	//
	private function generator($lenth)
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
			$con="$con"."$rand_number";
			}
		}
		return $con;
	}
}