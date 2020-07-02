<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coperator extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'operator';
    }
	/*
	//* Retrieve Class List to view on the admin end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('loperator');
	
        $content = $CI->loperator->operator_list();
        $sub_menu = array(
				array('label'=> display('manage_operator'), 'url' => 'admin/Coperator', 'class' =>'active'),
				array('label'=> display('add_operator'), 'url' => 'admin/Coperator/add_operator_form')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Form for add Class Name
	public function add_operator_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('loperator');
        $content = $this->loperator->add_operator_form();
        $sub_menu = array(
				array('label'=> display('manage_operator'), 'url' => 'admin/Coperator'),
				array('label'=> display('add_operator'), 'url' => 'admin/Coperator/add_operator_form','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Insert Operator To database
	public function insert_operator()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('loperator');
		$image_file = "";
		$operator_id =$this->generator($length=20);
		if ($_FILES['image']['name']) {
			//Operator add start
			$config['upload_path']          = './my-assets/images/operator_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['max_size']             = '0';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        $a = 'image';
	        if ( ! $this->upload->do_upload($a))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            print_r($error);
	        	exit();
	            $this->session->set_userdata(array('message'=> display('Image Not Uploaded!')));
	            redirect(base_url('admin/Coperator'));
	        }
	        else
	        {
	            $image =$this->upload->data();
	            $image_file=base_url().'my-assets/images/operator_image/'.$image['file_name'];
			}
		}
		$duration = $this->input->post('dura_hour').":".$this->input->post('dura_min').":00";

		$data1=array(
			'user_id' 		=> $operator_id,
			'user_name' 	=> $this->input->post('operatorName'),
			'mobile_no' 	=> $this->input->post('mobile'),
			'image' 		=> (!empty($image_file)?$image_file:base_url('my-assets/images/user.png')),
			'others' 		=> ''
		);

		$data2=array(
			'user_id' 		=> $operator_id,
			'email' 	    => $this->input->post('operatorEmail'),
			'password' 		=> md5('gef_quize'.$this->input->post('password')),
			'user_type' 	=> "operator",
			'redirect_url' 	=> "operator/Operator_dashboard",
			'activation_code' 	=> '',
			'status' 		=> 1
		);
		$data3=array(
			'permission_id' 	=> Null,
			'operator_id' 		=> $operator_id,
			'course_id' 	    => $this->input->post('course_id'),
			'status' 		=> 1
		);

		$CI->loperator->insert_operator($data1,$data2,$data3);
		
		$this->session->set_userdata(array('message'=> display('successfully_insert')));

		if(isset($_POST['add-operator'])){
			redirect(base_url('admin/Coperator'));
			exit;
		}
		//Operator add end
	}
	//Operator Edit Form
	public function operator_edit_form($operator_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('loperator');
		
        $content = $CI->loperator->operator_edit_data($operator_id);
		$sub_menu = array(
				array('label'=> display('manage_operator'), 'url' => 'admin/Coperator'),
				array('label'=> display('add_operator'), 'url' => 'admin/Coperator/add_operator_form'),
				array('label'=> display('edit_operator'), 'url' => 'admin/Coperator','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Operator
	public function update_operator()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Operators');

		//Operator test image update start
		if ($_FILES['image']) {
			$config['upload_path']          = './my-assets/images/operator_image/';
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
	           	redirect(base_url('admin/Coperator'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {

					$operator_id = $this->input->post('operator_id');
					$data1=array(
						'user_name' 	=> $this->input->post('operatorName'),
						'image' 	=> base_url()."my-assets/images/operator_image/".$image['file_name'],
					);
					$password = $this->input->post('password');
					if($password !=''){
						$data2=array(
							'email' 	    => $this->input->post('operatorEmail'),
							'password' 		=> md5('gef_quize'.$this->input->post('password'))
						);
					}else{
						$data2=array();
					}
					$data3=array(
						'course_id' 	    => $this->input->post('course_id')
					);
					$CI->Operators->update_operator($operator_id,$data1,$data2,$data3);
					$this->session->set_userdata(array('message'=> display('successfully_update')));
					redirect(base_url('admin/Coperator'));
	            }
	        }
		}else{
			$operator_id = $this->input->post('operator_id');
			$data1=array(
				'user_name' 	=> $this->input->post('operatorName')
			);
			$password = $this->input->post('password');
			if($password !=''){
				$data2=array(
					'email' 	    => $this->input->post('operatorEmail'),
					'password' 		=> md5('gef_quize'.$this->input->post('password'))
				);
			}else{
				$data2=array();
			}
			$data3=array(
				'course_id' 	    => $this->input->post('course_id')
			);
			$CI->Operators->update_operator($operator_id,$data1,$data2,$data3);
			$this->session->set_userdata(array('message'=> display('successfully_update')));
			redirect(base_url('admin/Coperator'));
		}	
	    //Operator test image update end
	}
	//Operator Staus Cahnge
	public function oprator_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Operators');
		
		$operator_id =  $_POST['operator_id'];
		$status = $CI->Operators->change_operator_status($operator_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
	// Operator_delete
	public function operator_delete()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Operators');
		
		$operator_id =  $_POST['operator_id'];
		$status = $CI->Operators->delete_operator($operator_id);
		echo $status;
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
	}
	//
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