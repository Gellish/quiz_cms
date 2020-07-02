<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cfacebook extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'facebook';
    }
    //Manage company page load
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lfacebook');
	
        $content = $CI->lfacebook->fb_list();
        $sub_menu = array(
				array('label'=> display('manage_facebook'), 'url' => 'admin/Cfacebook', 'class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Operator Edit Form
	public function fb_edit_form($fb_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lfacebook');
		
        $content = $CI->lfacebook->fb_edit_data($fb_id);
		$sub_menu = array(
				array('label'=> display('manage_facebook'), 'url' => 'admin/Cfacebook'),
				array('label'=> display('edit_facebook'), 'url' => 'admin/Cfacebook','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Operator
	public function update_fb()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Facebook_model');
		
		$data=array(
			'facebook_id' => $this->input->post('facebook_id'),
			'fb_app_id' => $this->input->post('fb_app_id'), 
			'fb_app_secret' => $this->input->post('fb_app_secret'), 
			);

		$CI->Facebook_model->update_fb($data);

		$this->session->set_userdata(array('message'=> display('successfully_update')));

		redirect(base_url('admin/Cfacebook'));
	}
	//Operator Staus Cahnge
	public function company_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Facebook_model');
		$company_id =  $_POST['company_id'];
		$status = $CI->Facebook_model->change_company_status($company_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
}