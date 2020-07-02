<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccourse extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'course';
    }
	/*
	//* Retrieve Class List to view on the admin end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcourse');
		$CI->load->model('admin/Courses');
		
        $content = $CI->lcourse->course_list();
        $sub_menu = array(
				array('label'=>  display('manage_course'), 'url' => 'admin/Ccourse', 'class' =>'active'),
				array('label'=>  display('add_course'), 'url' => 'admin/Ccourse/add_course_form'),
				array('label'=>  display('request_course'), 'url' => 'admin/Ccourse/requested_course_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Form for add Class Name
	*/
	public function add_course_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcourse');
		
        $content = $CI->lcourse->course_add_form();
       
        $sub_menu = array(
				array('label'=>  display('manage_course'), 'url' => 'admin/Ccourse'),
				array('label'=>  display('add_course'), 'url' => 'admin/Ccourse/add_course_form', 'class' =>'active'),
				array('label'=>  display('request_course'), 'url' => 'admin/Ccourse/requested_course_list')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Insert Course Name To Data Base
	*/
	public function insert_course()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcourse');

		if ($_FILES['image']['name']) {
			//Course image add start
			$config['upload_path']          = './my-assets/images/course_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	            redirect(base_url('admin/Ccourse/add_course_form'));
	        }
	        else
	        {
	            $image =$this->upload->data();
	            $image_url= base_url()."my-assets/images/course_image/".$image['file_name'];
	        }
	    }
        $data=array(
			'course_id' 	=> null,
			'course_name' 	=> $this->input->post('courseName'),
			'class_id' 		=> $this->input->post('class_id'),
			'is_new' 		=> $this->input->post('is_new'),
			'course_details' 	=> strip_tags($this->input->post('course_details'),'<p><a>'),
			'image' 	=> (!empty($image_url)?$image_url:base_url('my-assets/images/course.png')),
			'status' 		=> 1
			);

		$CI->lcourse->insert_course($data);
		$this->session->set_userdata(array('message'=> display('successfully_insert')));
		
		if(isset($_POST['add-course'])){
			redirect(base_url('admin/Ccourse'));
			exit;
		}elseif(isset($_POST['add-course-another'])){
			redirect(base_url('admin/Ccourse/add_course_form'));
			exit;
		}
        //Course image add end
	}
	/*
	** Course Edit Form
	*/
	public function course_edit_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Courses');	
		$course_id=$this->input->post("id");
		$course_detail = $CI->Courses->retrieve_course_editdata($course_id);
		$class_list = $CI->Courses->retrieve_class_list();

		$class_id = $course_detail[0]['class_id'];

		foreach($class_list as $k=>$val){
			if($class_id == $val['class_id']){
				$class_list[$k]['selected']='selected="selected"';
			}
			else{
                $class_list[$k]['selected']='';
            }
		}

		$data = array(
				'class_list' => $class_list,
				'class_id' => $course_detail[0]['class_id'],
				'course_id' => $course_detail[0]['course_id'],
				'course_name' => $course_detail[0]['course_name'],
				'is_new' => $course_detail[0]['is_new'],
				'course_details' => $course_detail[0]['course_details'],
				'image' => $course_detail[0]['image'],
				'status' => $course_detail[0]['status']
			);
	
		foreach ($course_detail as $course):endforeach;

		$form = '';

		$form .= form_open('admin/Ccourse/update_course', array('id' => 'course_add','enctype'=>'multipart/form-data'));
		$form .="<div class=\"row\">
				<div class=\"col-sm-12\">
					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('class_name').":</label>
						<div class=\"col-sm-7\">
							<select name='class_id' id='class_id' required='' class='form-control'>
								<option value='0'>".display('please_select')."</option>";

								foreach ($class_list as $value) {
						    		$form .= "<option value='".$value['class_id']."' ".$value['selected'].">

						    		".$value['class_name']."

						    		</option>"; 
								}	


		$form .= "</select> 
						</div>
					</div>

					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('course_name').":</label>
						<div class=\"col-sm-7\">
							<input type='text' name='courseName' id='courseName' value='".$data['course_name']."' class=' required form-control' required=''>
						</div>
					</div>

					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('is_new').":</label>
						<div class=\"col-sm-7\">
							<input type='checkbox' name='is_new' id='is_new' value='".$data['is_new']."'";
							if(isset($data['is_new']) && $data['is_new']==1){
								$form .='checked="checked"';
							}

		$form .= ">
						</div>
					</div>

					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('course_details')."</label>
						<div class=\"col-sm-7\">
							<textarea name=\"course_details\" required class=\"form-control mytextarea\">".$data['course_details']."</textarea>
						</div>
					</div>



					<div class=\"form-group row\">
						<label for=\"example-text-input\" class=\"col-sm-3 col-form-label\">".display('image')." :</label>
						<div class=\"col-sm-5\">
							<input type=\"file\" name=\"image\">
						</div>
						<div class=\"col-sm-4\">
							<img class=\"img-responsive img-thumbnail\" src='".$data['image']."' height=\"80\" width=\"80\">
							<input type=\"hidden\" value='".$data['image']."' name=\"old_image\">
							<input type='hidden' name='course_id' id='course_id' value='".$data['course_id']."' required=''>
						</div>
					</div>

					<div class=\"form-group row text-right\">
						<div class=\"col-sm-7\">
							<button type='submit' class='btn btn-primary' name='add-course'>".display('save_changes')."</button>
						</div>
					</div>
				</div>
			</div>";
		$form .= form_close();
		echo $form; 
	}
	/*
	** Class Update
	*/
	public function update_course()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Courses');

		//Course image update start
		if ($_FILES['image']['name'] !=null) {

			$config['upload_path']          = './my-assets/images/course_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('image_not_uploaded')));
	            redirect(base_url('admin/Ccourse'));
	        }
	        else
	        {

	            if ($image =$this->upload->data()) {

					$course_id = $this->input->post('course_id');
					$data=array(
						'course_name' => $this->input->post('courseName'),
						'class_id' => $this->input->post('class_id'),
						'is_new' 	=> $this->input->post('is_new'),
						'course_details' 	=> strip_tags($this->input->post('course_details'),'<p><a>'),
						'image' 	=> base_url().'my-assets/images/course_image/'.$image['file_name'],
						'status' => $this->input->post('status')
					);
					$CI->Courses->update_course($course_id,$data);
					$this->session->set_userdata(array('message'=> display('successfully_update')));
					redirect(base_url('admin/Ccourse'));
	            }
	        }
		}else{

			$course_id = $this->input->post('course_id');
			$data=array(
				'course_name' => $this->input->post('courseName'),
				'class_id' => $this->input->post('class_id'),
				'course_details' 	=>  strip_tags($this->input->post('course_details'),'<p><a>'),
				'is_new' 	=> $this->input->post('is_new'),
			);
			$CI->Courses->update_course($course_id,$data);
			$this->session->set_userdata(array('message'=> display('successfully_update')));
			redirect(base_url('admin/Ccourse'));
		}	
	    //Course image update end
	}
	
	// Change Course Status
	public function change_courseName_status()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Courses');
		
		$course_id =  $_POST['course_id'];	
		$status = $CI->Courses->change_courseName_status($course_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
	
	public function requested_course_list()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcourse');
		
        $content = $CI->lcourse->get_requested_course_view();
        $sub_menu = array(
				array('label'=>  display('manage_course'), 'url' => 'admin/Ccourse'),
				array('label'=>  display('add_course'), 'url' => 'admin/Ccourse/add_course_form'),
				array('label'=>  display('request_course'), 'url' => 'admin/Ccourse/requested_course_list','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
	public function approve_teacher_requested_coures()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Courses');
		
		$course_id =  $_POST['course_id'];	
		$status = $CI->Courses->approve_requested_course($course_id);

		$this->session->set_userdata(array('message'=>display('successfully_approved_requested_course')));

		echo $status;
	}
	
	public function deny_teacher_requested_coures()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Courses');
		
		$course_id =  $_POST['course_id'];	
		$status = $CI->Courses->delete_requested_course($course_id);
		$this->session->set_userdata(array('message'=>display('successfully_deleted_requested_course')));
		echo $status;
	}
}