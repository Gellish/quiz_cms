<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Csetting extends CI_Controller {
	
	function __construct() {
      	parent::__construct();
	  	$this->load->library('upload');
    }
    //Manage Setting page load
	public function index()
	{
	  	$this->template->current_menu = 'setting';
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lsetting');
	
        $content = $CI->lsetting->setting_list();
        $sub_menu = array(
			array('label'=> display('manage_setting'), 'url' => 'admin/Csetting', 'class' =>'active'),
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Setting
	public function update_setting()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Settings');

		if ($_FILES['logo']['name']) {
			$data=array();
			$config=array();
			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 

	   		$this->upload->initialize($config);

	        if (!$this->upload->do_upload('logo')) {
	           	echo "Logo not updated";
	        }else {
				$view =$this->upload->data();
				$logo=$this->input->post('old_logo');

				if ($logo != null) {
					$index=explode("/",$logo);
				    $last_index=end($index);
				   	unlink($config['upload_path'].$last_index);
				}
			   	$data['logo']=base_url('my-assets/images/logo_image/'.$view['file_name']);
	        }
		}elseif ($_FILES['back_image']['name']) {
			$data=array();
			$config=array();
			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 

	   		$this->upload->initialize($config);

        	if (!$this->upload->do_upload('back_image')) {
           	echo "Back ground image not updated";
	        } else {
				$view =$this->upload->data();
				$old_back_image=$this->input->post('old_back_image');
				if ($old_back_image != null) {
					$index=explode("/",$old_back_image);
				    $last_index=end($index);
				   	unlink($config['upload_path'].$last_index);
				}
			   	$data['back_image']=base_url('my-assets/images/logo_image/'.$view['file_name']);
	        }
		}elseif ($_FILES['favicon']['name']) {
			$data=array();
			$config=array();
			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 

	   		$this->upload->initialize($config);

        	if (!$this->upload->do_upload('favicon')) {
           	echo "Back ground image not updated";
	        } else {
				$view =$this->upload->data();
				$old_favicon=$this->input->post('old_favicon');
				if ($old_favicon != null) {
					$index=explode("/",$old_favicon);
				    $last_index=end($index);
				   	unlink($config['upload_path'].$last_index);
				}
			   	$data['favicon']=base_url('my-assets/images/logo_image/'.$view['file_name']);
	        }
		}else{

			$data['copyright']=$this->input->post('copyright');
	        $data['link']=$this->input->post('link');

			$result=$this->Settings->update_setting($data);

			if($result == TRUE):
				$this->session->set_userdata(array('message'=>display('successfully_update')));
			  	redirect('admin/Csetting'); 
			elseif($result == FALSE):
				$this->session->set_userdata(array('message'=>'Setting not updated!'));
				redirect('admin/Csetting'); 
			endif;

			$this->session->set_userdata(array('message'=>'Image filed is required!'));
			redirect('admin/Csetting'); 
		}

        $data['copyright']=$this->input->post('copyright');
        $data['link']=$this->input->post('link');

		$result=$this->Settings->update_setting($data);

		if($result == TRUE):
			$this->session->set_userdata(array('message'=>display('successfully_update')));
		  	redirect('admin/Csetting'); 
		elseif($result == FALSE):
			$this->session->set_userdata(array('message'=>'Setting not updated!'));
			redirect('admin/Csetting'); 
		endif;
	}
	//Manage Setting page load
	public function edit_footer_image()
	{
	   	$this->template->current_menu = 'footer_image';
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lsetting');
	
        $content = $CI->lsetting->footer_image_list();
        $sub_menu = array(
			array('label'=> display('manage_setting'), 'url' => 'admin/Csetting/edit_footer_image', 'class' =>'active'),
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Image URL
	public function update_image_url()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Settings');
		$data=array();
		$config=array();

		if ($_FILES['first_image']['name']) {
			
			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 

	   		$this->upload->initialize($config);

	        if (!$this->upload->do_upload('first_image')) {
	           	echo "Image not updated";
	        } else {
				$view =$this->upload->data();
			   	$data['first_image']=base_url('my-assets/images/logo_image/'.$view['file_name']);
	        }
		}


		if ($_FILES['second_image']['name']) {

			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 
		   	$this->upload->initialize($config);

			if ($_FILES['second_image']['name']) {
	        	if (!$this->upload->do_upload('second_image')) {
	           	echo "Image not updated";
		        } else {
					$view =$this->upload->data();
					$data['second_image']=base_url('my-assets/images/logo_image/'.$view['file_name']);
		        }
	        }
		}

		if ($_FILES['third_image']['name']) {

			$config['upload_path'] ='./my-assets/images/logo_image/';
		    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
		    $config['overwrite']     = FALSE;
		   	$config['encrypt_name']     = true; 
		   	$this->upload->initialize($config);


			if ($_FILES['third_image']['name']) {
	        	if (!$this->upload->do_upload('third_image')) {
	           	echo "Image not updated";
		        } else {
					$view =$this->upload->data();
					$data['third_image']=base_url('my-assets/images/logo_image/'.$view['file_name']);
		        }
	        }
		}

		$data['first_url']=$this->input->post('first_url');
		$data['second_url']=$this->input->post('second_url');
		$data['third_url']=$this->input->post('third_url');

		$result=$this->Settings->update_setting($data);

		if($result == TRUE):
			$this->session->set_userdata(array('message'=>display('successfully_update')));
		  	redirect('admin/Csetting/edit_footer_image'); 
		elseif($result == FALSE):
			$this->session->set_userdata(array('message'=>'Setting not updated!'));
			redirect('admin/Csetting/edit_footer_image'); 
		endif;
	}
}