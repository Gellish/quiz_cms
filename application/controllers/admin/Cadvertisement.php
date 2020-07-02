<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cadvertisement extends CI_Controller {
	
	function __construct() {
	    parent::__construct();
	    $CI =& get_instance();
		$CI->auth->check_admin_auth();
		$this->template->current_menu = 'advertisement';
		$this->load->library('upload');
    }
    //Manage advertisement page load
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ladvertisement');
	
        $content = $CI->ladvertisement->advertisement_list();
        $sub_menu = array(
				array('label'=> display('manage_advertisement'), 'url' => 'admin/Cadvertisement', 'class' =>'active'),
				array('label'=> display('add_advertisement'), 'url' => 'admin/Cadvertisement/add_advertisement')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	//Advertisement Edit Form
	public function add_advertisement()
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ladvertisement');

		$content = $CI->ladvertisement->add_advertisement();
		$sub_menu = array(
				array('label'=> display('manage_advertisement'), 'url' => 'admin/Cadvertisement'),
				array('label'=> display('add_advertisement'), 'url' => 'admin/Cadvertisement','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	public function submit_advertisement()
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ladvertisement');
		$CI->load->model('admin/Advertisement');

		$ad_type=$this->input->post('ad_type');
		if ($ad_type==1):
			$data['add_code']=$this->input->post('add_code');
		else:
			$data['add_code']=null;
		endif;

		if ($ad_type==2):
			if (!empty($_FILES['add_image']['name'])) {
				$data=array();
				$files = $_FILES;
				$config=array();
				$config['upload_path'] ='my-assets/images/add_image/';
			    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
			    $config['max_size']      = '0';
			    $config['overwrite']     = FALSE;
			   	$config['encrypt_name']     = true; 

		   		$this->upload->initialize($config);

		        if (!$this->upload->do_upload('add_image')) {
		           	echo "Ads image not updated";
		        } else {
					$view =$this->upload->data();
				   	$filepath=base_url($config['upload_path'].$view['file_name']);
		        }

		        $add_url=$this->input->post('add_url');
		        $data['add_code']="<a href=\"$add_url\" target=\"_blank\"><img src=\"$filepath\" alt=\"\" class=\"img-responsive center-block\"></a>";
				
			}else{
				$this->session->set_userdata(array('message'=>'Image filed is required!'));
				redirect('admin/Cadvertisement'); 
			}
		endif;

		$data['add_position']=$this->input->post('add_position');
		$result=$this->Advertisement->insert_add($data);

		if($result == TRUE):
			$this->session->set_userdata(array('message'=>display('successfully_insert')));
		  	redirect('admin/Cadvertisement'); 
		elseif($result == FALSE):
			$this->session->set_userdata(array('message'=>'Adds position already exits!'));
			redirect('admin/Cadvertisement'); 
		endif;
	}

	//Advertisement Edit Form
	public function advertise_edit_form($add_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('ladvertisement');
		
        $content = $CI->ladvertisement->advertise_edit_data($add_id);
		$sub_menu = array(
				array('label'=> display('manage_advertisement'), 'url' => 'admin/Cadvertisement'),
				array('label'=> display('edit_advertisement'), 'url' => 'admin/Cadvertisement','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update advertisement
	public function update_advertisement()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Advertisement');

		$ad_type=$this->input->post('ad_type');
		if ($ad_type==1):
			$data['add_code']=$this->input->post('add_code');
		else:
			$data['add_code']=null;
		endif;

		if ($ad_type==2):
			if (!empty($_FILES['add_image']['name'])) {
				$data=array();
				$files = $_FILES;
				$config=array();
				$config['upload_path'] ='my-assets/images/add_image/';
			    $config['allowed_types'] ='gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
			    $config['max_size']      = '0';
			    $config['overwrite']     = FALSE;
			   	$config['encrypt_name']     = true; 

		   		$this->upload->initialize($config);

		        if (!$this->upload->do_upload('add_image')) {
		           	echo "Ads image not updated";
		        } else {
					$view =$this->upload->data();
				   	$filepath=base_url($config['upload_path'].$view['file_name']);
		        }

		        $add_url=$this->input->post('add_url');
		        $data['add_code']="<a href=\"$add_url\" target=\"_blank\"><img src=\"$filepath\" alt=\"\" class=\"img-responsive center-block\"></a>";
				
			}else{
				$this->session->set_userdata(array('message'=>'Image filed is required!'));
				redirect('admin/Cadvertisement'); 
			}
		endif;

		$data['add_position']=$this->input->post('add_position');
		$result=$this->Advertisement->update_advertisement($data);

		if($result == TRUE):
			$this->session->set_userdata(array('message'=>display('successfully_update')));
		  	redirect('admin/Cadvertisement'); 
		elseif($result == FALSE):
			$this->session->set_userdata(array('message'=>'Adds position already exits!'));
			redirect('admin/Cadvertisement'); 
		endif;
	}

	//Delate Advertisement
	public function delete_advertisement()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Advertisement');
		
		$add_id =  $_POST['add_id'];	
		$status = $CI->Advertisement->do_delete_advertise($add_id);
		$this->session->set_userdata(array('message'=> display('successfully_delete')));
		echo $status;
	}


	//Advertisement Status Change
	public function ads_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Advertisement');
		$add_id =  $_POST['add_id'];
		$status = $CI->Advertisement->change_ads_status($add_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
}